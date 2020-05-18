<?php
class MailsManager{
  
  static function send_request_for_approval_to($email,$name,$date_from,$date_to,$reason,$approve_link,$reject_link){
    $message = "Dear supervisor, employee {$name} requested for some time off, starting on {$date_from} and ending on {$date_to}, stating the reason: {$reason}. Click on one of the below links to approve or reject the application: {$approve_link} - {$reject_link}";
    $headers = 'From: employee_portal@example.com' . "\r\n" .
    'Reply-To: employee_portal@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  	$success = mail($email, 'A request in pending you approval', $message);
    if (!$success) {
      echo $errorMessage = error_get_last()['message'];
    }
  }

  static function send_request_response($email,$status,$created_at){
    $message = "Dear employee, your supervisor has {$status} your application submitted on {$created_at}.";
    $headers = 'From: employee_portal@example.com' . "\r\n" .
    'Reply-To: employee_portal@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
        
  	$success = mail($email, 'Your request has been {$status}', $message);
    if (!$success) {
      echo $errorMessage = error_get_last()['message'];
    }
  }

}
?>