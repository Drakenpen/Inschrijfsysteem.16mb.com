<?php 
	$mysqlhost = 'mysql.hostinger.nl';
	$mysqldb = 'u340186610_db';
	$mysqluser = 'u340186610_memai';
	$mysqlpass = 'rt2Cg+pz6Q';
	

	try
{
	//connection to db
	$db = new PDO('mysql:host='. $mysqlhost.';dbname='.$mysqldb.';charset=utf8mb4', $mysqluser, $mysqlpass);    	
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}
	



include_once 'class.user.php';
$user = new USER($DB_con);
	