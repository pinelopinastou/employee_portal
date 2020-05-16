<?php
// Include config file
require_once "config.php";
function request_list() {
  $user_requests = get_user_requests();
  while($row = mysqli_fetch_array($user_requests)){ 
    echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['type'] . "</td><td><a href='../public/edit_user.php?id=".$row['ID']."' i class='fas fa-edit'></i> </td><tr>"  ;
  }
}

function get_request_records(){
	global $link;
	$sql = "SELECT * FROM requests where requester_id=$_SESSION['id']";
	$results = mysqli_query($link,$sql);
	return $results;
}

?>