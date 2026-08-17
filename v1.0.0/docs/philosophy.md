# Development Philosophy

Usoftech Framework follows one simple principle:

> Build a stable foundation once and build applications on top of it.

## Keep It Lightweight

Use only what the application actually needs.

The framework should not grow just because a large framework has a
feature.

## Keep It Understandable

A new developer should be able to open the project and understand the
basic request flow quickly.

Simple code is easier to maintain.

## Build Once, Reuse Many Times

The framework is intended to become a reusable foundation for multiple
projects.

A useful improvement should benefit more than one application.

## Separate Foundation from Application

The framework provides common services.

The application provides business functionality.

```text
Framework
   ↓
Application
   ↓
Client-specific Features
```

Do not put client-specific business logic into the framework core.

## Don't Over-Engineer

Add complexity only when there is a real need.

A simple solution is often better than a complex abstraction that solves
a problem the application does not have.

## Junior to Senior

The framework should be approachable for a junior developer and still
useful to an experienced developer.

A junior developer should be able to learn the request flow.

An experienced developer should be able to extend the application without
fighting the framework.

## Documentation Should Be Simple Too

The documentation follows the same philosophy as the code:

> Explain the concept, show a useful example, and keep moving.

The goal is not to create a huge manual.

The goal is to help a developer understand the framework and start
building.

## When Should the Framework Change?

Change the framework when the change provides clear reusable value.

Do not redesign the foundation repeatedly for individual projects.

This keeps the framework stable, lightweight and maintainable.
