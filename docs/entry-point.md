# Entry Point

The application entry point is:

```text
public/index.php
```

Every normal web request starts here.

## Basic Entry Point

A minimal entry point looks like this:

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

## What Happens Here?

### 1. Composer is loaded

```php
require dirname(__DIR__) . '/vendor/autoload.php';
```

This makes the framework and Composer dependencies available.

### 2. The framework is booted

```php
$app = Master::boot(dirname(__DIR__));
```

`Master` receives the project root and initializes the framework.

### 3. Routes are registered

```php
$app->router()->get('/', ...);
```

The application tells the Router what should happen for a URL.

### 4. The application runs

```php
$app->run();
```

The framework captures the request, dispatches the Router and sends the
resulting Response.

## Keep the Entry Point Simple

The entry point should mainly:

- Load Composer
- Boot the framework
- Register application routes
- Start the application

Large business logic should not be placed directly in `index.php`.

This keeps the entry point easy to understand.
