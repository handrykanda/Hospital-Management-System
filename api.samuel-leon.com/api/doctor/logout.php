<?php 

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

 session_start();
 session_destroy();
 header('Location: http://localhost/clinica/login');
 ?>