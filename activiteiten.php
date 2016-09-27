<?php
require 'inc/functions.php';
require 'inc/cnx.php';
require_once 'inc/blade.php';

require  'vendor/autoload.php';
use Philo\Blade\Blade;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new Blade($views, $cache);

// pass data
$vars = [
	'pagetitle' => 'memes',
	'name0' => 'Activiteit', 
	'name1' => 'Activiteit',
	'name2' => 'Activiteit',
	'name3' => 'Activiteit',
	'name4' => 'Activiteit',
];

// output everything
echo $blade->view()->make('activiteiten')->with($vars)->render();