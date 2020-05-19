<?php
class SessionsManager{
  
  static function check_session(){
  	session_start();
    if(!isset($_SESSION["loggedin"])) {
      header('Location: login.php');
    }
  }

  static function check_if_session_is_active(){
  	session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: requests.php");
    }
  }

  static function create_session($id,$email,$first_name,$last_name){
  	session_start();  
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["email"] = $email;                            
    $_SESSION["name"] = $first_name." ".$last_name;
  }

  static function destroy_session(){
  	session_start();
    session_unset();
    session_destroy();
  }


}
?>