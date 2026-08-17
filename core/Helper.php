<?php

declare(strict_types=1);

namespace Core;

final class Helper
{
    public static function assetPath(): string
{
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $basePath = rtrim(dirname(dirname($scriptName)), '/');

    $requestUri = parse_url(
        $_SERVER['REQUEST_URI'] ?? '/',
        PHP_URL_PATH
    );

    $requestPath = trim(
        substr($requestUri, strlen($basePath)),
        '/'
    );

    if ($requestPath === '') {
        return './';
    }

    $segments = array_values(
        array_filter(
            explode('/', $requestPath),
            static fn ($segment) => $segment !== ''
        )
    );

    if (count($segments) <= 1) {
        return './';
    }

    return str_repeat('../', count($segments) - 1);
}
}