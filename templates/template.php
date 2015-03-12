<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        Tom Hooijenga
    </title>

    <link rel="stylesheet" href="/assets/css/normalize.css"/>
    <link rel="stylesheet" href="/assets/css/styles.css"/>

    <?php if (isset($_COOKIE['font'])):
        $font = filter_var($_COOKIE['font'], FILTER_SANITIZE_STRING);
        if (in_array($font, ['ttf', 'woff', 'woff2'])): ?>
            <link rel="stylesheet" href="/assets/css/fonts/lato-<?php echo $font; ?>.css"/>
        <?php endif;
    endif; ?>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <nav class="nav-main">
        <?php
        recursive(function ($callback, $m)
        {
            foreach ($m as $p)
            {
                if (isset($p->children))
                {
                    echo '<section>';
                }

                echo "<a href=\"{$p->slug}\">$p->title</a>";

                if (isset($p->children))
                {
                    echo '<nav>';

                    $callback($callback, $p->children);
                    echo '</nav>';
                    echo '</section>';
                }
            }
        }, $menu);
        ?>
    </nav>
    <section class="content <?php echo $slug; ?>">
        <?php include 'pages' . DIRECTORY_SEPARATOR . $page->file; ?>
    </section>

    <script src="/assets/js/modernizr.js"></script>
    <script src="/assets/js/font.js" async="async"></script>
</body>
</html>