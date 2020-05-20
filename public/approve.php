<?php

require "../src/controllers/requests_controller.php";

$requests_controller = new RequestsController();
$requests_controller->approve();

?>