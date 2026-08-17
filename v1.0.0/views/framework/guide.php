<?php

declare(strict_types=1);

use Core\Documentation;

/** @var Documentation $documentation */

$guideItems = require dirname(__DIR__, 2)
    . '/config/documentation.php';
?>

<sl-drawer
    label="Framework Guide"
    placement="start"
    id="frameworkTutorial"
    style="--size: min(380px, 90vw);"
>

    <div class="mb-4">

        <div class="fw-bold fs-5">
            Usoftech Framework
        </div>

        <small class="text-body-secondary">
            Developer Guide · Version 1.0.0
        </small>

    </div>

    <sl-divider></sl-divider>

    <nav class="framework-guide-menu">

       <?php foreach ($guideItems as $item): ?>

    <a
    href="./docs/<?= htmlspecialchars(
        $item['id'],
        ENT_QUOTES,
        'UTF-8'
    ) ?>"
    data-turbo-frame="frameworkDocumentation"
    data-guide-link
    data-guide-topic="<?= htmlspecialchars(
        $item['id'],
        ENT_QUOTES,
        'UTF-8'
    ) ?>"
>

        <i class="bi <?= htmlspecialchars(
            $item['icon'],
            ENT_QUOTES,
            'UTF-8'
        ) ?>"></i>

        <span>
            <?= htmlspecialchars(
                $item['title'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </span>

    </a>

<?php endforeach; ?>
    </nav>

    <div slot="footer">

        <button
            type="button"
            class="btn btn-secondary w-100"
            onclick="document.querySelector('#frameworkTutorial').hide()"
        >
            Close
        </button>

    </div>

</sl-drawer>


<!-- Framework Documentation -->

<div class="framework-documentation">

    <turbo-frame
        id="frameworkDocumentation"
        src="./docs/overview"
    >
        <div class="container py-5 text-center">
            Loading documentation...
        </div>
    </turbo-frame>

</div>