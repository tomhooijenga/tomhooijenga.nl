<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tom Hooijenga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <link href="/assets/css/styles.css" rel="stylesheet" />

    <!--[if lte IE 9]>
        <script src="/assets/js/classlist-polyfill.js"></script>
        <script src="/assets/js/raf-polyfill.js"></script>
    <![endif]-->
</head>
<body>
    <a href="/projects" class="menu">
        th
        <span>
            menu
        </span>
    </a>

    <nav class="menu-content">
        <?php foreach ($menu as $slug => $_page): ?>
            <?php
                $classes = ['page', $slug];
                if (isset($page) && $slug === $page) $classes[] = 'open';
            ?>
            <section id="<?php echo $slug; ?>" class="<?php echo join(' ', $classes); ?>">
                <h2 class="page-title">
                    <?php echo $_page['title']; ?>
                </h2>
                <div class="page-content">
                    <?php require $templates . DIRECTORY_SEPARATOR . $slug . '.php'; ?>
                </div>
                <a class="page-link" href="/<?php echo $slug; ?>">
                    <?php echo $_page['title']; ?>
                </a>
            </section>
        <?php endforeach; ?>
    </nav>

    <section class="animated">
    </section>

    <?php
        $classes = ['content'];
        if (isset($page)) $classes[] = 'show';
    ?>
    <section class="<?php echo join(' ', $classes) ?>">
        <?php if ($page && $page !== 'projects'): ?>
            <?php require $templates . DIRECTORY_SEPARATOR . $page . '.php' ?>
        <?php endif; ?>
    </section>

    <script src="/assets/js/navigo.js"></script>
    <script src="/assets/js/site.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-27767409-6', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>