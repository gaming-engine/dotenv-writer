<?php

namespace GamingEngine\DotEnv;

class File
{
    public function read(string $path): string
    {
        return file_get_contents($path);
    }

    public function write(string $path, string $contents): void
    {
        file_put_contents($path, $contents);
    }
}