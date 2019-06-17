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

	//condetails query
	$result = $condetails->read();

	//get row count
	$num = $result->rowCount();

	//check if any condetails exists
	if ($num>0) {
		//condetails array
		$condetails_arr = array();
		$condetails_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$condetails_item = array(
				'con_id'=>$con_id,
				'con_pc'=>$con_pc,
				'con_hpc'=>$con_hpc,
				'con_drug_history'=>$con_drug_history,
				'con_date'=>$con_date,
				'pat_id'=>$pat_id,
				'pat_name'=>$pat_name,
				'pat_surname'=>$pat_surname,
				'pat_email'=>$pat_email
			);

			//push to 'data'
			array_push($condetails_arr['data'], $condetails_item);
		}

		//turn it to json and output it

	    echo json_encode($condetails_arr);
	} else {
		//no condetails exists
		echo json_encode(array('message'=>'No Consultation Details Found!'));
	}