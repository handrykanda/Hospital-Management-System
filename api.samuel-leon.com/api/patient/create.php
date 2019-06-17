<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Max-Age: 3600');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Access-Control-Max-Age,
    Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Patient.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate patient object
  $patient = new Patient($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  $patient->pat_name = $data->pat_name;
  $patient->pat_surname = $data->pat_surname;
  $patient->pat_email = $data->pat_email;
  $patient->pat_phone = $data->pat_phone;
  $patient->pat_address = $data->pat_address;
  $patient->pat_pwd = $data->pat_pwd;
  $patient->pat_dob = $data->pat_dob;
  $patient->pat_gender = $data->pat_gender;
  $patient->pat_med_history = $data->pat_med_history;
  $patient->pat_surg_history = $data->pat_surg_history;
  $patient->pat_med_current = $data->pat_med_current;
  $patient->pat_occupation = $data->pat_occupation;

  // Create Patient
  if($patient->create()) {

    // set response code
        http_response_code(200);

    echo json_encode(
      array('message' => 'Patient Registered Successfully')
    );
  } else {

    // set response code
        http_response_code(400);

    echo json_encode(
      array('message' => 'Patient Not Registered')
    );
  }

