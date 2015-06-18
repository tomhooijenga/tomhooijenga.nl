<?php

// WEIRD ASS FIX
$_SERVER['REQUEST_METHOD'] = 'GET';

require 'vendor/autoload.php';

$menu = require 'data/menu.php';

$app = new \Slim\Slim([
    'templates.path' => './views'
]);

$app->view()->set('app', $app);
$app->view()->set('menu', $menu);

$app->get('/projects', function () use ($app)
{
    $app->render('template.php');
})->name('projects');

$app->get('/(:page)', function ($page = 'contact') use ($app, $menu)
{
    if (!array_key_exists($page, $menu))
    {
        $app->notFound();
    }

    $app->render('template.php', compact('page'));
})->name('page');

// 404
$app->notFound(function() use ($app)
{
    $app->render('404.php');
});

$app->run();