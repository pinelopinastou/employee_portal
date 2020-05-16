<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with values
$user = get_user($_GET['id']);
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$email = $user['email'];
$password = "";
$confirm_password = "";
$user_type = $user['type'];;
$first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 2){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["first_name"]))){
        $firts_name_err = "Please enter a first name.";
    } else {
         $first_name = trim($_POST["first_name"]);
    }

    if(empty(trim($_POST["last_name"]))){
        $firts_name_err = "Please enter a last name.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    $user_type = trim($_POST["user_type"]);
    // Validate password
    if(strlen(trim($_POST["password"])) < 6 && !empty($password)){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
    }
    
    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        // Prepare an insert statement
          $sql = "UPDATE users SET first_name=?, last_name=?,email=?, password=?, type=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_first_name, $param_last_name,$param_email, $param_password, $param_type,$param_id);
            
            // Set parameters
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            if (empty($password)){
            $param_password = get_user($_GET['id'])['password'];
            }
            else{
            $param_password = password_hash($password, PASSWORD_DEFAULT);} // Creates a password hash
            $param_type = $user_type;
            $param_id = $_GET['id'];
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: user_management.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    
    // Close connection
    mysqli_close($link);
}}

function get_user($id){
  global $link; 
  $sql = "SELECT * FROM users WHERE ID = $id";
  $results = mysqli_query($link,$sql);
  return mysqli_fetch_assoc($results);
}

?>