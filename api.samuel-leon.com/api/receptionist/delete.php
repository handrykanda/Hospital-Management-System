<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Receptionist.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate receptionist object
  $receptionist = new Receptionist($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $receptionist->rep_id = $data->rep_id;

  // Delete receptionist
  if($receptionist->delete()) {
    echo json_encode(
      array('message' => 'Receptionist Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Receptionist Not Delete')
    );
  }

