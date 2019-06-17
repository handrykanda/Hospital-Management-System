<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Nurse.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Nurse object
  $nurse = new Nurse($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  $nurse->nurse_name = $data->nurse_name;
  $nurse->nurse_surname = $data->nurse_surname;
  $nurse->nurse_email = $data->nurse_email;
  $nurse->nurse_phone = $data->nurse_phone;
  $nurse->nurse_address = $data->nurse_address;
  $nurse->nurse_pwd = $data->nurse_pwd;

  // Create Nurse
  if($nurse->create()) {
    echo json_encode(
      array('message' => 'Nurse Registered Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Nurse Not Registered')
    );
  }

