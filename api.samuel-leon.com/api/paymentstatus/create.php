<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/PaymentStatus.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate paystatus object
  $paystatus = new PaymentStatus($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  $paystatus->pay_method = $data->pay_method;
  $paystatus->pay_history = $data->pay_history;
  $paystatus->pat_id = $data->pat_id;

  // Create paystatus
  if($paystatus->create()) {
    echo json_encode(
      array('message' => 'Payment Status Recorded Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Payment Status Not Recorded')
    );
  }

