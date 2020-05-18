<?php
require_once "../config/config.php";

class User
{
    static function get($id)
    {
        global $conn; 
        $sql = "SELECT * FROM users WHERE ID = $id";
        $results = $conn->query($sql);
        return $results->fetch_assoc();
    }

    static function get_by_email($email)
    {
        global $conn; 
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $results = $conn->query($sql);
        return $results->fetch_assoc() ;
    }

    static function get_all_users()
    {
        global $conn; 
        $sql = "SELECT * FROM users";
        $results = $conn->query($sql);
        return $results;
    }

    static function get_num_of_users_with_email($email){
      global $conn;
      $sql = "SELECT id FROM users WHERE email = ?";
      if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            $param_email = trim($email);
            if($stmt->execute()){
                $stmt->store_result();
                $result = $stmt->num_rows(); }
            else{
                $result = "error";
            }         
        }
       return $result;
      }

    static function update($first_name,$last_name,$email,$password,$user_type)
    {   global $conn;
    	  $sql = "UPDATE users SET first_name=?, last_name=?,email=?, password=?, type=? WHERE id=?";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_first_name, $param_last_name,$param_email, $param_password, $param_type,$param_id);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            if (empty($password)){
              $param_password = User::get($_GET['id'])['password'];
            }
            else{
              $param_password = password_hash($password, PASSWORD_DEFAULT);} // Creates a password hash
            $param_type = $user_type;
            $param_id = $_GET['id'];
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $success = true;
            } else{
                $success = false;
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
            $conn->close();
            return $success;
        }
    }

    static function insert($first_name, $last_name,$email, $password, $user_type){
      global $conn;
      $sql = "INSERT INTO users (first_name, last_name,email, password, type) VALUES (?, ?, ?, ?, ?)";
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss", $param_first_name, $param_last_name,$param_email, $param_password, $param_type);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_type = $user_type;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $success = true;
            } else{
               $success = false;
            }

            // Close statement
            $stmt->close();
            $conn->close();
            return $success;
	  }
  }
}
