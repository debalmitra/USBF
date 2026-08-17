<?php

declare(strict_types=1);

namespace Core;

use Throwable;

final class Master
{
    private Router $router;

    private Security $security;

    private View $view;

    private Documentation $documentation;

    private ?Database $database = null;


    /**
     * @param array<string, string> $env
     */
    private function __construct(
        private readonly string $root,
        private readonly array $env
    ) {
        $this->router = new Router();

        $this->security = new Security();

        $this->view = new View(
            $root . '/views'
        );

        $this->documentation = new Documentation(
            $root . '/docs'
        );
    }


    /**
     * Bootstrap the framework.
     */
    public static function boot(string $root): self
    {
        $app = new self(
            $root,
            self::loadEnv(
                $root . '/.env'
            )
        );

        /*
         * Application debug mode.
         */
        $debug = filter_var(
            $app->env['APP_DEBUG'] ?? false,
            FILTER_VALIDATE_BOOL
        );

        ini_set(
            'display_errors',
            $debug ? '1' : '0'
        );

        error_reporting(E_ALL);


        /*
         * Start secure session.
         */
        $app->security->startSession(
            !empty($_SERVER['HTTPS']) &&
            $_SERVER['HTTPS'] !== 'off'
        );

        return $app;
    }


    /**
     * Get the application router.
     */
    public function router(): Router
    {
        return $this->router;
    }


    /**
     * Get the security service.
     */
    public function security(): Security
    {
        return $this->security;
    }


    /**
     * Get the view service.
     */
    public function view(): View
    {
        return $this->view;
    }


    /**
     * Get the documentation service.
     */
    public function docs(): Documentation
    {
        return $this->documentation;
    }


    /**
     * Get the database service.
     *
     * Database connection is created only when required.
     */
    public function db(): Database
    {
        return $this->database ??= new Database(
            $this->env
        );
    }


    /**
     * Run the application.
     */
    public function run(): never
    {
        try {

            $response = $this->router->dispatch(
                Request::capture()
            );

            $response->send();

            exit;

        } catch (Throwable $exception) {

            $status = $exception->getCode();

            if (
                $status < 400 ||
                $status > 599
            ) {
                $status = 500;
            }


            /*
             * Development mode.
             *
             * Show the actual exception message.
             */
            $debug = filter_var(
                $this->env['APP_DEBUG'] ?? false,
                FILTER_VALIDATE_BOOL
            );

            if ($debug) {

                Response::html(
                    '<pre>' .
                    $this->security->escape(
                        $exception->getMessage()
                    ) .
                    '</pre>',
                    $status
                )->send();

                exit;
            }


            /*
             * Production mode.
             *
             * Use framework error pages.
             */
            $view = match ($status) {

                401 => 'errors/401',

                403 => 'errors/403',

                404 => 'errors/404',

                default => 'errors/500',
            };


            $title = match ($status) {

                401 => '401 - Unauthorized',

                403 => '403 - Forbidden',

                404 => '404 - Page Not Found',

                default => '500 - Server Error',
            };


            Response::html(
                $this->view->render(
                    $view,
                    [
                        'title' => $title,
                    ]
                ),
                $status
            )->send();

            exit;
        }
    }


    /**
     * Load environment configuration.
     *
     * @return array<string, string>
     */
    private static function loadEnv(
        string $file
    ): array {
        if (!is_file($file)) {
            return [];
        }

        $values = parse_ini_file(
            $file,
            false,
            INI_SCANNER_TYPED
        ) ?: [];

        return array_map(
            static fn (mixed $value): string =>
                (string) $value,
            $values
        );
    }
}