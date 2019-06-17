<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/DiagnosisDetails.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate diadetails object
	$diadetails = new DiagnosisDetails($db);

	//get pat id
	$diadetails->pat_id = isset($_GET['pat_id']) ? $_GET['pat_id'] : die();

	//get the diadetails
	$diadetails->read_single();

	//create an array
	$diadetails_arr = array();
	$diadetails_arr['data'] = array();
	$diadetails_item = array(
		'dia_id'=>$diadetails->dia_id,
		'dia_red_flag'=>$diadetails->dia_red_flag,
		'dia_date'=>$diadetails->dia_date,
		'dia_weight'=>$diadetails->dia_weight,
		'dia_bp'=>$diadetails->dia_bp,
		'dia_temp'=>$diadetails->dia_temp,
		'dia_blood_type'=>$diadetails->dia_blood_type,
		'dia_blood_count'=>$diadetails->dia_blood_count,
		'dia_glucose_tolerance'=>$diadetails->dia_glucose_tolerance,
		'dia_pulse'=>$diadetails->dia_pulse,
		'pat_id'=>$diadetails->pat_id,
		'nurse_id'=>$diadetails->nurse_id,
	);

	//push to 'data'
	array_push($diadetails_arr['data'], $diadetails_item);

	//to json
	print_r(json_encode($diadetails_arr));