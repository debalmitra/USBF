# Views & Layouts

The View system provides simple PHP views with reusable layouts.

The goal is to keep presentation code easy to read.

## Basic Structure

A common structure is:

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
└── welcome.php
```

## Rendering a View

A route can render a view like this:

```php
return Response::html(
    $app->view()->render(
        'welcome',
        [
            'title' => 'Welcome',
        ]
    )
);
```

The second argument contains data passed to the view.

## Using Data

Inside the PHP view:

```php
<h1>
    <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
</h1>
```

Always escape untrusted output.

## Layouts

The View service combines:

```text
Header
   ↓
View Content
   ↓
Footer
```

This avoids repeating the same HTML structure on every page.

## Why PHP Views?

PHP views are simple and require no separate template language.

A developer who knows PHP can understand the view immediately.

## Application Views

Application-specific pages belong in the application's view structure.

The framework should provide the View system and reusable framework
layouts, while the application provides its own page content.
