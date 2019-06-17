<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Medication.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate med object
  $med = new Medication($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $med->med_id = $data->med_id;

  // Delete Medication
  if($med->delete()) {
    echo json_encode(
      array('message' => 'Medication Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Medication Not Delete')
    );
  }

