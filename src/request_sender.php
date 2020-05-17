<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
session_start();
$date_from = $date_to = $reason = "";
$reason_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $date_from = trim($_POST["date_from"]);
    $date_to = trim($_POST["date_to"]);
    // Validate email
    if(empty(trim($_POST["reason"]))){
        $reason_err = "Please enter a reason.";
    } else {
         $reason = trim($_POST["reason"]);
    }
    // Check input errors before inserting in database
    if(empty($reason_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO requests (date_from, date_to,reason,user_id) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_date_from, $param_date_to,$param_reason, $param_user_id);
            
            // Set parameters
            $param_date_from = $date_from;
            $param_date_to = $date_to;
            $param_reason = $reason;
            $param_user_id = $_SESSION['id'];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $request_id = mysqli_insert_id($link);
                //sendMail($date_from,$date_to,$_SESSION['name'],$request_id);
                header("location: home.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
 }

    function sendMail($date_from, $date_to, $user,$request_id){
      global $link;
      $approve_link = "http://localhost/employee_portal/public/approve.php?request_id={$request_id}";
      $reject_link = "http://localhost/employee_portal/public/reject.php?request_id={$request_id}";
      $email = "";
      $subject = "A request requires your attention";
      $message = "Dear supervisor, employee {$user} requested for some time off, starting on {$date_from} and ending on {$date_to}, stating the reason:{$reason}. Click on one of the below links to approve or reject the application: {$approve_link} - {$reject_link}” ";
      $headers = array(
      'From' => '',
      'Reply-To' => '',
      'X-Mailer' => 'PHP/' . phpversion()
      );
      mail ("" , $subject, $message, $headers);
    }
?>