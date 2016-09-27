<?php 
	$mysqlhost = 'mysql.hostinger.nl';
	$mysqldb = 'u340186610_db';
	$mysqluser = 'u340186610_memai';
	$mysqlpass = 'rt2Cg+pz6Q';
	
	//connection to db
		$db = new PDO('mysql:host='. $mysqlhost.';dbname='.$mysqldb.';charset=utf8mb4', $mysqluser, $mysqlpass);
		return $db;
	
	