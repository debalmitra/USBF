<div class="container py-5">

 <div class="framework-header">

    <h3 class="fw-bold mb-0">
       <img src="assets/images/favicon/favicon.ico" alt="Framework Logo" class="me-2">
       Usoftech Framework
    </h3>
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


    <!-- Welcome -->
   <div class="welcome-hero text-center py-5">
        <div class="mb-3">
            <span class="badge text-bg-primary px-3 py-2">
                Usoftech Framework 1.0.0
            </span>
        </div>

       <h1 class="welcome-title display-3 fw-bold">
             Welcome to Usoftech Framework
        </h1>

       <p class="welcome-subtitle lead mt-3">
            A lightweight, practical PHP application framework
            designed for simple, maintainable and scalable projects.
        </p>

        <div class="welcome-buttons mt-4 d-flex justify-content-center gap-2">

    <a href="documentation#overview" class="btn btn-primary btn-lg"
    >
        <i class="bi bi-book me-2"></i>
        Learn the Framework
    </a>

    <!--a
        href="https://usoftech.in/"
        target="_blank"
        rel="noopener noreferrer"
        class="btn btn-outline-secondary btn-lg"
    >
        <i class="bi bi-globe me-2"></i>
        Usoftech
    </a-->

</div>

    </div>


    <!-- Concept -->
    <section class="py-5">

        <div class="row justify-content-center">

            <div class="col-lg-9 text-center">

                <h2 class="fw-bold mb-4">
                    Built for Developers Who Value Simplicity
                </h2>

                <p class="lead">
                    Usoftech Framework is a lightweight PHP foundation
                    designed to provide the essential building blocks
                    required for modern web applications without the
                    complexity of a large framework.
                </p>

                <p>
                    The framework provides a clean application structure,
                    routing, request handling, responses, database access,
                    security utilities and a reusable UI foundation.
                    Project-specific functionality is added on top of the
                    framework instead of modifying the foundation.
                </p>

            </div>

        </div>

    </section>


    <!-- Working Flow -->
    <section class="py-5">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                How the Framework Works
            </h2>

            <p class="text-body-secondary">
                A simple request-to-response flow.
            </p>

        </div>

        <div class="row g-3 justify-content-center text-center">

            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 p-3">
                    <i class="bi bi-browser-chrome fs-1 text-primary"></i>
                    <h6 class="mt-3">Browser</h6>
                    <small class="text-body-secondary">
                        HTTP Request
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 p-3">
                    <i class="bi bi-file-code fs-1 text-primary"></i>
                    <h6 class="mt-3">index.php</h6>
                    <small class="text-body-secondary">
                        Entry Point
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 p-3">
                    <i class="bi bi-diagram-3 fs-1 text-primary"></i>
                    <h6 class="mt-3">Router</h6>
                    <small class="text-body-secondary">
                        Route Request
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 p-3">
                    <i class="bi bi-database fs-1 text-primary"></i>
                    <h6 class="mt-3">Database</h6>
                    <small class="text-body-secondary">
                        Application Data
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 p-3">
                    <i class="bi bi-code-square fs-1 text-primary"></i>
                    <h6 class="mt-3">View</h6>
                    <small class="text-body-secondary">
                        Render HTML
                    </small>
                </div>
            </div>

            <div class="col-6 col-md-3 col-lg-2">
                <div class="card h-100 p-3">
                    <i class="bi bi-send fs-1 text-primary"></i>
                    <h6 class="mt-3">Response</h6>
                    <small class="text-body-secondary">
                        HTTP Response
                    </small>
                </div>
            </div>

        </div>

    </section>


    <!-- Core Components -->
    <section class="py-5">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Core Components
            </h2>

            <p class="text-body-secondary">
                Everything necessary, nothing unnecessary.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-4">

                <div class="card h-100 p-4">

                    <i class="bi bi-diagram-3 fs-2 text-primary"></i>

                    <h4 class="mt-3">
                        Router
                    </h4>

                    <p>
                        Maps HTTP requests to application actions
                        using a simple and understandable routing system.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 p-4">

                    <i class="bi bi-arrow-left-right fs-2 text-primary"></i>

                    <h4 class="mt-3">
                        Request & Response
                    </h4>

                    <p>
                        Provides a clean way to capture incoming requests
                        and generate HTML or JSON responses.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 p-4">

                    <i class="bi bi-database fs-2 text-primary"></i>

                    <h4 class="mt-3">
                        Database
                    </h4>

                    <p>
                        Provides a lightweight database layer using
                        Medoo and PDO with MySQL/MariaDB support.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 p-4">

                    <i class="bi bi-shield-check fs-2 text-primary"></i>

                    <h4 class="mt-3">
                        Security
                    </h4>

                    <p>
                        Provides common security utilities including
                        sessions, CSRF protection, escaping and password
                        hashing.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 p-4">

                    <i class="bi bi-layout-text-window fs-2 text-primary"></i>

                    <h4 class="mt-3">
                        View System
                    </h4>

                    <p>
                        Simple PHP views with reusable layouts for
                        clean and maintainable presentation code.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="card h-100 p-4">

                    <i class="bi bi-puzzle fs-2 text-primary"></i>

                    <h4 class="mt-3">
                        Reusable Foundation
                    </h4>

                    <p>
                        Build client applications on top of the framework
                        without repeatedly redesigning the foundation.
                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- UI Stack -->
    <section class="py-5">

        <div class="text-center mb-4">

            <h2 class="fw-bold">
                Base UI & Frontend Stack
            </h2>

        </div>

        <div class="d-flex flex-wrap justify-content-center gap-2">

            <span class="badge text-bg-primary fs-6 p-3">
                Bootstrap
            </span>

            <span class="badge text-bg-secondary fs-6 p-3">
                Bootstrap Icons
            </span>

            <span class="badge text-bg-success fs-6 p-3">
                Shoelace
            </span>

            <span class="badge text-bg-info fs-6 p-3">
                Turbo
            </span>

            <span class="badge text-bg-warning fs-6 p-3">
                Animate.css
            </span>

            <span class="badge text-bg-dark fs-6 p-3">
                Vanilla JavaScript
            </span>

        </div>

    </section>


    <!-- Philosophy -->
    <section class="py-5">

        <div class="row justify-content-center">

            <div class="col-lg-9">

                <div class="card p-4 p-lg-5">

                    <h2 class="fw-bold mb-4">
                        The Usoftech Philosophy
                    </h2>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item px-0">
                            <strong>Keep it lightweight.</strong>
                            Use only what the application actually needs.
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Keep it understandable.</strong>
                            A new developer should be able to understand
                            the framework quickly.
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Build once, reuse many times.</strong>
                            The framework becomes the foundation for
                            multiple projects.
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Separate foundation from application.</strong>
                            Client-specific functionality stays outside
                            the framework core.
                        </li>

                        <li class="list-group-item px-0">
                            <strong>Don't over-engineer.</strong>
                            Add complexity only when there is a real need.
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>


    <!-- Footer message -->
    <section class="text-center py-5">

        <h2 class="fw-bold">
            Ready to Build?
        </h2>

        <p class="text-body-secondary">
            Start with the framework. Build your application on top of it.
        </p>

    </section>
</div>
