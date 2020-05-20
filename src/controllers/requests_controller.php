<?php require "../src/models/request.php";
require "../src/models/user.php";
require "../src/services/mails_manager.php";
require '../src/services/sessions_manager.php';
require "../src/policies/requests_policy.php";

class RequestsController{

  public $date_from, $date_to, $reason, $reason_err, $date_from_err, $date_to_err;
  function index(){
     SessionsManager::check_session();
     self::verify_authorised_to_send_requests();
  }

	function new(){
     SessionsManager::check_session();
     self::verify_authorised_to_send_requests();
	   $this->date_from = $this->date_to = $this->reason = "";
     $this->reason_err = $this->date_from_err = $this->date_to_err = "";
	}

  function create(){
    SessionsManager::check_session();
    self::verify_authorised_to_send_requests();
    self::set_and_validate_params();

    if(empty($reason_err)){
      $user = User::get($_SESSION['id']);
      $request_id = Request::insert($this->date_from,$this->date_to,$this->reason,$user['ID'],$user['administrator_id']);
      $administrator = User::get($user['administrator_id']);
      if ($request_id){
        $approve_link = PROJECT_ROOT."approve.php?".$request_id;
        $reject_link = PROJECT_ROOT."reject.php?".$request_id;
        MailsManager::send_request_for_approval_to($administrator['email'],$user['first_name']." ".$user["last_name"],$this->date_from,$this->date_to,$this->reason,$approve_link,$reject_link);
        $_SESSION["flash"] = ["type" => "success", "message" => "The request has been created successfully."];
        header("location: requests.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }
  }

	function approve(){
      SessionsManager::check_session();
      self::verify_authorised_to_receive_requests();
      $id = $_GET['request_id'];
      $success = Request::set_status($id,"approved");
      if ($success){
        $request = Request::get($id);
        $user = User::get($request['user_id']);
        MailsManager::send_request_response($user['email'],"approved",$request['created_at']);
        $_SESSION["flash"] = ["type" => "success", "message" => "The request has been approved"];
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }

	function reject(){
    SessionsManager::check_session();
    self::verify_authorised_to_receive_requests();
    $id = $_GET['request_id'];
	  $success = Request::set_status($id,"rejected");
      if ($success){
        $request = Request::get($id);
        $user = User::get($request['user_id']);
        MailsManager::send_request_response($user['email'],"rejected",$request['created_at']);
        $_SESSION["flash"] = ["type" => "success", "message" => "The request has been rejected"];
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
	}

  private function set_and_validate_params(){
    if(empty(trim($_POST["date_from"]))){
      $this->date_from_err = "Please enter a start date.";
    } else {
      $this->date_from = trim($_POST["date_from"]);
    }

    if(empty(trim($_POST["date_to"]))){
      $this->date_to_err = "Please enter an end date.";
    } else {
      $this->date_to = trim($_POST["date_to"]);
    }

    if(empty(trim($_POST["reason"]))){
      $this->reason_err = "Please enter a reason.";
    } else {
      $this->reason = trim($_POST["reason"]);
    }
  }

  private function verify_authorised_to_send_requests(){
    $auth = RequestsPolicy::authorize_to_send_requests(User::get($_SESSION['id'])['administrator_id']);
    if (!$auth){
      $_SESSION["flash"] = ["type" => "failure", "message" => "You are not authorised to access this page."];
      header("location: user_management.php");
      exit();
    }
  }

  private function verify_authorised_to_receive_requests(){
    $auth = RequestsPolicy::authorize_to_receive_requests(User::get($_SESSION['id'])['type']);
    if (!$auth){
      $_SESSION["flash"] = ["type" => "failure", "message" => "You are not authorised to access this page."];
      header("location: requests.php");
      exit();
    }
  }

}
?>