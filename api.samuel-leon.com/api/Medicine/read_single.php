<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Medication.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate Medication object
	$med = new Medication($db);

	//get med id
	$med->med_id = isset($_GET['med_id']) ? $_GET['med_id'] : die();

	//get the Medication
	$med->read_single();

	//create an array
	$med_arr = array();
	$med_arr['data'] = array();
	$med_item = array(
		'med_id'=>$med->med_id,
		'med_name'=>$med->med_name,
		'med_price'=>$med->med_price,
		'pat_id'=>$med->pat_id,
		'doc_id'=>$med->doc_id
	);

	//push to 'data'
	array_push($med_arr['data'], $med_item);

	//to json
	print_r(json_encode($med_arr));