<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostTag
 *
 * @property int $id
 * @property int $post_id
 * @property int $tag_id
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostTag whereTagId($value)
 * @mixin \Eloquent
 */
class PostTag extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'post_id', 'tag_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'post_id' => 'int',
        'tag_id' => 'int',
    ];
}
