<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/ConsultationDetails.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate condetails object
	$condetails = new ConsultationDetails($db);

	//get pat id
	$condetails->pat_id = isset($_GET['pat_id']) ? $_GET['pat_id'] : die();

	//get the condetails
	$condetails->read_single();

	//create an array
	$condetails_arr = array();
	$condetails_arr['data'] = array();
	$condetails_item = array(
		'con_id'=>$condetails->con_id,
		'con_pc'=>$condetails->con_pc,
		'con_hpc'=>$condetails->con_hpc,
		'con_drug_history'=>$condetails->con_drug_history,
		'con_date'=>$condetails->con_date,
		'doc_id'=>$condetails->doc_id,
		'pat_id'=>$condetails->pat_id
	);

	//push to 'data'
	array_push($condetails_arr['data'], $condetails_item);

	//to json
	print_r(json_encode($condetails_arr));