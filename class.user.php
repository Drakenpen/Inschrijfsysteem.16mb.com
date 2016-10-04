<?php
class USER
{
    private $db;
 
    function __construct($db)
    {
      $this->db = $db;
    }
 
    public function register($voornaam,$voorvoegsel,$achernaam,$gebruikersnaam,$email,$wachtwoord)
    {
       try
       {
           $new_password = password_hash($wachtwoord, PASSWORD_DEFAULT);
   
           $stmt = $this->db->prepare("INSERT INTO members(gebruikersnaam,email,wachtwoord) 
                                                       VALUES(:gebruikersnaam, :email, :wachtwoord)");
              
           $stmt->bindparam(":gebruikersnaam", $gebruikersnaam);
           $stmt->bindparam(":email", $email);
           $stmt->bindparam(":wachtwoord", $wachtwoord);            
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($gebruikersnaam,$email,$wachtwoord)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM members WHERE gebruikersnaam=:gebruikersnaam OR email=:email LIMIT 1");
          $stmt->execute(array(':gebruikersnaam'=>$gebruikersnaam, ':email'=>$email));
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(password_verify($wachtwoord, $userRow['wachtwoord']))
             {
                $_SESSION['user_session'] = $userRow['id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>