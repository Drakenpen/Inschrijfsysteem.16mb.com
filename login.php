<?php
require 'inc/functions.php';
require 'inc/cnx.php';

//blade stuff
require  'vendor/autoload.php';
use Philo\Blade\Blade;

login($link);

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new Blade($views, $cache);


// output everything
echo $blade->view()->make('login')->with($vars)->render();

