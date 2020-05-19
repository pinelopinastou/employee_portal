<?php require "../src/models/request.php";
require "../src/models/user.php";
require "../src/services/mails_manager.php";
require '../src/services/sessions_manager.php';

class RequestsController{

  public $date_from, $date_to, $reason, $reason_err;
  function index(){
     SessionsManager::check_session();
  }

	function new(){
     SessionsManager::check_session();
	   $this->date_from = $this->date_to = $this->reason = "";
       $this->reason_err = "";
	}

  function create(){
    SessionsManager::check_session();
    $this->date_from = trim($_POST["date_from"]);
    $this->date_to = trim($_POST["date_to"]);

    if(empty(trim($_POST["reason"]))){
      $this->reason_err = "Please enter a reason.";
    } else {
      $this->reason = trim($_POST["reason"]);
    }

    if(empty($reason_err)){
      $request = Request::insert($this->date_from,$this->date_to,$this->reason,$_SESSION['id']);
      $user = User::get($request['user_id']);
      $administrator = User::get($request['administrator_id'])
      if ($request){
        $approve_link = PROJECT_ROOT."approve.php?".$request['id'];
        $reject_link = PROJECT_ROOT."reject.php?".$request['id'];
        MailsManager::send_request_for_approval_to($administrator['email'],$request['first_name']." ".$request["last_name"],$request['$date_from'],$request['$date_to'],$request['reason'],$approve_link,$reject_link);
        header("location: home.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }
  }

	function approve(){
      SessionsManager::check_session();
      $id = $_GET['request_id'];
      $success = Request::set_status($id,"approved");
      if ($success){
      	echo "The request has been approved, redirecting...";
        $request = Request::get($id);
        $user = User::get($request['user_id']);
        MailsManager::send_request_response($user['email'],"approved",$request['created_at']);
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }

	function reject(){
    SessionsManager::check_session();
    $id = $_GET['request_id'];
	  $success = Request::set_status($id,"rejected");
      if ($success){
      	echo "The request has been rejected, redirecting...";
        $request = Request::get($id);
        $user = User::get($request['user_id']);
        MailsManager::send_request_response($user['email'],"rejected",$request['created_at']);
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
	}

}
?>