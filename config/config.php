<?php
//set database required global constants
define('DB_SERVER', $_ENV['DB_SERVER']);
define('DB_USERNAME', $_ENV['DB_USERNAME']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);

//set the project's root path
define('PROJECT_ROOT',$_ENV['PROJECT_ROOT']);

//connect database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
 
?>