# Environment

Environment configuration keeps machine-specific and sensitive settings
outside the application source code.

The framework reads configuration from:

```text
.env
```

## Example

```ini
APP_DEBUG=true

DB_TYPE=mysql
DB_HOST=127.0.0.1
DB_NAME=your_database
DB_USER=your_username
DB_PASSWORD=your_password
DB_PORT=3306
```

## Debug Mode

During development:

```ini
APP_DEBUG=true
```

can be used to help diagnose errors.

For production:

```ini
APP_DEBUG=false
```

This prevents internal exception details from being shown to users.

## Database Credentials

Database credentials belong in `.env`.

Do not write them directly into:

```text
index.php
core/
views/
```

## `.env.example`

The repository should contain a safe example configuration:

```text
.env.example
```

Developers can copy it:

```bash
cp .env.example .env
```

Then fill in their own values.

## Never Commit Secrets

Real `.env` files containing credentials should not be committed to
Git.

The `.gitignore` file should protect them.

The web server should also prevent direct access to `.env`.

## Environment Responsibility

The framework loads environment values.

The application decides which application settings it needs.

Keep environment configuration simple and predictable.
