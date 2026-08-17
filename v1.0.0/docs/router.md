# Router

The Router connects an HTTP request to application code.

When a request arrives, the Router checks the HTTP method and URL path
and finds the matching route.

## GET Route

Example:

```php
$app->router()->get('/about', function () use ($app): Response {
    return Response::html(
        $app->view()->render('about')
    );
});
```

This means:

- `GET` is the HTTP method.
- `/about` is the URL path.
- The function is executed when the route matches.
- The function returns a Response.

## POST Route

Example:

```php
$app->router()->post(
    '/profile',
    function (Request $request) use ($app): Response {

        // Application logic

        return Response::json([
            'ok' => true,
        ]);
    }
);
```

POST routes are commonly used for state-changing operations.

## Route Responsibility

The Router should answer one question:

> Which application code should handle this request?

Business logic should remain in the application handler or application
service.

Avoid putting large business processes directly into the Router.

## Route Flow

```text
HTTP Request
     ↓
Router
     ↓
Matching Route
     ↓
Application Handler
     ↓
Response
```

The Router is intentionally simple so developers can understand the
request flow quickly.
