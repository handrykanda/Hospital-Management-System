<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  //set id to update
  $paystatus->pay_status_id = $data->pay_status_id;

  $paystatus->pay_method = $data->pay_method;
  $paystatus->pay_history = $data->pay_history;
  $paystatus->pat_id = $data->pat_id;

  // Update paystatus
  if($paystatus->update()) {
    echo json_encode(
      array('message' => 'Payment Status Updated Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'Payment Status Not Updated')
    );
  }

