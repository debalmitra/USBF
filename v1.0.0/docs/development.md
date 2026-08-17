# Building an Application

Usoftech Framework provides the foundation.

Your application provides the functionality.

## Start with the Entry Point

Begin with:

```text
public/index.php
```

Boot the framework:

```php
$app = Master::boot(dirname(__DIR__));
```

## Add a Route

For example:

```php
$app->router()->get('/about', function () use ($app): Response {

    return Response::html(
        $app->view()->render('about')
    );
});
```

## Create a View

Create:

```text
views/about.php
```

Then add the HTML needed for the page.

The View service can render it:

```php
$app->view()->render('about');
```

## Add Database Functionality

When the application needs data:

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

Keep application-specific database logic in the application.

## Add Business Logic

Business rules belong to the application.

Examples:

```text
Employee management
Billing
Inventory
Orders
Customer management
Reports
```

The framework should not know what these things mean.

## Keep the Framework Stable

A useful rule is:

> If a feature belongs to one application, keep it in that application.

If the same functionality is genuinely useful across many applications,
then it can be considered for the framework.

## Recommended Workflow

```text
1. Define the application requirement
2. Add the route
3. Capture the request
4. Validate input
5. Apply business logic
6. Use the database when required
7. Render a view or return JSON
8. Test the result
```

The framework should make this workflow easy without forcing unnecessary
architecture.
