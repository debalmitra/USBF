<?php

declare(strict_types=1);

namespace Core;

final readonly class Route
{
    /** @param callable(Request): Response $handler */
    public function __construct(
        public string $method,
        public string $path,
        public mixed $handler,
    ) {}
}
