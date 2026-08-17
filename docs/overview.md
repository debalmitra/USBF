# Overview

## What is Usoftech Framework?

Usoftech Framework is a lightweight PHP application framework designed
to provide the essential foundation required to build web applications.

It is intentionally simple.

The framework provides common functionality such as:

- Application bootstrapping
- HTTP routing
- Request handling
- Response handling
- Database access
- Security utilities
- PHP views
- Reusable layouts
- Environment configuration
- Error handling
- Documentation
- Reusable UI foundation

Application-specific business logic stays outside the framework core.

## The Basic Idea

The framework provides the foundation.

Your application provides the actual functionality.

```text
Usoftech Framework
        ↓
Your Application
        ↓
Client-specific Features
```

The framework should remain stable while applications are built on top
of it.

## How a Request Works

A normal request follows this simple flow:

```text
Browser
   ↓
public/index.php
   ↓
Master
   ↓
Router
   ↓
Application Logic
   ↓
Database / View
   ↓
Response
   ↓
Browser
```

Each part has a simple responsibility.

### `public/index.php`

The entry point of the application.

### `Master`

Bootstraps the framework and provides access to framework services.

### `Router`

Matches the incoming request to application code.

### Application Logic

Contains the functionality required by the application.

### Database

Provides database access when the application needs it.

### View

Generates HTML when a web page is required.

### Response

Sends the final response back to the browser.

## Framework and Application

The most important rule is:

> Keep the framework generic. Keep application logic in the application.

For example, routing is framework functionality:

```php
$app->router()->get('/about', function () use ($app): Response {
    return Response::html(
        $app->view()->render('about')
    );
});
```

But features such as Employee Management, Invoice Processing,
Product Management, and client-specific business rules belong to the
application, not the framework.

## Why Lightweight?

Usoftech Framework does not try to solve every possible problem.

It provides the essential building blocks and leaves the rest to the
application.

This keeps the framework:

- Easy to learn
- Easy to understand
- Easy to modify
- Easy to maintain
- Easy to reuse

A developer should be able to understand the framework without learning
a large ecosystem first.

## Who Can Use It?

Usoftech Framework is designed to be approachable for developers at
different experience levels.

A junior developer can start with the basic request flow and gradually
learn each component.

An experienced developer can use the same simple foundation to build
larger applications without unnecessary framework complexity.

## The Goal

The goal of Usoftech Framework is simple:

> Build a stable foundation once and build applications on top of it.

The framework should evolve only when a change provides genuine reusable
value.

Application-specific requirements should normally remain inside the
application.

## Next

Continue with:

1. Requirements
2. Project Structure
3. Application Flow
4. Entry Point
5. Master
6. Router
7. Request & Response
8. Database
9. Views & Layouts
10. Security
11. Environment
12. UI Foundation
13. Error Handling
14. Building an Application
15. Development Philosophy
