<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? $title : "Tom Hooijenga"; ?></title>

    <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/icons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/img/icons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/icons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/icons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/img/icons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/img/icons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/img/icons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/assets/img/icons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/assets/img/icons/favicon-194x194.png" sizes="194x194">
    <link rel="icon" type="image/png" href="/assets/img/icons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/assets/img/icons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/assets/img/icons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/assets/img/icons/manifest.json">
    <link rel="shortcut icon" href="/assets/img/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-TileImage" content="/assets/img/icons/mstile-144x144.png">
    <meta name="msapplication-config" content="/assets/img/icons/browserconfig.xml">
    <meta name="theme-color" content="#034485">

    <link href="/assets/css/normalize.css" rel="stylesheet" />
    <link href="/assets/css/styles.css" rel="stylesheet" id="fancy" />
    <script src="/assets/js/modernizr.js"></script>
</head>
<body>
    <div class="menu">
        <a href="<?php echo $app->urlFor('projects'); ?>" class="menu-button">
            th
        </a>
    </div>

    <nav class="menu-content">
        <?php foreach ($menu as $slug => $_page): ?>
            <?php
                $classes = ['page', $slug];
                if (isset($page) && $slug === $page) $classes[] = 'open';
            ?>
            <div id="<?php echo $slug; ?>" class="<?php echo join(' ', $classes); ?>">
                <?php echo $app->view()->fetch($slug . '.php'); ?>
                <a href="<?php echo $app->urlFor('page', ['page' => $slug]); ?>">
                    <?php echo $_page['title']; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </nav>

    <div class="animated">
    </div>

    <?php
        $classes = ['content'];
        if (isset($page)) $classes[] = 'show';
    ?>
    <div class="<?php echo join(' ', $classes) ?>">
        <?php if (isset($page)): ?>
            <?php echo $app->view()->fetch($page . '.php'); ?>
        <?php endif; ?>
    </div>

    <script>
        if (!document.addEventListener)
        {
            document.querySelector('head').removeChild(document.querySelector('#fancy'));
        }
        Modernizr.load({
            test: !!document.addEventListener,
            yep: ['assets/js/evt.js', 'assets/js/site.js'],
            nope: 'assets/css/boring.css'
        });
        Modernizr.load({
            test: !!document.addEventListener && Modernizr.classList,
            nope: ['/assets/js/classlist-polyfill.js']
        });
    </script>
</body>
</html>