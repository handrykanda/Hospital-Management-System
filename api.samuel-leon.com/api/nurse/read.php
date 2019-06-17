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

	//nurse query
	$result = $nurse->read();

	//get row count
	$num = $result->rowCount();

	//check if any nurse exists
	if ($num>0) {
		//nurse array
		$nurse_arr = array();
		$nurse_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$nurse_item = array(
				'nurse_id'=>$nurse_id,
				'nurse_name'=>$nurse_name,
				'nurse_surname'=>$nurse_surname,
				'nurse_email'=>$nurse_email,
				'nurse_phone'=>$nurse_phone,
				'nurse_address'=>$nurse_address,
				'nurse_pwd'=>$nurse_pwd
			);

			//push to 'data'
			array_push($nurse_arr['data'], $nurse_item);
		}

		//turn it to json and output it

	    echo json_encode($nurse_arr);
	} else {
		//no nurses exists
		echo json_encode(array('message'=>'No Nurses Found!'));
	}