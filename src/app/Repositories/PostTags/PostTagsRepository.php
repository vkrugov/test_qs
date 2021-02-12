<?php

namespace App\Repositories\PostTags;

use App\Models\Tag;

class PostTagsRepository implements PostTagsRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Tag
     */
    public function create(array $attributes): Tag
    {
        return Tag::create($attributes);
    }

    /**
     * @param array|int $attributes
     * @return bool
     */
    public function exists($attributes): bool
    {
        $query = Tag::query();

        if (is_array($attributes)) {
            $query->where($attributes);
        } elseif (is_int($attributes)) {
            $query->whereId($attributes);
        }

        return $query->exists();
    }

    /**
     * @param string $name
     * @return Tag
     */
    public function firstOrCreate(string $name): Tag
    {
        return Tag::firstOrCreate(['name' => $name]);
    }
}
