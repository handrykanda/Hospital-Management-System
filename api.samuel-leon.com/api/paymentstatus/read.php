<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/PaymentStatus.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate PaymentStatus object
	$paystatus = new PaymentStatus($db);

	//PaymentStatus query
	$result = $paystatus->read();

	//get row count
	$num = $result->rowCount();

	//check if any PaymentStatus exists
	if ($num>0) {
		//PaymentStatus array
		$paystatus_arr = array();
		$paystatus_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$paystatus_item = array(
				'pay_status_id'=>$pay_status_id,
				'pay_method'=>$pay_method,
				'pay_history'=>$pay_history,
				'pat_id'=>$pat_id
			);

			//push to 'data'
			array_push($paystatus_arr['data'], $paystatus_item);
		}

		//turn it to json and output it

	    echo json_encode($paystatus_arr);
	} else {
		//no Payment Status exists
		echo json_encode(array('message'=>'No Payment Status Found!'));
	}