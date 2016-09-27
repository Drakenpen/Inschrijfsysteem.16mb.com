<?php 

// load neccesary files
require_once 'inc/blade.php';
// pass data
$vars = [
	'pagetitle' => 'memes',
	'name' => 'Samantha', 
	'address' => 'Mijn nieuwe adres',
];

// output everything
echo $blade->view()->make('layout')->with($vars)->render();