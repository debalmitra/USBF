<?php

declare(strict_types=1);

use Core\Master;
use Core\Request;
use Core\Response;

$guideItems = require dirname(__DIR__, 1)
    . '/config/documentation.php';

require dirname(__DIR__) . '/vendor/autoload.php';

$app = Master::boot(dirname(__DIR__));

/*
 * Framework Documentation
 */
$app->router()->get(
    '/docs/{topic}',
    static function (Request $request) use ($app, $guideItems): Response {

        $topic = (string) $request->route('topic');

        $currentIndex = null;

        foreach ($guideItems as $index => $item) {
            if ($item['id'] === $topic) {
                $currentIndex = $index;
                break;
            }
        }

        if ($currentIndex === null) {
            throw new RuntimeException(
                'Documentation topic not found.',
                404
            );
        }

        $current = $guideItems[$currentIndex];

        $previous = $guideItems[$currentIndex - 1] ?? null;
        $next = $guideItems[$currentIndex + 1] ?? null;

        $html = $app->docs()->render(
            $current['file']
        );

        $navigation = '<div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">';

        /*
         * Previous
         */
        if ($previous !== null) {
            $previousId = htmlspecialchars(
                $previous['id'],
                ENT_QUOTES,
                'UTF-8'
            );

            $previousTitle = htmlspecialchars(
                $previous['title'],
                ENT_QUOTES,
                'UTF-8'
            );

            $navigation .= '
                <a
                    href="./docs/' . $previousId . '"
                    data-turbo-frame="frameworkDocumentation"
                    data-guide-link
                    data-guide-topic="' . $previousId . '"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-arrow-left me-2"></i>
                    ' . $previousTitle . '
                </a>
            ';
        } else {
            $navigation .= '<span></span>';
        }

        /*
         * Next
         */
        if ($next !== null) {
            $nextId = htmlspecialchars(
                $next['id'],
                ENT_QUOTES,
                'UTF-8'
            );

            $nextTitle = htmlspecialchars(
                $next['title'],
                ENT_QUOTES,
                'UTF-8'
            );

            $navigation .= '
                <a
                    href="./docs/' . $nextId . '"
                    data-turbo-frame="frameworkDocumentation"
                    data-guide-link
                    data-guide-topic="' . $nextId . '"
                    class="btn btn-primary"
                >
                    ' . $nextTitle . '
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            ';
        } else {
            $navigation .= '<span></span>';
        }

        $navigation .= '</div>';

        return Response::html(
            '<turbo-frame id="frameworkDocumentation">

                <section class="framework-doc-section animate__animated animate__fadeIn">

                    <div class="container">

                        ' . $html . '

                        ' . $navigation . '

                    </div>

                </section>

            </turbo-frame>'
        );
    }
);

/*
 * Welcome
 */
$app->router()->get(
    '/',
    static function () use ($app): Response {

        return Response::html(
            $app->view()->render(
                'welcome',
                [
                    'title' => 'Welcome to Usoftech Framework',
                ]
            )
        );
    }
);

$app->router()->get(
    '/documentation',
    static function () use ($app): Response {

        return Response::html(
            $app->view()->render(
                'documentation',
                [
                    'title' => 'Documentation',
                    'documentation' => $app->docs(),
                ]
            )
        );
    }
);

$app->run();