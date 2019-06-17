<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Nurse.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate nurse object
	$nurse = new Nurse($db);

	//get nurse id
	$nurse->nurse_id = isset($_GET['nurse_id']) ? $_GET['nurse_id'] : die();

	//get the nurse
	$nurse->read_single();

	//create an array
	$nurse_arr = array();
	$nurse_arr['data'] = array();
	$nurse_item = array(
		'nurse_id'=>$nurse->nurse_id,
		'nurse_name'=>$nurse->nurse_name,
		'nurse_surname'=>$nurse->nurse_surname,
		'nurse_email'=>$nurse->nurse_email,
		'nurse_phone'=>$nurse->nurse_phone,
		'nurse_address'=>$nurse->nurse_address,
		'nurse_pwd'=>$nurse->nurse_pwd
	);

	//push to 'data'
	array_push($nurse_arr['data'], $nurse_item);

	//to json
	print_r(json_encode($nurse_arr));