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

	//receptionist query
	$result = $receptionist->read();

	//get row count
	$num = $result->rowCount();

	//check if any receptionist exists
	if ($num>0) {
		//receptionist array
		$receptionist_arr = array();
		$receptionist_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$receptionist_item = array(
				'rep_id'=>$rep_id,
				'rep_name'=>$rep_name,
				'rep_surname'=>$rep_surname,
				'rep_email'=>$rep_email,
				'rep_phone'=>$rep_phone,
				'rep_address'=>$rep_address,
				'rep_pwd'=>$rep_pwd
			);

			//push to 'data'
			array_push($receptionist_arr['data'], $receptionist_item);
		}

		//turn it to json and output it

	    echo json_encode($receptionist_arr);
	} else {
		//no receptionists exists
		echo json_encode(array('message'=>'No Receptionist Found!'));
	}