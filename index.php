<?php

$slug = substr($_SERVER['REQUEST_URI'], 1) ?: 'contact';

$menu = json_decode(file_get_contents(realpath('assets/menu.json')));

$page = page($menu, $slug);

if (strpos($slug, 'admin') === 0)
{
    $template = 'admin';
}
else if(strpos($slug, 'ajax') === 0)
{
    $page = page($menu, substr($slug, 5));

    $template = 'ajax';
}
else if ($page !== null)
{
    $template = 'template';
}
else
{
    $template = '404';
}

require 'templates' . DIRECTORY_SEPARATOR . $template . '.php';

function recursive($callback)
{
    return call_user_func_array($callback, func_get_args());
}

function page($menu, $slug)
{
    return recursive(function($callback, $m, $slug)
    {
        foreach($m as $p)
        {
            if ($p->slug === $slug)
            {
                return $p;
            }
            if (isset($p->children))
            {
                return $callback($callback, $p->children, $slug);
            }
        }
    }, $menu, $slug);
}