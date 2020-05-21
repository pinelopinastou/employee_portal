<?php
//load env variables
if(file_exists('../.env.php')) {
      include '../.env.php';
  }
  if(!function_exists('env')) {
      function env($key, $default = null)
      {
          $value = getenv($key);

          if ($value === false) {
              return $default;
          }

          return $value;
      }
  }

//set database required global constants
define('DB_SERVER', env('DB_SERVER'));
define('DB_USERNAME', env('DB_USERNAME'));
define('DB_PASSWORD', env('DB_PASSWORD'));
define('DB_NAME', env('DB_NAME'));

//set the project's root path
define('PROJECT_ROOT',env('PROJECT_ROOT'));
//connect database
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_NAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
 
?>