# Requirements

Usoftech Framework is designed to run in a normal PHP development
environment.

## PHP

PHP 8.2 or higher is required.

Check your version:

```bash
php -v
```

## Composer

Composer is used to install the PHP dependencies.

Check Composer:

```bash
composer --version
```

Install dependencies:

```bash
composer install
```

## Database

A database is required when the application uses database functionality.

The framework is designed for:

- MySQL
- MariaDB

Database access uses Medoo over PDO.

Example configuration:

```ini
DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database
DB_USER=your_username
DB_PASSWORD=your_password
DB_PORT=3306
```

## Web Server

The framework can run with Apache, Nginx, or another PHP-compatible web
server.

The recommended document root is:

```text
public/
```

Only the `public/` directory should be exposed to the web.

## Apache

Apache can use:

```text
public/.htaccess
```

The file provides front-controller routing and an additional security
layer.

## Development Environment

The framework does not require one specific development environment.

It can be developed with environments such as:

- XAMPP
- Docker
- PHP built-in development server
- A normal Apache/Nginx PHP server

## Minimum Requirements

```text
PHP        8.2+
Composer   Required
Database   MySQL / MariaDB when needed
Web Server Apache / Nginx
```

That is all that is required to start building an application.
