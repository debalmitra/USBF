<?php

declare(strict_types=1);

namespace Core;

final readonly class Request
{
    /**
     * @param array<string, mixed> $query
     * @param array<string, mixed> $body
     * @param array<string, string> $params
     */
    private function __construct(
        public string $method,
        public string $path,
        public array $query,
        public array $body,
        public array $params = [],
    ) {}

    public static function capture(): self
{
    $path = parse_url(
        $_SERVER['REQUEST_URI'] ?? '/',
        PHP_URL_PATH
    ) ?: '/';

    $script = str_replace(
        '\\',
        '/',
        $_SERVER['SCRIPT_NAME']
        ?? $_SERVER['PHP_SELF']
        ?? ''
    );

    /*
     * Normal setup:
     *
     * /public/index.php
     *
     * The public directory is visible in the URL.
     */
    $scriptDirectory = rtrim(
        dirname($script),
        '/'
    );

    /*
     * Hidden public/ setup:
     *
     * Browser:
     * /v1.0.0/
     *
     * Internally:
     * /v1.0.0/public/index.php
     *
     * In this case the real application base is the
     * parent directory of /public/.
     */
    if (
        str_ends_with(
            $scriptDirectory,
            '/public'
        )
    ) {
        $basePath = dirname(
            $scriptDirectory
        );
    } else {
        $basePath = $scriptDirectory;
    }

    $basePath = rtrim(
        $basePath,
        '/'
    );

    if (
        $basePath !== ''
        && (
            $path === $basePath
            || str_starts_with(
                $path,
                $basePath . '/'
            )
        )
    ) {
        $path = substr(
            $path,
            strlen($basePath)
        ) ?: '/';
    }

    return new self(
        strtoupper(
            $_SERVER['REQUEST_METHOD'] ?? 'GET'
        ),
        '/' . ltrim($path, '/'),
        $_GET,
        $_POST,
    );
}

    public function input(
        string $key,
        mixed $default = null
    ): mixed {
        return $this->body[$key]
            ?? $this->query[$key]
            ?? $default;
    }

    public function route(
        string $key,
        mixed $default = null
    ): mixed {
        return $this->params[$key]
            ?? $default;
    }

    /**
     * Create a request containing matched route parameters.
     *
     * @param array<string, string> $params
     */
    public function withRouteParams(
        array $params
    ): self {
        return new self(
            $this->method,
            $this->path,
            $this->query,
            $this->body,
            $params,
        );
    }
}