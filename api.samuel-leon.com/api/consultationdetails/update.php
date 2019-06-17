<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  $condetails->con_pc = $data->con_pc;
  $condetails->con_hpc = $data->con_hpc;
  $condetails->con_drug_history = $data->con_drug_history;
  $condetails->con_date = $data->con_date;
  $condetails->doc_id = $data->doc_id;
  $condetails->pat_id = $data->pat_id;

  // Update Patient
  if($condetails->update()) {
    echo json_encode(
      array('message' => 'Consultation Details Updated Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Consultation Details Not Updated')
    );
  }

