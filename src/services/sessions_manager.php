<?php
class SessionsManager{
  
  static function check_session(){
  	session_start();
    if(!isset($_SESSION["loggedin"])) {
      header('Location: login.php');
    }
  }

}
?>