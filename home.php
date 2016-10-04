<?php
include_once 'inc/connection.php';
include_once 'inc/blade.php';

echo $blade->view()->make('home')->with($vars)->render();

if(!$user->is_loggedin())
{
 $user->redirect('login.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $db->prepare("SELECT * FROM members WHERE id=:id");
$stmt->execute(array(":id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
