<?php
// Include config file
require_once "../config/config.php";

class UserHelper{

	static function user_list() {
	  $user_records = self::get_user_records();
	  while($row =$user_records->fetch_array()){ 
	    echo "<tr><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['type'] . "</td><td><a href='../public/edit_user.php?id=".$row['ID']."' i class='fas fa-edit'></i> </td><tr>"  ;
	  }
	}

	private function get_user_records(){
		global $conn;
		$sql = "SELECT * FROM users";
		$results = $conn->query($sql);
		return $results;
	}
}
?>