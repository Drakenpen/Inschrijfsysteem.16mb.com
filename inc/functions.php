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