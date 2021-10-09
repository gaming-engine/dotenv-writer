<?php

namespace GamingEngine\DotEnv;

use Dotenv\Dotenv;

class Parser
{
    public function parse(string $contents): array
    {
        return Dotenv::parse($contents);
    }
}