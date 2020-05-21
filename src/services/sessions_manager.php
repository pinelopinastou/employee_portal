<?php
class SessionsManager{
  
  //runs in each page, checks if user has signed in
  static function check_session(){
  	session_start();
    if(!isset($_SESSION["loggedin"])) {
      header('Location: login.php');
    }
  }

  //runs in login.php, ig user has signed in they are redirected to the requests page
  static function check_if_session_is_active(){
  	session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location: requests.php");
    }
  }

  //sign in user and assign session variables
  static function create_session($id,$email,$first_name,$last_name){
  	session_start();  
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["email"] = $email;                            
    $_SESSION["name"] = $first_name." ".$last_name;
  }

  //runs in logout.php, unsets and destroys session to logout user
  static function destroy_session(){
  	session_start();
    session_unset();
    session_destroy();
  }


}
?>