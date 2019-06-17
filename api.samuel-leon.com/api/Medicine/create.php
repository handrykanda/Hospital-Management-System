<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $med->med_name = $data->med_name;
  $med->med_price = $data->med_price;
  $med->pat_id = $data->pat_id;
  $med->doc_id = $data->doc_id;

  // Create Medication
  if($med->create()) {
    echo json_encode(
      array('message' => 'Medication Recorded Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Medication Not Recorded')
    );
  }

