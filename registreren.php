<?php
require 'inc/functions.php';
require 'inc/cnx.php';

//blade stuff
require  'vendor/autoload.php';
use Philo\Blade\Blade;

(check($link));
	insert_user_into_db($link);

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new Blade($views, $cache);


// output everything
echo $blade->view()->make('registreren')->with($vars)->render();