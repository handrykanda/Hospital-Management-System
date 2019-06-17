<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Doctor.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate doctor object
  $doctor = new Doctor($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  $doctor->doc_name = $data->doc_name;
  $doctor->doc_surname = $data->doc_surname;
  $doctor->doc_email = $data->doc_email;
  $doctor->doc_phone = $data->doc_phone;
  $doctor->doc_image = $data->doc_image;
  $doctor->doc_pwd = $data->doc_pwd;
  $doctor->doc_specialty = $data->doc_specialty;
  $doctor->doc_education = $data->doc_education;

  // Create Patient
  if($doctor->create()) {
    echo json_encode(
      array('message' => 'Doctor Registered Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Doctor Not Registered')
    );
  }

