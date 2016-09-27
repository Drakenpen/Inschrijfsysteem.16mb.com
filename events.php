<?php
require_once'inc/connection.php';
require_once 'inc/blade.php';

	// haal events uit de database mbv PDO
	$statement = $db->prepare('SELECT * FROM events;');
	$statement->execute();
	$events = $statement->fetchAll(PDO::FETCH_ASSOC);

// geef de gevonden events door aan de view

	echo $blade->view()->make('events')
		->with('events', $events);

