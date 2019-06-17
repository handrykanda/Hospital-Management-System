<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/DiagnosisDetails.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate diadetails object
  $diadetails = new DiagnosisDetails($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $diadetails->dia_id = $data->dia_id;

  // Delete Patient
  if($diadetails->delete()) {
    echo json_encode(
      array('message' => 'Diagnosis Details Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Diagnosis Details Not Delete')
    );
  }

