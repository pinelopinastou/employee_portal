<?php
// Include config file
require_once "config.php";
session_start();
function requests_list() {
  $user_requests = get_request_records();
  while($row = mysqli_fetch_array($user_requests)){ 
  	$date_from = new DateTime($row['date_from']);
  	$date_to = new DateTime($row['date_to']);
  	$days = date_diff($date_from,$date_to )->format('%a')+1;
    echo "<tr><td>" . $row['created_at'] . "</td><td>" . $row['date_from']. " - " . $row['date_to'] . "</td><td>" . $days . "</td><td>" . $row['status'] .  "</td><tr>"  ;
  }
}

function get_request_records(){
	global $link;
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM requests where user_id=$id";
	$results = mysqli_query($link,$sql);
	return $results;
}

?>