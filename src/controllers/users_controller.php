<?php
require "../src/models/user.php";
require "../src/policies/users_policy.php";
require "../src/services/sessions_manager.php";

class UsersController{

	public $first_name,$last_name,$email,$password,$confirm_password,$user_type,$first_name_err,$last_name_err,$email_err,$password_err,$confirm_password_err;

	//called in user_management.php
	function index(){
	  SessionsManager::check_session();
	  self::verify_authorised();
	}

	//called in new_user.php
	function new(){
	  SessionsManager::check_session();
	  self::verify_authorised();
	  $this->first_name = $this->last_name = $this->email = $this->password = $this->confirm_password_err = $this->first_name_err = $this->last_name_err = $this->email_err = $this->password_err = $this->confirm_password_err = "";
	}

	//called in new_user.php on POST action
	function create(){
	  SessionsManager::check_session();
	  self::verify_authorised();
	  self::set_and_validate_params();
      if(empty($this->email_err) && empty($this->password_err) && empty($this->confirm_password_err)){
      $success = User::insert($this->first_name,$this->last_name,$this->email,$this->password,$this->user_type,$_SESSION['id']);
      if ($success){
      	  $_SESSION["flash"] = ["type" => "success", "message" => "User has been successfully created!"];
          header("location: user_management.php");
      	}
      	else {
          echo "Something went wrong, please try again later.";
      	} 
        
      }
	}

	//called in edit_user.php
	function edit(){
		SessionsManager::check_session();
		$user = User::get($_GET['id']);
		self::verify_authorised_edit($user['administrator_id']);
		$this->first_name = $user['first_name'];
		$this->last_name = $user['last_name'];
		$this->email = $user['email'];
		$this->password = "";
		$this->confirm_password = "";
		$this->user_type = $user['type'];;
		$this->first_name_err = $this->last_name_err = $this->email_err = $this->password_err = $this->confirm_password_err = "";
	}

	//called in edit_user.php on POST action
	function update(){
	  SessionsManager::check_session();
	  $user = User::get($_GET['id']);
	  self::verify_authorised_edit($user['administrator_id']);
	  self::set_and_validate_params();
      if(empty($this->first_name_err) && empty($this->last_name_err) && empty($this->email_err) && empty($this->password_err) && empty($this->confirm_password_err)){
      	$success = User::update($this->first_name,$this->last_name,$this->email,$this->password,$this->user_type,$_GET['id']);
      	if ($success){
          $_SESSION["flash"] = ["type" => "success", "message" => "User has been successfully updated!"];
          header("location: user_management.php");
      	}
      	else {
          echo "Something went wrong, please try again later.";
      	} 
	 }
   }

   //verify user is administrator
   	private function verify_authorised(){
   	  $auth = UsersPolicy::authorize(User::get($_SESSION['id'])['type']);
	  if (!$auth){
	  	$_SESSION["flash"] = ["type" => "failure", "message" => "You are not authorised to access this page."];
	  	header("location: requests.php");
	  	exit();
	  }
   	}

   	//verify user is administrator and has access to this user
   	private function verify_authorised_edit($admin_id){
   	  $auth = UsersPolicy::authorize_edit(User::get($_SESSION['id'])['type'],$admin_id);
	  if (!$auth){
	  	$_SESSION["flash"] = ["type" => "failure", "message" => "You are not authorised to access this page."];
	  	header("location: requests.php");
	  	exit();
	  }
   	}

   	//set and validate post params
	private function set_and_validate_params(){
		if(empty(trim($_POST["email"]))){
            $this->email_err = "Please enter a email.";
	    } else{
	        $result = User::get_num_of_users_with_email($_POST['email']);
	        if ($result==="error"){
	          echo "Something went wrong, please try again later.";
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