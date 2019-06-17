<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Patient.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate condetails object
  $patient = new Patient($db);

  //get pat_email
  $patient->pat_email = isset($_GET['pat_email']) ? $_GET['pat_email'] : die();

  if($patient->emailExists()) {


    $email_arr = array();
    $email_arr['data'] = array();
    $email = array(
      'response'=>$patient->pat_email
    );

    //push to 'data'
    array_push($email_arr['data'], $email);

    //to json
    print_r(json_encode($email_arr));
  } else {

    $email_arr = array();
    $email_arr['data'] = array();
    $email = array(
      'response'=>'null'
    );

    //push to 'data'
    array_push($email_arr['data'], $email);

    //to json
    print_r(json_encode($email_arr));

  }

