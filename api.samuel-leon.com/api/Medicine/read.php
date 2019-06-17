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

	//Medication query
	$result = $med->read();

	//get row count
	$num = $result->rowCount();

	//check if any Medication exists
	if ($num>0) {
		//Medication array
		$med_arr = array();
		$med_arr['data'] = array();

		while ( $row = $result->fetch(PDO::FETCH_ASSOC)) {
			extract($row);
			$med_item = array(
				'med_id'=>$med_id,
				'med_name'=>$med_name,
				'med_price'=>$med_price,
				'pat_id'=>$pat_id,
				'doc_id'=>$doc_id
			);

			//push to 'data'
			array_push($med_arr['data'], $med_item);
		}

		//turn it to json and output it

	    echo json_encode($med_arr);
	} else {
		//no Medication exists
		echo json_encode(array('message'=>'No Medications Found!'));
	}