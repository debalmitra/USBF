<?php

declare(strict_types=1);

namespace Core;

use RuntimeException;

final class Security
{
    public function startSession(bool $secureCookie): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        session_name('app_session');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => $secureCookie,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        session_start();
    }

    public function csrfToken(): string
    {
        return $_SESSION['_csrf'] ??= bin2hex(random_bytes(32));
    }

    public function verifyCsrf(?string $token): void
    {
        $known = $_SESSION['_csrf'] ?? '';
        if (!is_string($token) || !hash_equals($known, $token)) {
            throw new RuntimeException('Invalid CSRF token.', 419);
        }
    }

    public function escape(string|int|float|null $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, 'UTF-8');
    }

    public function passwordHash(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
