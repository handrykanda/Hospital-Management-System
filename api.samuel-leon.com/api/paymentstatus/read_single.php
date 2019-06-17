<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/PaymentStatus.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate paystatus object
	$paystatus = new PaymentStatus($db);

	//get paystatus id
	$paystatus->pay_status_id = isset($_GET['pay_status_id']) ? $_GET['pay_status_id'] : die();

	//get the paystatus
	$paystatus->read_single();

	//create an array
	$paystatus_arr = array();
	$paystatus_arr['data'] = array();
	$paystatus_item = array(
		'pay_status_id'=>$paystatus->pay_status_id,
		'pay_method'=>$paystatus->pay_method,
		'pay_history'=>$paystatus->pay_history,
		'pat_id'=>$paystatus->pat_id
	);

	//push to 'data'
	array_push($paystatus_arr['data'], $paystatus_item);

	//to json
	print_r(json_encode($paystatus_arr));