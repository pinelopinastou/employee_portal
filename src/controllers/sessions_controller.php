<?php require "../src/models/user.php";
require "../src/services/sessions_manager.php";

class SessionsController{

	public $email, $password, $email_err, $password_err;

	function new(){
		SessionsManager::check_if_session_is_active();
		$this->email = $this->password = "";
        $this->email_err = $this->password_err = "";
    }

	function create(){
	  self::set_and_validate_params();

      if(empty($this->email_err) && empty($this->password_err)){
        $user = User::get_by_email($this->email);

        if (!$user){
          $this->email_err = "Could not find email.";
        }
        elseif (!password_verify($this->password, $user['password'])) {
          $this->password_err = "Password is incorrect.";
        }
        else {
          SessionsManager::create_session($user['ID'],$user['email'],$user['first_name'],$user['last_name']);
          header("location: home.php");
        }
       }
	 }

	function destroy(){
		SessionsManager::destroy_session();
		header("location:../public/login.php");
	}

	private function set_and_validate_params(){
      // Check if email is empty
	    if(empty(trim($_POST["email"]))){
	        $this->email_err = "Please enter email.";
	    } else{
	        $this->email = trim($_POST["email"]);
	    }
	    
	    // Check if password is empty
	    if(empty(trim($_POST["password"]))){
	        $this->password_err = "Please enter your password.";
	    } else{
	        $this->password = trim($_POST["password"]);
	    }
	}


}
?>