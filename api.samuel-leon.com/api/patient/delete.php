<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Patient.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate patient object
  $patient = new Patient($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $patient->pat_id = $data->pat_id;

  // Delete Patient
  if($patient->delete()) {
    echo json_encode(
      array('message' => 'Patient Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Patient Not Delete')
    );
  }

