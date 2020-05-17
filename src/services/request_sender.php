<?php

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


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