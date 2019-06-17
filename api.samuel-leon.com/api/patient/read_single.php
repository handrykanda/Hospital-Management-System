<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Patient.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate patient object
	$patient = new Patient($db);

	//get pat id
	$patient->pat_id = isset($_GET['pat_id']) ? $_GET['pat_id'] : die();

	//get the patient
	$patient->read_single();

	//create an array
	$patient_arr = array();
	$patient_arr['data'] = array();

	$patient_item = array(
		'pat_id'=>$patient->pat_id,
		'pat_name'=>$patient->pat_name,
		'pat_surname'=>$patient->pat_surname,
		'pat_email'=>$patient->pat_email,
		'pat_phone'=>$patient->pat_phone,
		'pat_address'=>$patient->pat_address,
		'pat_pwd'=>$patient->pat_pwd,
		'pat_dob'=>$patient->pat_dob,
		'pat_gender'=>$patient->pat_gender,
		'pat_med_history'=>$patient->pat_med_history,
		'pat_surg_history'=>$patient->pat_surg_history,
		'pat_med_current'=>$patient->pat_med_current,
		'pat_occupation'=>$patient->pat_occupation
	);

	//push to 'data'
	array_push($patient_arr['data'], $patient_item);

	//to json
	print_r(json_encode($patient_arr));