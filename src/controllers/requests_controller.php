<?php require_once "../src/models/request.php";
require_once "../src/services/validator.php";

class RequestsController{
    //to-do add index with authorization method
	static function new(){
	   global $date_from, $date_to, $reason, $reason_err;
	   $date_from = $date_to = $reason = "";
       $reason_err = "";
	}

    static function create(){
      $date_from = trim($_POST["date_from"]);
      $date_to = trim($_POST["date_to"]);

      if(empty(trim($_POST["reason"]))){
        $reason_err = "Please enter a reason.";
      } else {
        $reason = trim($_POST["reason"]);
      }

      if(empty($reason_err)){
      	session_start();
        $success = Request::insert($date_from,$date_to,$reason,$_SESSION['id']);
        if ($success){
          header("location: home.php");
        }
        else{
          echo "Something went wrong. Please try again later.";
        }
      }
    }

	static function approve(){
      $success = Request::set_status($_GET['request_id'],"approved");
      if ($success){
      	echo "The request has been approved, redirecting...";
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
    }

	static function reject(){
	  $success = Request::set_status($_GET['request_id'],"rejected");
      if ($success){
      	echo "The request has been rejected, redirecting...";
        header("location: user_management.php");
      }
      else{
        echo "Something went wrong. Please try again later.";
      }
	}

}
?>