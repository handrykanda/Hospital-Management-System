<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Doctor.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate doctor object
	$doctor = new Doctor($db);

	//get Doctor id
	$doctor->doc_id = isset($_GET['doc_id']) ? $_GET['doc_id'] : die();

	//get the Doctor
	$doctor->read_single();

	//create an array
	$doctor_arr = array();
	$doctor_arr['data'] = array();
	$doctor_item = array(
		'doc_id'=>$doctor->doc_id,
		'doc_name'=>$doctor->doc_name,
		'doc_surname'=>$doctor->doc_surname,
		'doc_email'=>$doctor->doc_email,
		'doc_phone'=>$doctor->doc_phone,
		'doc_address'=>$doctor->doc_image,
		'doc_pwd'=>$doctor->doc_pwd,
		'doc_specialty'=>$doctor->doc_specialty,
		'doc_education'=>$doctor->doc_education
	);

	//push to 'data'
	array_push($doctor_arr['data'], $doctor_item);

	//to json
	print_r(json_encode($doctor_arr));