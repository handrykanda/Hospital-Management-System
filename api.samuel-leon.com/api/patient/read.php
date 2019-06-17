<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Patient.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate patient object
	$patient = new Patient($db);

	//patient query
	$result = $patient->read();

	//get row count
	$num = $result->rowCount();

	//check if any patient exists
	if ($num>0) {
		//patient array
		$patient_arr = array();
		$patient_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$patient_item = array(
				'pat_id'=>$pat_id,
				'pat_name'=>$pat_name,
				'pat_surname'=>$pat_surname,
				'pat_email'=>$pat_email,
				'pat_phone'=>$pat_phone,
				'pat_address'=>$pat_address,
				'pat_pwd'=>$pat_pwd,
				'pat_dob'=>$pat_dob,
				'pat_gender'=>$pat_gender,
				'pat_med_history'=>$pat_med_history,
				'pat_surg_history'=>$pat_surg_history,
				'pat_med_current'=>$pat_med_current,
				'pat_occupation'=>$pat_occupation
			);

			//push to 'data'
			array_push($patient_arr['data'], $patient_item);
		}

		//turn it to json and output it

	    echo json_encode($patient_arr);
	} else {
		//no patients exists
		echo json_encode(array('message'=>'No Patients Found!'));
	}