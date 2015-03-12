<article id="project-<?php echo $page->slug; ?>" class="project">
    <?php include 'templates/header.php'; ?>
    <div class="container-small">
        <p>Archer (an animated series) is pretty cool. But the intro is even more cool. So obviously
        I had to try and recreate it.</p>
        <p>Using a lot of <strong>CSS3 animations</strong> I was able to recreate the clock and plane.</p>
        <p>It should run on most recent browsers, although Internet Explorer seems to struggle with
        the clock-face.</p>

        <p>
            <button
                onclick="archness.parentNode.replaceChild(archness.cloneNode(true), archness);">
                Replay
            </button>
        </p>
    </div>
    <div class="frame-wrap">
        <iframe id="archness" src="/assets/demo/archer/"></iframe>
    </div>
</article>