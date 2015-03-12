<article id="project-<?php echo $page->slug; ?>" class="project">
    <?php include 'templates/header.php'; ?>
    <div class="container-small">
        <p>This <strong>JavaScript calculator</strong> was a simple project to
            explore JavaScript's prototype system.</p>

        <p>The calculator features a clean design, based on typography. It is easily
            customized through CSS. The design is also fully responsive, giving almost a
            native feel on mobile devices.</p>
        <p>And what is an app that is not offline available? Nothing! So the demo-page is, once visited,
        available without any internet connection. And the final feature: this app is pinnable to the home screen.</p>

        <p>
            <a href="/assets/demo/calc/">Full page demo</a>
            &ndash;
            <a href="https://github.com/tomhooijenga/calc">Source</a>
        </p>

    </div>
    <div class="frame-wrap">
        <iframe id="calcframe" src="http://tomhooijenga.nl/calculator/" width="100%"></iframe>
    </div>
</article>