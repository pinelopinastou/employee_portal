<?php
class Validator{
  
  static function validate_non_empty($value){
  	session_start();
    if(!isset($_SESSION["loggedin"])) {
      header('Location: login.php');
    }
  }

}
?>