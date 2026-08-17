# Application Flow

The framework follows a simple request-to-response flow.

```text
Browser
   ↓
HTTP Request
   ↓
public/index.php
   ↓
Master
   ↓
Request::capture()
   ↓
Router
   ↓
Application Handler
   ↓
Database / Security / View
   ↓
Response
   ↓
Browser
```

## 1. Browser

A browser or API client sends an HTTP request.

Example:

```text
GET /about
```

## 2. `public/index.php`

The public entry point loads Composer and boots the framework.

```php
require dirname(__DIR__) . '/vendor/autoload.php';

$app = Master::boot(dirname(__DIR__));
```

## 3. Master

`Master` prepares the framework services.

It creates the:

- Router
- Security service
- View service
- Documentation service

The database service is created only when it is requested.

## 4. Request

The framework captures the incoming request:

```php
Request::capture()
```

The Request object contains the information needed by the application
to process the request.

## 5. Router

The Router finds the route that matches the request.

Example:

```php
$app->router()->get('/about', function () use ($app): Response {
    return Response::html(
        $app->view()->render('about')
    );
});
```

## 6. Application Handler

The route handler performs the work required by the application.

It may use:

- Request data
- Database
- Security
- Views
- Other application services

## 7. Response

The handler returns a Response.

Example:

```php
return Response::html('<h1>Hello</h1>');
```

Or:

```php
return Response::json([
    'ok' => true,
]);
```

## 8. Browser

The framework sends the Response back to the client.

## Error Flow

If an exception occurs during dispatch, `Master` handles it.

In debug mode, useful exception information can be shown.

In production mode, the framework renders the appropriate error view,
such as:

```text
401
403
404
500
```

The important idea is that the framework keeps the request lifecycle
simple and predictable.
