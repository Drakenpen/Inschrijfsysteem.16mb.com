<?php
//require 'inc/functions.php';
require_once'inc/connection.php';
require_once 'inc/blade.php';



//bizmo
    if ( isset ($_POST['submit'])){
    	$email = mysqli_real_escape_string($link, $_POST['email']);
		$voornaam = mysqli_real_escape_string($link, $_POST['voornaam']);
		$prefix = mysqli_real_escape_string($link, $_POST['voorvoegsel']);
		$achternaam = mysqli_real_escape_string($link, $_POST['achternaam']);
		$wachtwoord = mysqli_real_escape_string($link, md5($_POST['wachtwoord']));
		$wachtwoord2 = mysqli_real_escape_string($link,  md5($_POST['wachtwoord2']));
		$error = false;

		if ( empty($email) )
		{
		echo "Vul een email adres in!</span><br>";
		$error = true;
		}

		if ( empty($voornaam) )
		{
		echo "Voeg een voornaam toe!</span><br>";
		$error = true;
		}

		if ( empty($achternaam) )
		{
		echo "Voeg een achternaam toe!</span><br>";
		$error = true;
		}

		if ( empty($wachtwoord) )
		{
		  echo "Vul een wachtwoord in!</span><br>";
		  $error = true;
		}
		if ( empty($wachtwoord2) )
		{
		  echo "Herhaal je wachtwoord!</span><br>";
		  $error = true;
		}
		if ( $wachtwoord != $wachtwoord2 )
		{
		  echo "Wachtwoorden komen niet overeen!</span><br>";
		  $error = true;
		}
		
		if ( $error == false )
		{
			$stmt = mysqli_prepare($link, "INSERT INTO members (voornaam, voorvoegsel, achternaam, email, password) VALUES (?, ?, ?, ?, ?)");
			
			mysqli_stmt_bind_param($stmt, "sssss", $voornaam, $voorvoegsel, $achternaam, $email, $wachtwoord);

			// decide what to do
			if (mysqli_stmt_execute($stmt)){
				echo "<span style='color:green;'>De gebruiker aangemaakt.</span><br>";
			}
			else{
				echo "<span style='color:red;'>Whoops! Er is iets mis gegaan.</span><br>";
			}
			// close link
			
			mysqli_stmt_close($stmt);
		}
	}





// output everything
echo $blade->view()->make('registreren')->with($vars)->render();