<?php

namespace App\Repositories\PostTags;

use App\Models\Tag;

interface PostTagsRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Tag
     */
    public function create(array $attributes): Tag;

    /**
     * @param array|int $attributes
     * @return bool
     */
    public function exists($attributes): bool;

    /**
     * @param string $name
     * @return Tag
     */
    public function firstOrCreate(string $name): Tag;
}
