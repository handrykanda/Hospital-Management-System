<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Medication.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Medication object
  $med = new Medication($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $med->med_id = $data->med_id;

 $med->med_name = $data->med_name;
 $med->med_price = $data->med_price;
 $med->pat_id = $data->pat_id;
 $med->doc_id = $data->doc_id;

  // Update Medication
  if($med->update()) {
    echo json_encode(
      array('message' => 'Medication Updated Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Medication Not Updated')
    );
  }

