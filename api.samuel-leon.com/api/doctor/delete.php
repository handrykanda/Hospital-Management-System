<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Doctor.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate patient object
  $doctor = new Doctor($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $doctor->doc_id = $data->doc_id;

  // Delete Doctor
  if($doctor->delete()) {
    echo json_encode(
      array('message' => 'Doctor Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Doctor Not Delete')
    );
  }

