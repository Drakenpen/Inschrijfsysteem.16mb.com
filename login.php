<?php
require_once 'inc/connection.php';
require_once 'inc/blade.php';


echo $blade->view()->make('login')->with($vars)->render();

if($user->is_loggedin()!="")
{
 $user->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
 $gebruikersnaam = $_POST['txt_gebruikersnaam_email'];
 $email = $_POST['txt_gebruikersnaam_email'];
 $wachtwoord = $_POST['txt_wachtwoord'];
  
 if($user->login($gebruikersnaam,$email,$wachtwoord))
 {
  $user->redirect('home.php');
 }
 else
 {
  echo "Er is iets mis gegaan.</span><br>";
	 $error = true;
 } 
}
?>



 
