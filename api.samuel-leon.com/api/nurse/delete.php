<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Nurse.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate nurse object
  $nurse = new Nurse($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $nurse->nurse_id = $data->nurse_id;

  // Delete nurse
  if($patient->delete()) {
    echo json_encode(
      array('message' => 'Nurse Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Nurse Not Delete')
    );
  }

