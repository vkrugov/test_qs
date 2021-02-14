<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class PostRepository implements PostRepositoryInterface
{
    const DEFAULT_PAGINATION = 10;

    /**
     * @param int|null $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(?int $limit): LengthAwarePaginator
    {
        return QueryBuilder::for(Post::class)
            ->defaultSort('-publication_date')
            ->allowedFilters([
                'title'
            ])
            ->allowedSorts([
                'publication_date'
            ])
            ->paginate($limit ?? self::DEFAULT_PAGINATION);
    }

    /**
     * @param array $attributes
     * @return Post
     */
    public function create(array $attributes): Post
    {
        return Post::create($attributes);
    }

    /**
     * @param array|int $attributes
     * @return bool
     */
    public function exists($attributes): bool
    {
        $query = Post::query();

        if (is_array($attributes)) {
            $query->where($attributes);
        } elseif (is_int($attributes)) {
            $query->whereId($attributes);
        }

        return $query->exists();
    }
}
