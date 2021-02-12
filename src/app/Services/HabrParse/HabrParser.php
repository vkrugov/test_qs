<?php

namespace App\Services\HabrParse;

interface HabrParser
{
    /**
     * Parsing posts from main habr page
     */
    public function parsePosts(): void;
}
