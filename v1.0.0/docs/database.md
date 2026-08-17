# Database

Usoftech Framework provides a lightweight database layer using Medoo over
PDO.

The framework is designed for MySQL and MariaDB applications.

## Configuration

Database settings are stored in `.env`.

Example:

```ini
DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database
DB_USER=your_username
DB_PASSWORD=your_password
DB_PORT=3306
```

Do not place database passwords directly in application source code.

## Getting the Database

The application can access the database through:

```php
$app->db()
```

The database is lazy, so the connection is not created until the
application requests the database service.

## Query Example

```php
$result = $app->db()
    ->connection()
    ->query('SELECT 1')
    ->fetchColumn();
```

## Insert Example

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

## Database Responsibility

The framework provides database access.

The application decides:

- What tables it needs
- What data it stores
- What queries it needs
- What business rules apply

Client-specific database logic should remain in the application.

## Keep It Simple

The framework does not force a large ORM architecture.

Use the database layer directly when that is the simplest solution.

As an application grows, its own database or repository structure can
be added without changing the framework foundation.
