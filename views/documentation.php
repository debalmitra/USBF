<div class="container py-5">

 <div class="framework-header">

    <button
        type="button"
        class="btn btn-primary framework-guide-btn"
        data-drawer-open="#frameworkTutorial"
    >
        <i class="bi bi-list me-2"></i>
        Framework Guide
    </button>

    <button
        type="button"
        class="btn btn-outline-secondary framework-theme-btn"
        id="themeToggle"
        title="Change theme"
        aria-label="Change theme"
    >
        <i class="bi bi-moon-stars"></i>
    </button>

</div>
</div>

<?php require __DIR__ . '/framework/guide.php'; ?>