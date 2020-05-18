<?php require_once "../src/models/request.php";

class RequestsController{

  public $date_from, $date_to, $reason, $reason_err;
    //to-do add index with authorization method
	function new(){
	   $this->date_from = $this->date_to = $this->reason = "";
       $this->reason_err = "";
	}

    function create(){
      $this->date_from = trim($_POST["date_from"]);
      $this->date_to = trim($_POST["date_to"]);

      if(empty(trim($_POST["reason"]))){
        $this->reason_err = "Please enter a reason.";
      } else {
        $this->reason = trim($_POST["reason"]);
      }

      if(empty($reason_err)){
      	session_start();
        $success = Request::insert($this->date_from,$this->date_to,$this->reason,$_SESSION['id']);
        if ($success){
          //get the variables, this needs research
          //send_request_for_approval_to($supervisor->email,$name,$date_from,$date_to,$reason,$approve_link,$reject_link)
          header("location: home.php");
        }
        else{
          echo "Something went wrong. Please try again later.";
        }
      }
    }

	function approve(){
      $success = Request::set_status($_GET['request_id'],"approved");
      if ($success){
      	echo "The request has been approved, redirecting...";
        //send_request_response($email,$status,$created_at);
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }

	function reject(){
	  $success = Request::set_status($_GET['request_id'],"rejected");
      if ($success){
      	echo "The request has been rejected, redirecting...";
        //send_request_response($email,$status,$created_at);
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
	}

}
?>