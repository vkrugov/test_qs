<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ParsingLog
 *
 * @property int $id
 * @property int $event
 * @property string $message
 * @property string $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ParsingLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParsingLog extends Model
{
    use HasFactory;

    const HABR_PAR_POST_EVENT = 1;

    /**
     * @var array
     */
    protected $fillable = [
        'data', 'message', 'event',
    ];
}
