<?php 

// load neccesary files
require 'vendor/autoload.php';
include 'views/header.blade.php';
use Philo\Blade\Blade;

// configure blade engine
$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new Blade($views, $cache);

// pass data
$vars = [
	'pagetitle' => 'memes',
	'name' => 'Samantha', 
	'address' => 'Mijn nieuwe adres',
];

// output everything
echo $blade->view()->make('layout')->with($vars)->render();