<?php
require_once "../config/config.php";

class Request
{
    static function get_current_user_requests(){
      global $conn;
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM requests where user_id=$id";
      $results = $conn->query($sql) or die($conn->error);
      return $results;
    }

    static function get($id)
    {
        global $conn; 
        $sql = "SELECT * FROM requests WHERE ID = $id";
        $results = $conn->query($sql);
        return $results->fetch_assoc();
    }

    static function set_status($id,$status)
    {
    	global $conn;
    	$sql = "UPDATE requests SET status=? WHERE id=?";
 
        if($stmt = $conn->prepare($sql)){
          $stmt->bind_param("ss", $param_status, $param_id);
          $param_status = $status;
          $param_id = $id;
       if($stmt->execute()){
          $success = true;          
        } 
        else {
      	  $succes = false;
      	}
       $stmt->close();
       return $success;
      }
    }

    static function insert($date_from,$date_to,$reason,$user_id,$administrator_id){
      global $conn;
      $sql = "INSERT INTO requests (date_from, date_to,reason,user_id,administrator_id) VALUES (?, ?, ?, ?,?)";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_date_from, $param_date_to,$param_reason, $param_user_id, $param_administrator_id);
            
            // Set parameters
            $param_date_from = $date_from;
            $param_date_to = $date_to;
            $param_reason = $reason;
            $param_user_id = $user_id;
            $param_administrator_id = $administrator_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute() or die($conn->error)){
              $record = $conn->insert_id;
            } else{
              $record = false;
            }
            $stmt->close();
            return $record;
        }
	}
  }
