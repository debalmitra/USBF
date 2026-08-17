# Project Structure

Usoftech Framework keeps the project structure simple.

A typical project looks like this:

```text
project/
│
├── config/
├── core/
├── docs/
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── assets/
├── views/
│   ├── layouts/
│   ├── errors/
│   └── framework/
├── vendor/
│
├── .env
├── .env.example
├── composer.json
├── composer.lock
└── README.md
```

## `core/`

Contains the reusable framework classes.

Examples include:

```text
Master
Router
Request
Response
View
Security
Database
Documentation
```

Application-specific business logic should not be placed here unless it
is genuinely reusable framework functionality.

## `config/`

Contains application configuration that is safe to keep outside the
framework core.

For example, documentation configuration can define the available guide
topics.

## `docs/`

Contains the framework documentation in Markdown format.

Example:

```text
docs/
├── overview.md
├── requirements.md
├── structure.md
└── ...
```

## `public/`

This is the web-accessible directory.

The main entry point is:

```text
public/index.php
```

Static assets are also served from here.

The web server should point to `public/` rather than the project root.

## `views/`

Contains PHP views and reusable layouts.

A simple layout structure is:

```text
views/
├── layouts/
│   ├── header.php
│   └── footer.php
├── errors/
└── welcome.php
```

## `vendor/`

Contains Composer-managed third-party PHP dependencies.

Do not edit files inside `vendor/` manually.

Run Composer again when dependencies need to be installed or updated.

## `.env`

Contains environment-specific settings such as database credentials.

Do not commit real credentials to source control.

## The Important Rule

Keep this separation:

```text
Framework Core
      ↓
Application Code
      ↓
Client-specific Features
```

The structure may grow as an application grows, but the basic separation
should remain clear.
