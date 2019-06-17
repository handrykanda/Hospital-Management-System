<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/PaymentStatus.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate patient object
  $paystatus = new PaymentStatus($db);

  // Get raw  data
  $data = json_decode(file_get_contents("php://input"));

  //set id to update
  $paystatus->pay_status_id = $data->pay_status_id;

  // Delete PaymentStatus
  if($paystatus->delete()) {
    echo json_encode(
      array('message' => 'Payment Status Delete Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Payment Status Not Delete')
    );
  }

