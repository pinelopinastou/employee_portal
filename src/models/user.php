<?php
require_once "../config/config.php";

class User
{   
    //returns association of user record
    static function get($id)
    {
        global $conn; 
        $sql = "SELECT * FROM users WHERE ID = ?";
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

    //returns association of user record
    static function get_by_email($email)
    {
        global $conn; 
        $sql = "SELECT * FROM users WHERE email = ?";
        if($stmt = $conn->prepare($sql)){
          $stmt->bind_param("s",$param_email);
          $param_email = $email;
       if($stmt->execute()){
          $results = $stmt->get_result();          
        } 
        else {
          $results = false;
        }
      }
      return $results->fetch_assoc();
    }

    //returns records of all users belonging to an admin
    static function get_all_users_by_admin_id($administrator_id)
    {
      global $conn; 
      $sql = "SELECT * FROM users WHERE administrator_id = ?";
      if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_administrator_id);
            $param_administrator_id = $administrator_id;
            if($stmt->execute()){
                $results = $stmt->get_result(); }
            else{
                $results = false;
            }         
        }
       return $results;
    }

    //return number of user records with the same email
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

    //update user record. returns true or false based on success
    static function update($first_name,$last_name,$email,$password,$user_type)
    {   global $conn;
          $sql = "UPDATE users SET first_name=?, last_name=?,email=?, password=?, type=? WHERE id=?";
         
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ssssss", $param_first_name, $param_last_name,$param_email, $param_password, $param_type,$param_id);
            
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            if (empty($password)){
              $param_password = User::get($_GET['id'])['password'];
            }
            else{
              $param_password = password_hash($password, PASSWORD_DEFAULT);} 
            $param_type = $user_type;
            $param_id = $_GET['id'];

            if($stmt->execute()){
                $success = true;
            } else{
                $success = false;
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
            return $success;
        }
    }

    //insert user record. returns true or false based on success
    static function insert($first_name, $last_name,$email, $password, $user_type, $administrator_id){
      global $conn;
      $sql = "INSERT INTO users (first_name, last_name,email, password, type, administrator_id) VALUES (?, ?, ?, ?, ?, ?)";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ssssss", $param_first_name, $param_last_name,$param_email, $param_password, $param_type, $param_administrator_id);
            
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_type = $user_type;
            $param_administrator_id = $administrator_id;
            
            if($stmt->execute()){
                $success = true;
            } else{
               $success = false;
            }

            $stmt->close();
            return $success;
      }
  }
}
