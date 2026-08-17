<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars(
            $title ?? 'Usoftech Framework',
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </title>
<?php
use Core\Helper;

$assetPath = $assetPath ?? Helper::assetPath();

?>
    <link rel="icon"
          href="./assets/images/favicon/favicon.ico"
          type="image/x-icon">

<script>
  (() => {
    const theme =
      localStorage.getItem("app-theme") || "light";

    document.documentElement.setAttribute(
      "data-bs-theme",
      theme
    );

    document.documentElement.classList.toggle(
      "sl-theme-dark",
      theme === "dark"
    );

    document.documentElement.classList.toggle(
      "sl-theme-light",
      theme === "light"
    );
  })();
</script>

    <link rel="stylesheet"
          href="./assets/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet"
          href="./assets/vendor/bootstrap-icons/css/bootstrap-icons.min.css">

    <link rel="stylesheet"
          href="./assets/vendor/shoelace/themes/light.css">

    <link rel="stylesheet"
          href="./assets/vendor/shoelace/themes/dark.css">

    <link rel="stylesheet"
          href="./assets/css/app.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>

<div id="appPreloader" aria-hidden="true">
    <div class="spinner-border text-primary"
         role="status">
        <span class="visually-hidden">
            Loading...
        </span>
    </div>
</div>