<?php
	//headers
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/DiagnosisDetails.php';

	//instantiate and connect to DB
	$database = new Database();
	$db = $database->connect();

	//instantiate diadetails object
	$diadetails = new DiagnosisDetails($db);

	//diadetails query
	$result = $diadetails->read();

	//get row count
	$num = $result->rowCount();

	//check if any diadetails exists
	if ($num>0) {
		//diadetails array
		$diadetails_arr = array();
		$diadetails_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$diadetails_item = array(
				'dia_id'=>$dia_id,
				'dia_date'=>$dia_date,
				'dia_weight'=>$dia_weight,
				'dia_bp'=>$dia_bp,
				'dia_temp'=>$dia_temp,
				'dia_blood_type'=>$dia_blood_type,
				'dia_blood_count'=>$dia_blood_count,
				'dia_glucose_tolerance'=>$dia_glucose_tolerance,
				'dia_pulse'=>$dia_pulse,
				'pat_id'=>$pat_id,
				'pat_name'=>$pat_name,
				'pat_surname'=>$pat_surname,
				'pat_email'=>$pat_email
			);

			//push to 'data'
			array_push($diadetails_arr['data'], $diadetails_item);
		}

		//turn it to json and output it

	    echo json_encode($diadetails_arr);
	} else {
		//no diadetails exists
		echo json_encode(array('message'=>'No Diagnosis Details Found!'));
	}