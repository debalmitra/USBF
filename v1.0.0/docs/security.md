# Security

Security is part of the framework foundation.

The Security service provides common security utilities such as:

- Sessions
- CSRF protection
- Output escaping
- Password hashing

The application is still responsible for its own authorization and
business security rules.

## Output Escaping

Untrusted values should be escaped before they are written into HTML.

Example:

```php
<?= $app->security()->escape($name) ?>
```

This helps prevent HTML and script injection through user-controlled
values.

## CSRF Protection

Cookie-authenticated state-changing requests should verify a CSRF token.

Example:

```php
$app->security()->verifyCsrf(
    $request->input('_token')
);
```

Use this for state-changing routes such as POST, PUT, PATCH and DELETE
when cookie-based authentication is used.

## Passwords

Never store plain-text passwords.

Use secure password hashing through PHP/framework security utilities.

## Sessions

The framework starts the session during application boot through the
Security service.

Application code can then use session functionality when required.

## Authentication vs Authorization

Authentication answers:

> Who is the user?

Authorization answers:

> What is this user allowed to do?

The framework provides security building blocks, but application-specific
roles and permissions belong to the application.

## Simple Rule

Validate incoming data.

Escape output.

Protect state-changing cookie-authenticated requests with CSRF.

Use secure password hashing.

Keep credentials outside source code.
