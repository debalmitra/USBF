<?php

declare(strict_types=1);

namespace Core;

use RuntimeException;

final class Router
{
    /** @var list<Route> */
    private array $routes = [];

    /** @param callable(Request): Response $handler */
    public function get(string $path, callable $handler): self
    {
        return $this->add('GET', $path, $handler);
    }

    /** @param callable(Request): Response $handler */
    public function post(string $path, callable $handler): self
    {
        return $this->add('POST', $path, $handler);
    }

    /** @param callable(Request): Response $handler */
    public function add(
        string $method,
        string $path,
        callable $handler
    ): self {
        $this->routes[] = new Route(
            strtoupper($method),
            '/' . trim($path, '/'),
            $handler
        );

        return $this;
    }

    public function dispatch(Request $request): Response
    {
        foreach ($this->routes as $route) {

            if ($route->method !== $request->method) {
                continue;
            }

            $params = $this->match(
                $route->path,
                $request->path
            );

            if ($params === null) {
                continue;
            }

            $request = $request->withRouteParams($params);

            return ($route->handler)($request);
        }

        throw new RuntimeException(
            'Route not found.',
            404
        );
    }

    /**
     * Match a route pattern against the requested path.
     *
     * Example:
     *
     * /docs/{topic}
     *
     * matches:
     *
     * /docs/installation
     *
     * and returns:
     *
     * [
     *     'topic' => 'installation',
     * ]
     *
     * @return array<string, string>|null
     */
    private function match(
        string $routePath,
        string $requestPath
    ): ?array {
        $routeSegments = $this->segments($routePath);
        $requestSegments = $this->segments($requestPath);

        if (count($routeSegments) !== count($requestSegments)) {
            return null;
        }

        $params = [];

        foreach ($routeSegments as $index => $segment) {

            $requestSegment = $requestSegments[$index];

            /*
             * Dynamic route parameter.
             *
             * Example:
             *
             * {topic}
             */
            if (
                str_starts_with($segment, '{') &&
                str_ends_with($segment, '}')
            ) {
                $name = trim(
                    $segment,
                    '{}'
                );

                if ($name === '') {
                    return null;
                }

                $params[$name] = urldecode(
                    $requestSegment
                );

                continue;
            }

            /*
             * Static route segment.
             */
            if ($segment !== $requestSegment) {
                return null;
            }
        }

        return $params;
    }

    /**
     * Split a URL path into clean segments.
     *
     * @return list<string>
     */
    private function segments(string $path): array
    {
        $path = trim($path, '/');

        if ($path === '') {
            return [];
        }

        return explode('/', $path);
    }
}