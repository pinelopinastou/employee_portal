<?php
// Include config file
require_once "../src/config.php";
 
// Define variables and initialize with values
$request = get_request($_GET['request_id']);
$sql = "UPDATE requests SET status=? WHERE id=?";
 
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ss", $param_status, $param_id);
    
    // Set parameters
    $param_status = "approved";
    $param_id = $request['id'];
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // Redirect to login page
        echo "The request has been approved, redirecting...";
        header("location: user_management.php");
    } else{
        echo "Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
        
    
    // Close connection
    mysqli_close($link);

function get_request($id){
  global $link; 
  $sql = "SELECT * FROM requests WHERE ID = $id";
  $results = mysqli_query($link,$sql);
  return mysqli_fetch_assoc($results);
}

?>