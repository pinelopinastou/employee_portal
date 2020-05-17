<?php
// Include config file
require_once "../config/config.php";
 
// Define variables and initialize with values
$request = get_request($_GET['request_id']);
$sql = "UPDATE requests SET status=? WHERE id=?";
 
if($stmt = $conn->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("ss", $param_status, $param_id);
    
    // Set parameters
    $param_status = "approved";
    $param_id = $request['id'];
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Redirect to login page
        echo "The request has been approved, redirecting...";
        header("location: user_management.php");
    } else{
        echo "Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}
        
    
    // Close connection
    $conn->close();

function get_request($id){
  global $conn; 
  $sql = "SELECT * FROM requests WHERE ID = $id";
  $results = $conn->query($sql);
  return $results->fetch_assoc();
}

?>