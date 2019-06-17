<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Doctor.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate Doctor object
	$doctor = new Doctor($db);

	//Doctor query
	$result = $doctor->read();

	//get row count
	$num = $result->rowCount();

	//check if any Doctors exists
	if ($num>0) {
		//doctor array
		$doctor_arr = array();
		$doctor_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$doctor_item = array(
				'doc_id'=>$doc_id,
				'doc_name'=>$doc_name,
				'doc_surname'=>$doc_surname,
				'doc_email'=>$doc_email,
				'doc_phone'=>$doc_phone,
				'doc_address'=>$doc_image,
				'doc_pwd'=>$doc_pwd,
				'doc_specialty'=>$doc_specialty,
				'doc_education'=>$doc_education
			);

			//push to 'data'
			array_push($doctor_arr['data'], $doctor_item);
		}

		//turn it to json and output it

	    echo json_encode($doctor_arr);
	} else {
		//no Doctors exists
		echo json_encode(array('message'=>'No Doctors Found!'));
	}