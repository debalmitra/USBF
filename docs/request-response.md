# Request & Response

The Request and Response classes form the basic HTTP communication layer.

```text
Browser
   ↓
Request
   ↓
Application
   ↓
Response
   ↓
Browser
```

## Request

The Request represents the incoming HTTP request.

A route can receive it:

```php
$app->router()->post(
    '/profile',
    function (Request $request): Response {

        $name = $request->input('name');

        // Application logic

        return Response::json([
            'name' => $name,
        ]);
    }
);
```

The application should validate incoming data before using it.

## Response

The Response represents what the application sends back.

### HTML

```php
return Response::html(
    '<h1>Hello World</h1>'
);
```

### JSON

```php
return Response::json([
    'success' => true,
]);
```

The type of response depends on the application.

A normal website commonly returns HTML.

An API commonly returns JSON.

## Simple Rule

The Request comes in.

The application processes it.

The Response goes out.

Keeping this separation clear makes the framework easy to understand.
