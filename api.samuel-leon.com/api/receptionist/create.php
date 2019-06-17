<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Receptionist.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Receptionist object
  $receptionist = new Receptionist($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  $receptionist->rep_name = $data->rep_name;
  $receptionist->rep_surname = $data->rep_surname;
  $receptionist->rep_email = $data->rep_email;
  $receptionist->rep_phone = $data->rep_phone;
  $receptionist->rep_address = $data->rep_address;
  $receptionist->rep_pwd = $data->rep_pwd;

  // Create Receptionist
  if($receptionist->create()) {
    echo json_encode(
      array('message' => 'Receptionist Registered Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Receptionist Not Registered')
    );
  }

