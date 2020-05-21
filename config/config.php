<?php
//set database required global constants
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'employee_portal');
//set the project's root path
define('PROJECT_ROOT','localhost/employee_portal/public');

//connect database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
 
?>