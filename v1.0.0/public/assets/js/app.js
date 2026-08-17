/**
 * Usoftech Framework
 * Base Application JavaScript
 *
 * Contains only reusable framework-level functionality.
 */

/* ==================================================
   Preloader
================================================== */

function initPreloader() {
  const preloader = document.querySelector("#appPreloader");

  if (!preloader) {
    return;
  }

  preloader.classList.add("animate__animated", "animate__fadeOut");

  preloader.addEventListener(
    "animationend",
    () => {
      preloader.remove();
    },
    { once: true },
  );
}

/* ==================================================
   Theme
================================================== */

/**
 * Initialize framework theme.
 */
function initTheme() {
  const button = document.querySelector("#themeToggle");

  const savedTheme = localStorage.getItem("app-theme") || "light";

  applyTheme(savedTheme, button);

  if (!button) {
    return;
  }

  button.addEventListener("click", () => {
    const current =
      document.documentElement.getAttribute("data-bs-theme") || "light";

    const nextTheme = current === "dark" ? "light" : "dark";

    applyTheme(nextTheme, button);
  });
}

/**
 * Apply Bootstrap and Shoelace theme.
 */
function applyTheme(theme, button = null) {
  if (theme !== "dark" && theme !== "light") {
    theme = "light";
  }

  /*
   * Bootstrap theme
   */

  document.documentElement.setAttribute("data-bs-theme", theme);

  /*
   * Shoelace theme
   */

  document.documentElement.classList.toggle("sl-theme-dark", theme === "dark");

  document.documentElement.classList.toggle(
    "sl-theme-light",
    theme === "light",
  );

  /*
   * Theme toggle icon
   */

  if (button) {
    const icon = button.querySelector("i");

    if (icon) {
      icon.className = theme === "dark" ? "bi bi-sun" : "bi bi-moon-stars";
    }
  }

  /*
   * Save preference
   */

  localStorage.setItem("app-theme", theme);
}

/* ==================================================
   Drawers
================================================== */

/**
 * Initialize framework drawers.
 *
 * Example:
 *
 * <button
 *     data-drawer-open="#frameworkTutorial"
 * >
 *     Framework Guide
 * </button>
 */
function initDrawers() {
  document.addEventListener("click", function (event) {
    const button = event.target.closest("[data-drawer-open]");

    if (!button) {
      return;
    }

    const selector = button.getAttribute("data-drawer-open");

    if (!selector) {
      return;
    }

    const drawer = document.querySelector(selector);

    if (drawer) {
      drawer.show();
    }
  });
}

/* ==================================================
   Framework Guide
================================================== */

/**
 * Initialize Framework Guide navigation.
 *
 * Clicking a documentation topic closes
 * the drawer before navigating to the section.
 */

function initGuideLinks() {
  document.addEventListener("click", function (event) {
    const link = event.target.closest("[data-guide-link]");

    if (!link) {
      return;
    }

    /*
     * Remove active state from all guide links.
     */
    document.querySelectorAll("[data-guide-link]").forEach((item) => {
      item.classList.remove("active");
    });

    /*
     * Set active state on clicked link.
     */
    link.classList.add("active");

    /*
     * Update documentation history.
     */
    const topic = link.getAttribute("data-guide-topic");

    if (topic) {
      history.pushState({}, "", `#framework-${topic}`);
    }

    /*
     * Close documentation drawer.
     */
    const drawer = document.querySelector("#frameworkTutorial");

    if (drawer) {
      drawer.hide();
    }
  });
}

function initDocumentationHistory() {
  window.addEventListener("popstate", function () {
    const hash = window.location.hash;

    if (!hash.startsWith("#framework-")) {
      return;
    }

    const topic = hash.replace("#framework-", "");

    if (!topic) {
      return;
    }

    const frame = document.querySelector("#frameworkDocumentation");

    if (!frame) {
      return;
    }

    frame.src = `./docs/${topic}`;
  });
}

/* ==================================================
   Framework Initialization
================================================== */

/**
 * Initialize all framework functionality.
 */
function initFramework() {
  initPreloader();

  initTheme();

  initDrawers();

  initGuideLinks();

  initDocumentationHistory();
}

/* ==================================================
   Start Framework
================================================== */

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initFramework);
} else {
  initFramework();
}

document.addEventListener("turbo:frame-load", function (event) {
  const frame = event.target;

  if (frame.id !== "frameworkDocumentation") {
    return;
  }

  const section = frame.querySelector(".framework-doc-section");

  if (!section) {
    return;
  }

  section.scrollIntoView({
    behavior: "smooth",
    block: "start",
  });
});
