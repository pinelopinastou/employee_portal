<?php
// Include config file
require_once "config.php";
function user_list() {
  $user_records = get_user_records();
  while($row = mysqli_fetch_array($user_records)){ 
    echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['type'] . "</td><td><a href='../public/edit_user.php?id=".$row['ID']."' i class='fas fa-edit'></i> </td><tr>"  ;
  }
}

function get_user_records(){
	global $link;
	$sql = "SELECT * FROM users";
	$results = mysqli_query($link,$sql);
	return $results;
}

?>