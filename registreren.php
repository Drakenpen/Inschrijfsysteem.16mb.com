<?php
require_once 'inc/connection.php';

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
      $error[] = "provide username !"; 
   }
   else if($email=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($wachtwoord=="") {
      $error[] = "provide password !";
   }
   else if(strlen($wachtwoord) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else
   {
      try
      {
         $stmt = $db->prepare("SELECT gebruikersnaam,email FROM members WHERE gebruikersnaam=:gebruikersnaam OR email=:email");
         $stmt->execute(array(':gebruikersnaam'=>$gebruikersnaam, ':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['gebruikersnaam']==$gebruikersnaam) {
            $error[] = "sorry username already taken !";
         }
         else if($row['email']==$email) {
            $error[] = "sorry email id already taken !";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up : cleartuts</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="container">
     <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2><hr />
            <?php
            if(isset($error))
            {
               foreach($error as $error)
               {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
               }
            }
            else if(isset($_GET['joined']))
            {
                 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
                 </div>
                 <?php
            }
            ?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_gebruikersnaam" placeholder="Enter Username" value="<?php if(isset($error)){echo $gebruikersnaam;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_email" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $email;}?>" />
            </div>
            <div class="form-group">
             <input type="wachtwoord" class="form-control" name="txt_wachtwoord" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                 <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br />
            <label>have an account ! <a href="login.php">Sign In</a></label>
        </form>
       </div>
</div>

</body>
</html>