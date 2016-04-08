<?php

$templates = './views/';

$menu = require 'data/menu.php';
$uri = $_SERVER['REQUEST_URI'];
$page = trim($uri, '/') ?: 'contact';

if ($page === 'projects' || array_key_exists((string)$page, $menu)) {
    require $templates . DIRECTORY_SEPARATOR . 'template.php';
} else {
    header('HTTP/1.0 404 Not Found');
    require $templates . DIRECTORY_SEPARATOR . '404.php';
}