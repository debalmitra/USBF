# Usoftech Framework

An intentionally small, lightweight PHP 8.2+ application framework designed for simple, maintainable and scalable web applications.

Usoftech Framework provides the essential foundation required to build modern PHP applications without the complexity of a large framework.

The framework uses Medoo over PDO for database access and is designed to be reused as a stable foundation across multiple projects.

> **Build the foundation once. Reuse it across projects.**

---

## Why Usoftech Framework?

Usoftech Framework is designed for developers who want a practical PHP foundation without adopting a large, opinionated application framework.

It focuses on:

- simplicity
- readability
- maintainability
- portability
- reusability
- practical application development

The framework provides the common foundation while leaving application-specific functionality to the application itself.

---

## Features

- PHP 8.2+
- Lightweight custom PHP architecture
- Simple HTTP routing
- Request and Response handling
- Reusable PHP View system
- Header and Footer layouts
- MySQL / MariaDB database support
- Medoo over PDO
- Lazy database initialization
- Environment configuration through `.env`
- Session support
- CSRF protection
- Password hashing
- Output escaping
- Structured HTTP error handling
- 401, 403, 404 and 500 error pages
- Markdown-based framework documentation
- CommonMark documentation rendering
- Dynamic Framework Guide
- Bootstrap UI foundation
- Bootstrap Icons
- Shoelace components
- Turbo
- Animate.css
- Vanilla JavaScript
- Responsive interface
- Light / Dark theme support
- Framework-level theme persistence
- Reusable drawer system
- Application / framework separation

---

## Philosophy

Usoftech Framework is intentionally small.

The goal is not to provide every feature a developer might ever need. The goal is to provide a clean and understandable foundation for building real applications.

### Keep it lightweight

Use only what the application actually needs.

### Keep it understandable

A developer should be able to understand the framework quickly.

### Build once, reuse many times

The framework is designed to become a reusable foundation for multiple projects.

### Separate foundation from application

Client-specific functionality should be built on top of the framework rather than modifying the framework core.

### Don't over-engineer

Complexity should be introduced only when there is a real requirement.

---

## Requirements

- PHP 8.2 or higher
- Composer
- MySQL or MariaDB when database functionality is required
- Apache or Nginx

---

## Installation

### 1. Clone or copy the framework

Place the framework in your development environment.

### 2. Configure the environment

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Set your application and database credentials.

Generate an application key with:

```bash
php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"
```

Then place the generated value in `.env`:

```ini
APP_KEY=your-generated-key
```

Example database configuration:

```ini
APP_DEBUG=true

DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database
DB_USER=your_username
DB_PASSWORD=your_password
DB_PORT=3306
```

Never commit `.env` or real credentials to the repository.

### 3. Install Composer dependencies

Run:

```bash
composer install
```

Then regenerate the autoloader when needed:

```bash
composer dump-autoload
```

### 4. Configure the web server

Configure the web server document root to:

```text
public/
```

For Apache, the framework can use:

```text
public/.htaccess
```

The `public/` directory should be the web-accessible entry point.

---

## Application Flow

A normal request follows a simple request-to-response lifecycle:

```text
Browser
   ↓
public/index.php
   ↓
Master
   ↓
Request
   ↓
Router
   ↓
Application Handler
   ↓
Database / Business Logic
   ↓
View
   ↓
Response
   ↓
Browser
```

The framework keeps this lifecycle explicit and easy to understand.

---

## Entry Point

The public entry point is:

```text
public/index.php
```

A minimal application can bootstrap the framework like this:

```php
<?php

declare(strict_types=1);

use Core\Master;
use Core\Response;

require dirname(__DIR__) . '/vendor/autoload.php';

$app = Master::boot(dirname(__DIR__));

$app->router()->get('/', static function () use ($app): Response {

    return Response::html(
        $app->view()->render(
            'welcome',
            [
                'title' => 'Welcome to Usoftech Framework',
            ]
        )
    );
});

$app->run();
```

---

## Routing

The Router maps HTTP requests to application handlers.

Example:

```php
$app->router()->get('/profile', function () use ($app): Response {

    return Response::html(
        $app->view()->render(
            'profile',
            [
                'title' => 'Profile',
            ]
        )
    );
});
```

