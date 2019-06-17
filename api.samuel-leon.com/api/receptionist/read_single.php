<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Receptionist.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate receptionist object
	$receptionist = new Receptionist($db);

	//get receptionist id
	$receptionist->rep_id = isset($_GET['rep_id']) ? $_GET['rep_id'] : die();

	//get the patient
	$receptionist->read_single();

	//create an array
	$receptionist_arr = array();
	$receptionist_arr['data'] = array();
	$receptionist_item = array(
		'rep_id'=>$receptionist->rep_id,
		'rep_name'=>$receptionist->rep_name,
		'rep_surname'=>$receptionist->rep_surname,
		'rep_email'=>$receptionist->rep_email,
		'rep_phone'=>$receptionist->rep_phone,
		'rep_address'=>$receptionist->rep_address,
		'rep_pwd'=>$receptionist->rep_pwd
	);

	//push to 'data'
	array_push($patient_arr['data'], $receptionist_item);


	//to json
	print_r(json_encode($receptionist_arr));