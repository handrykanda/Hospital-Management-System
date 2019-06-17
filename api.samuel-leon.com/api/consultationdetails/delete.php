<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/ConsultationDetails.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate condetails object
  $condetails = new ConsultationDetails($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $condetails->con_id = $data->con_id;

  // Delete ConsultationDetails
  if($condetails->delete()) {
    echo json_encode(
      array('message' => 'Consultation Details Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'ConsultationDetails Not Delete')
    );
  }

