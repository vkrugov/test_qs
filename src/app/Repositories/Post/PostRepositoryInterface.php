<?php

namespace App\Repositories\Post;

use App\Models\Post;
use Illuminate\Pagination\Paginator;

interface PostRepositoryInterface
{
    /**
     * @param int|null $limit
     * @return Paginator
     */
    public function all(?int $limit): Paginator;

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
