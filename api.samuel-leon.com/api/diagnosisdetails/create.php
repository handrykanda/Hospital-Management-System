<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Max-Age,
    Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/DiagnosisDetails.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate diadetails object
  $diadetails = new DiagnosisDetails($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  $diadetails->dia_red_flag = $data->dia_red_flag;
  $diadetails->dia_date = $data->dia_date;
  $diadetails->dia_weight = $data->dia_weight;
  $diadetails->dia_bp = $data->dia_bp;
  $diadetails->dia_temp = $data->dia_temp;
  $diadetails->dia_blood_type = $data->dia_blood_type;
  $diadetails->dia_blood_count = $data->dia_blood_count;
  $diadetails->dia_glucose_tolerance = $data->dia_glucose_tolerance;
  $diadetails->dia_pulse = $data->dia_pulse;
  $diadetails->nurse_id = $data->nurse_id;
  $diadetails->pat_id = $data->pat_id;

  // Create Patient
  if($diadetails->create()) {
    echo json_encode(
      array('message' => 'Diagnosis Details Recorded Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Diagnosis Details Not Recorded')
    );
  }

