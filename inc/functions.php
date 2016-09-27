<?php
session_start();

function login($link) {
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["email"]) || empty($_POST["wachtwoord"]))
		{
		$error = "Vul alle velden in.";
		echo $error;
		}
		else
		{
			// Define $email and $wachtwoord
			$email= $_POST['email'];
			$wachtwoord= $_POST['wachtwoord'];
			 
			// To protect from MySQL injection
			$email = stripslashes($email);
			$wachtwoord = stripslashes($wachtwoord);
			$email = mysqli_real_escape_string($link, $email);
			$wachtwoord = mysqli_real_escape_string($link, $wachtwoord);
			$wachtwoord = md5($wachtwoord);
			 
			//Check email and wachtwoord from database
			
			/* create a prepared statement */
			if ($stmt = mysqli_prepare($link, "SELECT email FROM inschrijfsysteem WHERE email=? and wachtwoord=?")) {

				/* bind parameters for markers */
				mysqli_stmt_bind_param($stmt, "ss", $email, $wachtwoord);

				/* execute query */
				mysqli_stmt_execute($stmt);

				/* bind result variables */
				mysqli_stmt_bind_result($stmt, $email2);
				
				/*If email and wachtwoord exist in our database then create a session.
				Otherwise echo error.*/
				
				if (mysqli_stmt_fetch($stmt)){
				$_SESSION['email'] = $email2; // Initializing Session
				}
				else
				{
					$error = "Incorrect email of wachtwoord.";
					Echo $error;
				}

				echo $email2;

				/* close statement */
				mysqli_stmt_close($stmt);
			}
		}
	}
}

function check($link) {
	
	if (isset($_SESSION['email'])) {
	
	$email_check=$_SESSION['email'];
	$query = "SELECT email FROM inschrijfsysteem WHERE email='".$email_check."'";
	if ($sql = mysqli_query($link, $query))
	{
	  // Return the number of rows in result set
		$rowcount=mysqli_num_rows($sql);
		if ($rowcount == 0) {
			return false;
		}
		else {
			return true;
		}
	}
	}
}

function insert_user_into_db($link) {
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
}