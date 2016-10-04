<?php
require_once 'inc/connection.php';
require_once 'inc/blade.php';

echo $blade->view()->make('registreren')->with($vars)->render();

if($user->is_loggedin()!="")
{
    $user->redirect('home.php');
}

if(isset($_POST['btn-signup']))
{
   $gebruikersnaam = trim($_POST['txt_gebruikersnaam']);
   $email = trim($_POST['txt_email']);
   $wachtwoord = trim($_POST['txt_wachtwoord']); 
 
   if($gebruikersnaam=="") {
      echo "Vul een naam in!</span><br>";
	  $error = true;
   }
   if($email=="") {
	  echo "Vul een email adres in!</span><br>";
	  $error = true;
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Vul geldig email adres in!</span><br>";
	  $error = true;
   }
   else if($wachtwoord=="") {
      echo "Vul een wachtwoord in!</span><br>";
	  $error = true;
   }
   else if(strlen($wachtwoord) < 6){
      echo "Het wachtwoord moet ten minste 6 tekens lang zijn.</span><br>";
	  $error = true;
   }
   else
   {
      try
      {
         $stmt = $db->prepare("SELECT gebruikersnaam,email FROM members WHERE gebruikersnaam=:gebruikersnaam OR email=:email");
         $stmt->execute(array(':gebruikersnaam'=>$gebruikersnaam, ':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['gebruikersnaam']==$gebruikersnaam) {
            echo "De gebruikersnaam is al in gebruik.</span><br>";
	 		$error = true;
         }
         else if($row['email']==$email) {
            echo "Deze email is al in gebruik.</span><br>";
	 		$error = true;
         }
         else
         {
            if($user->register($voornaam,$tussenvoegsel,$achternaam,$gebruikersnaam,$email,$wachtwoord)) 
            {
                $user->redirect('login.php?joined');
            }
         }
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

?>
