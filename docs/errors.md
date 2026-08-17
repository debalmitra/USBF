# Error Handling

Usoftech Framework provides a simple top-level error handling system.

Common HTTP errors have dedicated views:

```text
401 - Unauthorized
403 - Forbidden
404 - Page Not Found
500 - Server Error
```

## Error Views

The views are stored under:

```text
views/errors/
```

Example:

```text
views/errors/
├── 401.php
├── 403.php
├── 404.php
└── 500.php
```

## Development Mode

When:

```ini
APP_DEBUG=true
```

the framework can display exception information to help the developer
find the problem.

## Production Mode

When:

```ini
APP_DEBUG=false
```

the framework renders a professional error page instead of exposing
internal exception details.

## Error Flow

```text
Application Exception
        ↓
Master
        ↓
HTTP Status
        ↓
Error View
        ↓
Response
```

## Customizing Error Pages

An application can customize the appearance and content of its error
views without changing the framework error-handling logic.

## Important Rule

Never expose sensitive internal information in production error pages.

Keep debugging information for development only.
