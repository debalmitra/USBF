# UI Foundation

Usoftech Framework includes a lightweight reusable frontend foundation.

The current UI stack includes:

- Bootstrap
- Bootstrap Icons
- Shoelace
- Turbo
- Animate.css
- Vanilla JavaScript

## Bootstrap

Bootstrap provides the basic responsive layout and utility system.

Example:

```html
<div class="container">
    <div class="row">
        <div class="col-md-6">
            Content
        </div>
    </div>
</div>
```

## Bootstrap Icons

Bootstrap Icons provide the framework icon set.

Example:

```html
<i class="bi bi-house"></i>
```

## Shoelace

Shoelace provides reusable Web Components.

The framework currently uses it for components such as the Framework
Guide drawer.

Example:

```html
<sl-drawer
    id="frameworkTutorial"
    label="Framework Guide"
>
    Documentation
</sl-drawer>
```

## Theme

The framework supports light and dark themes.

The selected theme is stored in browser local storage.

The framework applies the theme to both Bootstrap and Shoelace.

## Animate.css

Animate.css is used for simple reusable animations.

Example:

```html
<div class="animate__animated animate__fadeIn">
    Content
</div>
```

## Vanilla JavaScript

The base `app.js` contains only reusable framework-level behavior.

Examples include:

- Theme switching
- Drawer initialization
- Framework Guide navigation
- Preloader behavior
- Framework initialization

Application-specific JavaScript should normally be kept separate.

## Keep the UI Lightweight

The framework provides a common UI foundation.

Applications can add their own CSS, JavaScript and components without
turning the framework core into an application-specific UI library.
