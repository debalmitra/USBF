<?php

declare(strict_types=1);

namespace Core;

final class View
{
    public function __construct(
        private readonly string $basePath
    ) {
    }

    public function render(
        string $view,
        array $data = []
    ): string {
        $viewFile = $this->basePath . '/' . $view . '.php';
        $header = $this->basePath . '/layouts/header.php';
        $footer = $this->basePath . '/layouts/footer.php';

        if (!is_file($viewFile)) {
            throw new \RuntimeException(
                'View not found: ' . $view,
                500
            );
        }

        if (!is_file($header)) {
            throw new \RuntimeException(
                'Layout header not found.',
                500
            );
        }

        if (!is_file($footer)) {
            throw new \RuntimeException(
                'Layout footer not found.',
                500
            );
        }

        extract($data, EXTR_SKIP);

        ob_start();

        require $viewFile;

        $content = ob_get_clean();

        ob_start();

        require $header;

        echo $content;

        require $footer;

        return ob_get_clean();
    }
}