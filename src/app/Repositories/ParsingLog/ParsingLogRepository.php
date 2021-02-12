<?php

namespace App\Repositories\ParsingLog;

use App\Models\ParsingLog;

class ParsingLogRepository implements ParsingLogRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function create(array $attributes): ParsingLog
    {
        return ParsingLog::create($attributes);
    }
}
