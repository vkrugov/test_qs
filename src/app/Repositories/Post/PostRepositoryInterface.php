<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    /**
     * @param int|null $limit
     * @return LengthAwarePaginator
     */
    public function all(?int $limit): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @return Post
     */
    public function create(array $attributes): Post;

    /**
     * @param array|int $attributes
     * @return bool
     */
    public function exists($attributes): bool;
}
