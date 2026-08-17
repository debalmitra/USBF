# Master

`Master` is the main framework bootstrap and application orchestrator.

It prepares the services used by the application.

## Main Services

The current framework exposes:

```text
Router
Security
View
Documentation
Database
```

Example:

```php
$app = Master::boot(dirname(__DIR__));

$app->router();
$app->security();
$app->view();
$app->docs();
$app->db();
```

The application only asks for the service it needs.

## Booting the Framework

The framework starts with:

```php
$app = Master::boot(dirname(__DIR__));
```

During boot, the framework:

1. Loads `.env`
2. Configures PHP error reporting
3. Starts the session through the Security service
4. Creates the Router
5. Creates the Security service
6. Creates the View service
7. Creates the Documentation service

## Database

The database is lazy.

This means the database object is created only when the application calls:

```php
$app->db();
```

This keeps framework startup lightweight.

## Running the Application

The application finishes the entry point with:

```php
$app->run();
```

`run()` captures the Request, dispatches the Router and sends the Response.

## Error Handling

`Master` also provides the top-level exception boundary.

In development mode, the exception message can be displayed.

In production mode, framework error views are used:

```text
views/errors/401.php
views/errors/403.php
views/errors/404.php
views/errors/500.php
```

## Keep Master Generic

`Master` belongs to the framework.

It should not contain client-specific business logic.

Its job is to bootstrap and coordinate the framework.
