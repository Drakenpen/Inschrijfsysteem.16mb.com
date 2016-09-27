<?php
require_once 'inc/blade.php';
//require 'inc/functions.php';
require 'inc/connection.php';
?>

<?
session_start()
?>

<?
if($mysqlhost["login"] == "true") {
   print "<font size=1 face=verdana>You are logged in";
}
else {
?>
   
   <font size=1 face=verdana>
   <FORM action="login.php" method="post">         
   Email:<br>         
   <INPUT type="text" name="username">         
   <BR>         
   Wachtwoord:<br>         
   <INPUT type="password" name="pass"><br>         
   <input type="submit" value="submit" name="submit">         
   </form>  

<?
}
if(isset($_POST['submit'])) {
   $email = trim(strtolower($_POST['email']));
   $password = $_POST['password'];
   $dead = "false";
   $message = "<font size=1 face=verdana>Fill in the following fields correctly";
   if(strlen($email) <= 1 or strlen($email) >=15){
      $dead = "true";
      $message .= "Username (2-14)<br>";
   }
   if(strlen($password) < 6 or strlen($password) > 20) {
      $dead = "true";
      $message .= "Password (6-20)<br>";
   }
   if($dead = "false"){
      include('inc/connection.php');
      $password = md5($password);
      $query = mysql_query("SELECT status FROM members WHERE email = '$email' and password = '$password'");
      $rows = mysql_num_rows($query);         
      if($rows > 0){         
         print "<font size=1 face=verdana>Your logged in as " . $email . ",<br> <a href=logout.php>log out.</a><br><a href=memberlist.php>memberlist</a>";         
             $row = mysql_fetch_assoc($query);
         $email = mysql_real_escape_string($email);
         $_SESSION['login']=true;           
         $_SESSION["email"]=$email;
         $_SESSION['rank']   = $row['status'];         
      }
      else{
         print "<font size=1 face=verdana>You filled in a wrong password and/or email";
      }         
      
   }
   else{
      print $message;
   }
}

?>


// output everything
//echo $blade->view()->make('login')->with($vars)->render();

//title, subtitle, description, large_banner_url, small_banner_url, start_date, _end_date, 
