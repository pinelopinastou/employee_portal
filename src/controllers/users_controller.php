<?php
		// Include config file
require_once "../config/config.php";
require "../src/models/user.php";

class UsersController{

	public $first_name,$last_name,$email,$password,$confirm_password,$user_type,$first_name_err,$last_name_err,$email_err,$password_err,$confirm_password_err;
    //to-do authorize index

	function new(){
		$this->first_name = $this->last_name = $this->email = $this->password = $this->confirm_password_err = $this->first_name_err = $this->last_name_err = $this->email_err = $this->password_err = $this->confirm_password_err = "";
	}

	function create(){
	  self::set_and_validate_params();
      if(empty($this->email_err) && empty($this->password_err) && empty($this->confirm_password_err)){
      $success = User::insert($this->first_name,$this->last_name,$this->email,$this->password,$this->user_type);
      if ($success){
          header("location: user_management.php");
      	}
      	else {
          echo "Something went wrong, please try again later.";
      	} 
        
      }
	}

	function edit(){
		$user = User::get($_GET['id']);
		$this->first_name = $user['first_name'];
		$this->last_name = $user['last_name'];
		$this->email = $user['email'];
		$this->password = "";
		$this->confirm_password = "";
		$this->user_type = $user['type'];;
		$this->first_name_err = $this->last_name_err = $this->email_err = $this->password_err = $this->confirm_password_err = "";
	}

	function update(){
	  self::set_and_validate_params();
      if(empty($this->first_name_err) && empty($this->last_name_err) && empty($this->email_err) && empty($this->password_err) && empty($this->confirm_password_err)){
      	$success = User::update($this->first_name,$this->last_name,$this->email,$this->password,$this->user_type,$_GET['id']);
      	if ($success){
          header("location: user_management.php");
      	}
      	else {
          echo "Something went wrong, please try again later.";
      	} 
	}
   }

	private function set_and_validate_params(){
		if(empty(trim($_POST["email"]))){
            $this->email_err = "Please enter a email.";
	    } else{
	        // Prepare a select statement
	        $result = User::get_num_of_users_with_email($_POST['email']);
	        if ($result==="error"){
	          echo "Something went wrong, please try again later - email.";
	        }
	        elseif ($result >= 1 && $this->email!=$_POST['email']){
	          $this->email_err = "This email is already taken.";
	        } else{
	          $this->email = trim($_POST["email"]);}
	    }

	    if(empty(trim($_POST["first_name"]))){
	        $this->first_name_err = "Please enter a first name.";
	    } else {
	        $this->first_name = trim($_POST["first_name"]);
	    }

	    if(empty(trim($_POST["last_name"]))){
	        $this->last_name_err = "Please enter a last name.";
	    } else {
	        $this->last_name = trim($_POST["last_name"]);
	    }

	    $this->user_type = trim($_POST["user_type"]);

	    if(strlen(trim($_POST["password"])) < 6 && !empty($password)){
	        $this->password_err = "Password must have atleast 6 characters.";
	    } else{
	        $this->password = trim($_POST["password"]);
	    }
	    
	    $this->confirm_password = trim($_POST["confirm_password"]);
	    if(empty($this->password_err) && ($this->password != $this->confirm_password)){
	        $this->confirm_password_err = "Password did not match.";
	    }
	   } 
}
?>