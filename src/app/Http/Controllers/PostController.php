<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\Index as IndexRequest;
use App\Http\Requests\Post\Show as ShowRequest;
use App\Http\Resources\Post as PostResource;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    protected PostRepositoryInterface $postRepository;

    /**
     * PostController constructor.
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        PostResource::wrap('posts');

        return PostResource::collection($this->postRepository->all($request->limit));
    }

    /**
     * @param ShowRequest $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowRequest $request, Post $post)
    {
        return response()->json([
            'post' => new PostResource($post->load('tags')),
        ]);
    }
}
