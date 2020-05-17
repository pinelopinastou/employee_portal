<?php
// Include config file
require_once "../config/config.php";

class RequestHelper{

  static function requests_list() {
    $user_requests = self::get_request_records();
     while($row = $user_requests->fetch_array()){ 
      $date_from = new DateTime($row['date_from']);
      $date_to = new DateTime($row['date_to']);
      $days = date_diff($date_from,$date_to )->format('%a')+1;
      echo "<tr><td>" . $row['created_at'] . "</td><td>" . $row['date_from']. " - " . $row['date_to'] . "</td><td>" . $days . "</td><td>" . $row['status'] .  "</td><tr>"  ;
    }
  }

  private function get_request_records(){
    global $conn;
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM requests where user_id=$id";
    $results = $conn->query($sql);
    return $results;
  }
}
?>