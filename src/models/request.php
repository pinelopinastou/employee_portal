<?php
require_once "../config/config.php";

class Request
{   
    //returns all requests records of active user
    static function get_current_user_requests(){
      global $conn;
      $id = $_SESSION['id'];
      $sql = "SELECT * FROM requests where user_id=?";
      if($stmt = $conn->prepare($sql)){
          $stmt->bind_param("s",$param_id);
          $param_id = $id;
       if($stmt->execute()){
          $results = $stmt->get_result();          
        } 
        else {
          $results = false;
        }
      }
      return $results;
    }

    //returns association of request record
    static function get($id)
    {
        global $conn; 
        $sql = "SELECT * FROM requests WHERE ID = ?";
        if($stmt = $conn->prepare($sql)){
          $stmt->bind_param("s",$param_id);
          $param_id = $id;
          if($stmt->execute()){
             $results = $stmt->get_result();          
           } 
           else {
             $results = false;
           }
         } 
      return $results->fetch_assoc();
    }

    //change the status of request record. returns true or false based on success.
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


    //insert new request. if successfull, returns the id of the request, if not it returns false.
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
