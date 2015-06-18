<article class="contact">
    <div class="container clearfix">
        <h1>Hello!</h1>
        <p>
            My name is Tom Hooijenga. I am a dutch software engineer that loves
            working with interactivity and animations. Most of my hobby-projects
            are built with JavaScript, HTML, CSS and some PHP.
        </p>

        <p>
            Currently I work with <a href="http://www.oculustechnologies.nl/" target="_blank">Oculus Technologies</a>
            to build on their brand new platform. My job consists mostly of making
            interactive user-interfaces. I build these in C# with WPF.
        </p>
        <p>
            If you have a question or just want to say hi, shoot me a mail anytime
            &rarr; <a href="mailto:info@tomhooijenga.nl">info@tomhooijenga.nl</a>
        </p>
        <h2>Content</h2>
        <nav>
            <?php foreach ($menu as $slug => $_page): ?>
                <a href="<?php echo $app->urlFor('page', ['page' => $slug]); ?>" class="container">
                    <?php echo $_page['title']; ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </div>
</article>
