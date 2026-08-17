<?php

declare(strict_types=1);

namespace Core;

use League\CommonMark\CommonMarkConverter;
use RuntimeException;

final class Documentation
{
    private CommonMarkConverter $converter;

    public function __construct(
        private readonly string $basePath
    ) {
        $this->converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    /**
     * Render a Markdown documentation file.
     */
    public function render(string $file): string
    {
        $path = $this->resolve($file);

        if (!is_file($path)) {
            throw new RuntimeException(
                'Documentation not found: ' . $file,
                404
            );
        }

        $markdown = file_get_contents($path);

        if ($markdown === false) {
            throw new RuntimeException(
                'Unable to read documentation: ' . $file,
                500
            );
        }

        return $this->converter
            ->convert($markdown)
            ->getContent();
    }

    /**
     * Render a documentation topic.
     *
     * Example:
     * /docs/router
     * → router.md
     */
    public function renderTopic(string $topic): string
    {
        $topic = trim($topic, " /");

        if ($topic === '') {
            $topic = 'overview';
        }

        return $this->render($topic . '.md');
    }

    /**
     * Check whether a documentation file exists.
     */
    public function exists(string $file): bool
    {
        try {
            return is_file($this->resolve($file));
        } catch (RuntimeException) {
            return false;
        }
    }

    /**
     * Resolve a documentation file safely.
     */
    private function resolve(string $file): string
    {
        $file = trim($file);

        if ($file === '') {
            throw new RuntimeException(
                'Documentation file cannot be empty.',
                400
            );
        }

        if (!str_ends_with($file, '.md')) {
            throw new RuntimeException(
                'Only Markdown documentation files are allowed.',
                400
            );
        }

        $file = ltrim($file, '/\\');

        if (
            str_contains($file, '..') ||
            str_contains($file, '\\')
        ) {
            throw new RuntimeException(
                'Invalid documentation path.',
                400
            );
        }

        $basePath = realpath($this->basePath);

        if ($basePath === false) {
            throw new RuntimeException(
                'Documentation directory not found.',
                500
            );
        }

        $path = realpath($basePath . DIRECTORY_SEPARATOR . $file);

        if (
            $path === false ||
            !str_starts_with(
                $path,
                $basePath . DIRECTORY_SEPARATOR
            )
        ) {
            throw new RuntimeException(
                'Invalid documentation path.',
                400
            );
        }

        return $path;
    }
}