A state-changing route can be defined like this:

```php
$app->router()->post(
    '/profile',
    function (Request $request) use ($app): Response {

        $app->security()->verifyCsrf(
            $request->input('_token')
        );

        $app->db()
            ->connection()
            ->insert(
                'profiles',
                [
                    'name' => $request->input('name'),
                ]
            );

        return Response::json([
            'ok' => true,
        ]);
    }
);
```

---

## Request

The Request component captures incoming HTTP request information.

Example:

```php
$name = $request->input('name');
```

Application code should validate and sanitize incoming data according to its requirements.

---

## Response

The Response component creates HTTP responses.

### HTML

```php
return Response::html(
    '<h1>Hello World</h1>'
);
```

### JSON

```php
return Response::json([
    'ok' => true,
]);
```

---

## Master

`Master` is the framework bootstrap and application orchestrator.

It initializes the major framework services:

- Router
- Security
- View
- Documentation
- Database

The database connection remains lazy and is created only when the application requests the database service.

---

## Database

The framework provides a lightweight database layer using **Medoo over PDO** with MySQL / MariaDB support.

Example:

```php
$result = $app->db()
    ->connection()
    ->query('SELECT 1')
    ->fetchColumn();
```

Insert example:

```php
$app->db()
    ->connection()
    ->insert(
        'profiles',
        [
            'name' => $name,
        ]
    );
```

Database configuration is supplied through `.env`.

---

## Views and Layouts

The View system provides simple PHP-based views with reusable layouts.

The presentation flow is:

```text
Layout Header
      ↓
View
      ↓
Layout Footer
```

A typical structure is:

```text
views/
├── layouts/
│   ├── header.php
│   └── footer.php
├── errors/
│   ├── 401.php
│   ├── 403.php
│   ├── 404.php
│   └── 500.php
├── framework/
│   └── guide.php
└── welcome.php
```

This keeps presentation code separate from framework services.

---

## Security

Security is part of the framework foundation.

### Output escaping

Use:

```php
Security::escape()
```

for every untrusted value written into HTML.

Example:

```php
<?= $app->security()->escape($name) ?>
```

Never write untrusted input directly into HTML.

### CSRF protection

Verify CSRF tokens on every cookie-authenticated state-changing route.

Example:

```php
$app->security()->verifyCsrf(
    $request->input('_token')
);
```

This applies to state-changing requests such as:

- POST
- PUT
- PATCH
- DELETE

when cookie-based authentication is used.

### Passwords

Passwords should be stored using secure password hashing.

Never store plain-text passwords.

### Sessions

Session handling is initialized by the framework bootstrap and is available through the Security service.

---

## Environment Configuration

Application configuration is kept outside the source code through `.env`.

Example:

```ini
APP_DEBUG=true

DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database
DB_USER=your_username
DB_PASSWORD=your_password
DB_PORT=3306
```

The `.env` file should never be committed when it contains real credentials.

Use `.env.example` as the safe configuration template for a repository.

---

## Error Handling

The framework provides structured HTTP error handling.

Supported framework error pages include:

```text
401 - Unauthorized
403 - Forbidden
404 - Page Not Found
500 - Server Error
```

### Development mode

When:

```ini
APP_DEBUG=true
```

development errors can expose exception details to assist debugging.

### Production mode

When debug mode is disabled, the framework uses professional error views instead of exposing internal exception details.

Error views are stored under:

```text
views/errors/
```

---

## Documentation

Framework documentation is maintained as Markdown files inside:

```text
docs/
```

The framework uses CommonMark to render the documentation.

The Framework Guide provides a convenient drawer-based navigation system for the documentation.

The guide currently covers topics such as:

1. Overview
2. Requirements
3. Project Structure
4. Application Flow
5. Entry Point
6. Master
7. Router
8. Request & Response
9. Database
10. Views & Layouts
11. Security
12. Environment
13. UI Foundation
14. Error Handling
15. Building an Application
16. Development Philosophy

Documentation can be expanded by adding new Markdown documents and registering them through the framework documentation configuration.

---

## Frontend Foundation

The base UI and frontend foundation uses:

- **Bootstrap**
- **Bootstrap Icons**
- **Shoelace**
- **Turbo**
- **Animate.css**
- **Vanilla JavaScript**

