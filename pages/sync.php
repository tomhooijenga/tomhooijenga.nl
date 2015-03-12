<article id="project-<?php echo $page->slug; ?>" class="project">
    <?php include "templates/header.php"; ?>
    <div class="container-small">
        <p>
            Sync News is a news platform. Originally it was build as a school project
            to replace the various pin-up boards around the halls. The pin-up boards were
            the main source of information about events and workshops.
        </p>
        <p>
            Sync News replaced those pin-up boards. Around the school are now several
            Raspberry Pi's showing Sync News. The teachers have a single place to manage
            their workshops. The students have a single place to manage their subscriptions.
        </p>
        <p>
            The requirements for Sync News are pretty simple. A stack that runs PHP (>5.4) and some
            sort of database. Because we used Laravel 4.1, it supports all kinds of storage.
        </p>
        <p>
            For rapid front-end development we used Bootstrap. This made Sync News responsive as well.
        </p>
    </div>
    <div class="container-small">
        <figure>
            <a href="/assets/img/sync/sync.png">
                <img src="/assets/img/sync/sync.png" />
            </a>
            <figcaption>
                The home page. The background reflects the actual weather.
            </figcaption>
        </figure>
        <figure>
            <a href="/assets/img/sync/sync_2.png">
                <img src="/assets/img/sync/sync_2.png" />
            </a>
            <figcaption>
                A detail page for a workshop.
            </figcaption>
        </figure>
    </div>
</article>