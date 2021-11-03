<?php

namespace GamingEngine\DotEnv;

class Writer
{
    private File $file;
    private Parser $parser;
    private array $environment = [];

    public function __construct(File $file = null, Parser $parser = null)
    {
        $this->file = $file ?? new File();
        $this->parser = $parser ?? new Parser();
    }

    public function load(string $path): self
    {
        $this->environment = array_merge(
            $this->environment,
            $this->parser->parse(
                $this->file->read($path)
            )
        );

        return $this;
    }

    public function setValue(string $key, $value): self
    {
        $this->environment[$key] = $value;

        return $this;
    }

    public function getValue(string $key): ?string
    {
        return $this->environment[$key] ?? null;
    }

    public function write(string $path): void
    {
        $this->file->write($path, (string)$this);
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, array_map(
                function ($value, $key) {
                    $format = '%s=%s';

                    if (str_contains($value, '#')) {
                        $format = '%s="%s"';
                    }

                    return sprintf($format, $key, $value);
                },
                $this->environment,
                array_keys($this->environment)
            )
        );
    }
}
