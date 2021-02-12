<?php

namespace App\Services\HabrParse;

use App\Models\ParsingLog;
use App\Repositories\ParsingLog\ParsingLogRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostTags\PostTagsRepositoryInterface;
use Carbon\Carbon;
use Goutte;
use Symfony\Component\DomCrawler\Crawler;

class HabrParserService implements HabrParser
{
    const POST_SCOPE_FILTER = 'article';
    const NEXT_PAGE_FILTER = '#next_page';
    const SHOW_POST_FILTER = '.post__habracut-btn';
    const TAG_LIST_FILTER = '.js-post-tags a';
    const POST_BODY_FILTER = '.post__body_full';
    const POST_TITLE_FILTER = '.post__title_full';
    const POST_TIME_FILTER = '.post__time';

    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * @var PostTagsRepositoryInterface
     */
    protected $postTagRepository;

    /**
     * @var ParsingLogRepositoryInterface
     */
    protected $parsingLogRepository;

    /**
     * @var string
     */
    protected string $mainUri;

    /**
     * HabrParserService constructor.
     */
    public function __construct()
    {
        $this->setMainUri()->setRepositories();
    }

    /**
     * @return $this
     */
    protected function setMainUri(): HabrParserService
    {
        $this->mainUri = \Config::get('habr.uri');

        return $this;
    }

    /**
     * @return $this
     */
    protected function setRepositories(): HabrParserService
    {
        $this->postRepository = app()->make(PostRepositoryInterface::class);
        $this->postTagRepository = app()->make(PostTagsRepositoryInterface::class);;
        $this->parsingLogRepository = app()->make(ParsingLogRepositoryInterface::class);;

        return $this;
    }

    /**
     * @param string $url
     * @param string $method
     * @return Crawler
     */
    protected function makeRequest(string $url, $method = 'POST'): Crawler
    {
        return Goutte::request($method, $url);
    }

    /**
     * Parse posts
     */
    public function parsePosts(): void
    {
        $hasNextPage = true;
        $url = $this->mainUri;

        while ($hasNextPage) {
            $page = $this->makeRequest($url);
            $page->filter(self::POST_SCOPE_FILTER)->each(function (Crawler $node) {
                $this->workWithPrePost($node);
            });
            $nextPage = $page->filter(self::NEXT_PAGE_FILTER)->first();

            if ($nextPage->count() === 0) {
                $hasNextPage = false;
            } else {
                $url = $this->mainUri . $nextPage->attr('href');
            }
        }
    }

    /**
     * @param Crawler $prePost
     * Work with post preview
     */
    protected function workWithPrePost(Crawler $prePost): void
    {
        if (!empty($showPostLink = $this->getAttr($prePost, self::SHOW_POST_FILTER, 'href'))) {
            $this->workWithPostPage($this->makeRequest($showPostLink));
        }
    }

    /**
     * @param Crawler $postPage
     * Work with post page
     */
    protected function workWithPostPage(Crawler $postPage)
    {
        $postIdString = $this->getAttr($postPage, self::POST_SCOPE_FILTER, 'id');
        $postId = !empty($postIdString) ? str_replace('post_', '', $postIdString) : null;

        if (!$this->postRepository->exists(['external_id' => $postId])) {
            $this->savePost($postPage, $postId);
        }
    }

    /**
     * @param Crawler $postPage
     * @param string|int $postId
     * @return bool
     */
    protected function savePost(Crawler $postPage, $postId): bool
    {
        $postData = [
            'external_id' => $postId,
            'title' => $this->getText($postPage, self::POST_TITLE_FILTER),
            'body' => $this->getHtml($postPage, self::POST_BODY_FILTER),
            'publication_date' => Carbon::parse($this->getAttr($postPage, self::POST_TIME_FILTER, 'data-time_published')),
            'parsed_at' => Carbon::now(),
        ];

        try {
            $postModel = $this->postRepository->create($postData);
            $this->workWithTags($postPage, $postModel);

            return true;
        } catch (\Exception $exception) {
            $this->parsingLogRepository->create([
                'event' => ParsingLog::HABR_PAR_POST_EVENT,
                'data' => json_encode($postData),
                'message' => $exception->getMessage()
            ]);

            return false;
        }
    }

    /**
     * @param Crawler $crawler
     * @param string $filter
     * @param string $attr
     * @return string|null
     */
    protected function getAttr(Crawler $crawler, string $filter, string $attr): ?string
    {
        $target = $crawler->filter($filter)->first();

        return $target->count() !== 0 ? $target->attr($attr) : null;
    }

    /**
     * @param Crawler $crawler
     * @param string $filter
     * @param string $attr
     * @return string|null
     */
    protected function getText(Crawler $crawler, string $filter): ?string
    {
        $target = $crawler->filter($filter)->first();

        return $target->count() !== 0 ? $target->text() : null;
    }


    /**
     * @param Crawler $crawler
     * @param string $filter
     * @param string $attr
     * @return string|null
     */
    protected function getHtml(Crawler $crawler, string $filter): ?string
    {
        $target = $crawler->filter($filter)->first();

        return $target->count() !== 0 ? $target->html() : null;
    }


    /**
     * @param Crawler $postPage
     * @param \App\Models\Post $postModel
     */
    protected function workWithTags(Crawler $postPage, \App\Models\Post $postModel): void
    {
        $postPage->filter(self::TAG_LIST_FILTER)->each(function (Crawler $node) use ($postModel) {
            $tagName = $node->text();
            $tagModel = $this->postTagRepository->firstOrCreate($tagName);

            if (!$postModel->tags()->where('tags.id', $tagModel->id)->exists()) {
                $postModel->tags()->attach($tagModel->id);
            }
        });
    }
}