The framework provides reusable frontend behavior including:

- Responsive layouts
- Light / Dark theme switching
- Persistent theme preference
- Shoelace drawers
- Framework Guide navigation
- Smooth animations
- Application preloader
- Mobile-friendly interface

Application-specific JavaScript should remain outside the base framework whenever possible.

---

## Project Structure

A typical project built on the framework follows this structure:

```text
project/
│
├── config/
│
├── core/
│
├── docs/
│
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── assets/
│
├── views/
│   ├── layouts/
│   ├── errors/
│   └── framework/
│
├── vendor/
│
├── .env
├── .env.example
├── composer.json
├── composer.lock
└── README.md
```

The exact application structure may grow according to project requirements.

The important architectural separation is:

```text
Usoftech Framework
        ↓
Application
        ↓
Client-specific Features
```

---

## Framework vs Application

The framework should provide generic functionality.

Applications should contain their own:

- Business logic
- Application-specific database operations
- Controllers or handlers
- Application views
- Authentication and authorization rules
- APIs
- Administration panels
- Client-specific functionality

### Recommended rule

If a feature is required by only one application, keep it in that application.

If a feature is genuinely reusable across multiple applications, consider adding it to the framework.

This keeps the framework small and maintainable.

---

## UI and Application Separation

The base framework provides the common UI foundation.

Application projects can build their own UI on top of it without modifying the framework's core UI unnecessarily.

The base JavaScript is intentionally limited to reusable framework-level behavior such as:

- theme management
- drawer initialization
- framework documentation navigation
- framework initialization
- preloader behavior

Application-specific API and business JavaScript should be maintained separately.

---

## Documentation and Developer Experience

The framework includes a built-in developer guide so a developer can understand the project without having to inspect the source code first.

The guide follows the same architecture used by many established frameworks:

```text
Overview
   ↓
Requirements
   ↓
Structure
   ↓
Flow
   ↓
Core Components
   ↓
Database
   ↓
Views
   ↓
Security
   ↓
Environment
   ↓
UI
   ↓
Errors
   ↓
Application Development
   ↓
Philosophy
```

The goal is to make the framework approachable for both experienced PHP developers and developers who are new to the codebase.

---

## Development Workflow

A typical development workflow is:

```text
1. Install framework
        ↓
2. Configure .env
        ↓
3. Install Composer dependencies
        ↓
4. Configure public/ as web root
        ↓
5. Define routes
        ↓
6. Create views
        ↓
7. Add database functionality when required
        ↓
8. Add application/business logic
        ↓
9. Test
        ↓
10. Deploy
```

The framework should remain the stable foundation throughout the project lifecycle.

---

## Production Recommendations

Before deploying an application:

- Set `APP_DEBUG=false`
- Use strong database credentials
- Keep `.env` outside version control
- Use HTTPS
- Configure the web server to expose only `public/`
- Keep dependencies updated
- Validate all incoming data
- Escape untrusted output
- Verify CSRF tokens on cookie-authenticated state-changing routes
- Use secure password hashing
- Review application-specific authorization rules

---

## Open Source and Third-Party Software

Usoftech Framework can be distributed as an open-source framework.

The framework's own source code should be distributed under the license specified in the repository.

Third-party libraries remain subject to their respective licenses.

The repository should include:

```text
LICENSE
THIRD-PARTY-LICENSES
```

Third-party copyright and license notices must be preserved where required by their licenses.

---

## Version

**Usoftech Framework 1.0.0**

This version represents the stable base architecture intended to be reused for future applications.

The 1.0.0 foundation prioritizes:

- Simplicity
- Maintainability
- Portability
- Understandability
- Reusability
- Practicality

---

## Project Direction

Usoftech Framework is intended to remain a stable foundation.

Future application requirements should normally be implemented on top of the framework rather than repeatedly redesigning the framework itself.

The framework can evolve when a change provides clear reusable value across applications.

---

## Author

**Usoftech**

Usoftech Framework is developed as a reusable PHP foundation for web applications and client projects.

---

## License

See the `LICENSE` file for the complete license text.

See `THIRD-PARTY-LICENSES` for third-party dependency licensing information.
