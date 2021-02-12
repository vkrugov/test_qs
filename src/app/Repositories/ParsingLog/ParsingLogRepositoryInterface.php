<?php

namespace App\Repositories\ParsingLog;

use App\Models\ParsingLog;

interface ParsingLogRepositoryInterface
{
    /**
     * @param array $attributes
     * @return ParsingLog
     */
    public function create(array $attributes): ParsingLog;
}
