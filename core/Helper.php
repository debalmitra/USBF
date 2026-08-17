<?php

declare(strict_types=1);

namespace Core;

final class Helper
{
    public static function assetPath(): string
{
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';

    /*
     * Application base path.
     *
     * Example:
     * /products/usoftech_cms/v1.0/UCMS/public/index.php
     *
     * becomes:
     * /products/usoftech_cms/v1.0/UCMS
     */
    $basePath = dirname(
        dirname(
            str_replace('\\', '/', $scriptName)
        )
    );

    $basePath = rtrim($basePath, '/');

    $requestPath = parse_url(
        $_SERVER['REQUEST_URI'] ?? '/',
        PHP_URL_PATH
    );

    $requestPath = str_replace('\\', '/', (string) $requestPath);

    /*
     * Remove application base path.
     */
    if (
        $basePath !== ''
        && str_starts_with($requestPath, $basePath)
    ) {
        $requestPath = substr(
            $requestPath,
            strlen($basePath)
        );
    }

    /*
     * Application root.
     */
    if ($requestPath === '' || $requestPath === '/') {
        return './';
    }

    /*
     * Remember whether the URL represents a directory.
     */
    $isDirectory = str_ends_with($requestPath, '/');

    $requestPath = trim($requestPath, '/');

    if ($requestPath === '') {
        return './';
    }

    $segments = array_values(
        array_filter(
            explode('/', $requestPath),
            static fn ($segment) => $segment !== ''
        )
    );

    $depth = count($segments);

    /*
     * For a normal URL such as:
     *
     * /admin/login
     *
     * "login" is treated as the current resource,
     * therefore we need one level up.
     */
    if (!$isDirectory) {
        $depth--;
    }

    if ($depth <= 0) {
        return './';
    }

    return str_repeat('../', $depth);
}
}