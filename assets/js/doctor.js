
$.urlParam = function(doc_id){
	var results = new RegExp('[\?&]' + doc_id + '=([^&#]*)').exec(window.location.href);
	if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
}
var page = /doctor/;
var url =window.location.href;  
if(page.test(url)){
	$('#sign_up').hide();
	$('#login').hide();
	$('#logout').show();

	var $doc_id = decodeURIComponent($.urlParam('doc_id')); 

}  


/*Patient Consultation Details*/
var $con_date = $('#con_date');
var $con_pc = $('#con_pc');
var $con_hpc = $('#con_hpc');
var $con_drug_history = $('#con_drug_history');



var $patients = $('#patients');
var $patient = $('#patient');
var $patients_table = '<table id="pat_table" class="display table table-stripped" style="width:100%">'+
'<thead>'+
'<tr style="color: #50d8af;font-family: "Times New Roman", Times, serif;">'+
'<th>Name</th>'+
'<th>Surname</th>'+
'<th>Email</th>'+
'</tr>'+
'</thead>'+
'<tbody>';

$.ajax({
	type: 'GET',
	url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/read.php',
	success: function (patients) {
		$.each(patients.data, function (index, patient) {
					$patients_table += '<tr style="cursor: pointer;color: #0c2e8a;" class="single_patient" id="'+patient.pat_id+'">';
			        $patients_table += '<td>'+patient.pat_name
			        +'</td><td>'+patient.pat_surname
			        +'</td><td>'+patient.pat_email
			        +'</td>';
			        $patients_table += '</tr>';
								
		});
		$patients_table += '</tbody>';
		$patients_table += '</table>';
		$patients.append($patients_table);

	},
	error: function() {
		toastr.error('Error loading patients!');
	}
});


$patients.delegate('.single_patient','click', function () {

	var $pat_id = $(this).attr('id');
	var $mypatient = $('#patient');



	var $patient_table = '<table class="mytable">'+
	'<thead>'+
	'</thead>'+
	'<tbody>';

	$.ajax({
		type: 'GET',
		url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/read_single.php?pat_id='+$pat_id,
		success: function (patient) {

			$patients.slideUp();
			$patient.slideDown();
			$('#pats_header').hide();
			$('#backbtn').show();
			$('#pat_header').show();
			$('#edit_con').show();
			$('#backbtn').show();
			$.each(patient.data, function (index, patient) {

				/*$patient_table += '<tr style="padding=15px;">';*/

				$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Identity Information</td></tr>';
				$patient_table += '<td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Name:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_name+'&nbsp;&nbsp;&nbsp;'+patient.pat_surname+'</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Date of Birth:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_dob+'</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Gender:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_gender+'</td></tr>';
				$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Medical History</td>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Madical History:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_med_history+'</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Surgery History:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_surg_history+'</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Current Medical:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_med_current+'</td></tr>';
				$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Occupation Details</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Occupation:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_occupation+'</td></tr>';
				$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Contact Information</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Email Address:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_email+'</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Phone Number:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_phone+'</td></tr>';
				$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Address:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+patient.pat_address+'</td>';

				$patient_table += '</tr>';

			});

		},
		error: function() {
			toastr.error('Error loading patient!');
		}
	});

	$.ajax({
		type: 'GET',
		url: 'http://localhost/clinica/api.samuel-leon.com/api/diagnosisdetails/read_single.php?pat_id='+$pat_id,
		success: function (dia_details) {
			var $nurse_id = dia_details.data[0].nurse_id;
			$.ajax({
				type: 'GET',
				url: 'http://localhost/clinica/api.samuel-leon.com/api/nurse/read_single.php?nurse_id='+$nurse_id,
				success: function (nurse_details) {
					
					if ($pat_id == dia_details.data[0].pat_id) {

						if (nurse_details.data[0].nurse_id == dia_details.data[0].nurse_id) {
							$.each(dia_details.data, function (index, details) {

								if (details.dia_red_flag == 1) {
									toastr.warning('This patient needs special attention!');
								}
       							$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Diagnosis Details</td></tr>';
								$patient_table += '<td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Blood Pressure:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_bp+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Blood Type:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_blood_type+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Blood Count:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_blood_count+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Glucose Tolerance:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_glucose_tolerance+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Pulse Rate:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_pulse+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Temperature:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_temp+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Weight:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_weight+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Diagnosis Date:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+details.dia_date+'</td></tr>';


							});

							$.each(nurse_details.data, function (index, nurse) {

								$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Collected By:</td></tr>';
			                    $patient_table += '<td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Name:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+nurse.nurse_name+'&nbsp;&nbsp;&nbsp;'+nurse.nurse_surname+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Email Address:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+nurse.nurse_email+'</td></tr>';
								$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Phone Number:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+nurse.nurse_phone+'</td></tr>';


							});

							$.ajax({
								type: 'GET',
								url: 'http://localhost/clinica/api.samuel-leon.com/api/consultationdetails/read_single.php?pat_id='+$pat_id,
								success: function (con_details) {

									var $doc_id1 = con_details.data[0].doc_id;

									if ($pat_id == con_details.data[0].pat_id) {
										$.each(con_details.data, function (index, con) {

											$patient_table += '<tr id="headings"><td style="color: #50d8af; padding-bottom: 5px;padding-top: 5px; font-family: "Times New Roman", Times, serif;font-size: 20px;">Consultation Details:</td></tr>';
			                    			$patient_table += '<td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Primary Complaint:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+con.con_pc+'</td></tr>';
											$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>History Primary<br> Complaint:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+con.con_hpc+'</td></tr>';
											$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Drug History:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+con.con_drug_history+'</td></tr>';
											$patient_table += '<tr><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;"><Strong>Consultation Date:</strong></td><td style="color: #0c2e8a;text-indent: 10px;font-family: "Times New Roman", Times, serif;cursor: pointer;">'+con.con_date+'</td></tr>';

								     

							            });

							            //doctor's details
							            $.ajax({
							            	type: 'GET',
							            	url: 'http://localhost/clinica/api.samuel-leon.com/api/doctor/read_single.php?doc_id='+$doc_id1,
							            	success: function (doc) {

							            		$patient_table += '<tr><td colspan="3" class="s"><hr></td></tr>';
							            		$patient_table += '<tr><td colspan="3" style="color: #0c2e8a;text-align: center;font-family: "Times New Roman", Times, serif; font-size: 15px;cursor: pointer;" class="s">Get in touch with Dr '+doc.data[0].doc_name+'&nbsp;&nbsp;'+doc.data[0].doc_surname+
							            		'. You can send a message at '+doc.data[0].doc_email+' or call at '+doc.data[0].doc_phone+'.</td></tr><br>';
							            		$patient_table += '<tr><td colspan="3" style="color: #0c2e8a;text-align: center;font-family: "Times New Roman", Times, serif; font-size: 15px;cursor: pointer;" class="s"> Dr '+doc.data[0].doc_surname+' ('+doc.data[0].doc_specialty+
							            		') has the following qualification: <br></td></tr>';
							            		$patient_table += '<tr><td colspan="3" style="color: #0c2e8a;text-align: center;font-family: "Times New Roman", Times, serif; font-size: 15px;cursor: pointer;" class="s">'+doc.data[0].doc_education+'</td></tr><br><br>';


							            		//clinic details
							            		$patient_table += '<tr><td colspan="3" class="s"><hr></td></tr>';
							            		$patient_table += '<tr><td colspan="3" style="color: #50d8af;text-align: center;font-size: 20px;font-family: "Times New Roman", Times, serif;" id="sl">Samuel Leon Clinic</td></tr><br>';
							            		$patient_table += '<tr><td colspan="3" style="color: #0c2e8a;text-align: center;font-family: "Times New Roman", Times, serif; font-size: 15px;cursor: pointer;" class="s">52 Josiah Chinamano Avenue Avenues, Harare, Zimbabwe</td></tr><br>';
							            		$patient_table += '<tr><td colspan="3" style="color: #0c2e8a;text-align: center;font-family: "Times New Roman", Times, serif; font-size: 15px;cursor: pointer;" class="s">info@slfamilyclinic.com</td></tr>';
							            		$patient_table += '<tr><td colspan="3" style="color: #0c2e8a;text-align: center;font-family: "Times New Roman", Times, serif; font-size: 15px;cursor: pointer;" class="s">+263 785 663 4598</td></tr>';

							            		
							            		$patient_table += '</tbody>';
							            		$patient_table += '</table>';
							            		$mypatient.append($patient_table);
							            		
							            	},
							            	error: function() {
							            		toastr.error('Error loading doctor details!');
							            	}
							            });

							            
							            
							            $('#con_form').hide();
							            $('#print').show();


							            //Edit consultation
							            
							            $('#edit_con').on('click', function (){
							            	$('#mycon').slideUp();
							            	$patient.slideUp();
							            	$('#edit_con').slideUp();
							            	$('#con_save').hide();
							            	$('#con_save2').show();
							            	$('#print').hide();



							            	$.ajax({
							            		type: 'GET',
							            		url: 'http://localhost/clinica/api.samuel-leon.com/api/consultationdetails/read_single.php?pat_id='+con_details.data[0].pat_id,
							            		success: function (con) {

							            			$con_date.val(con.data[0].con_date);
							            			$con_pc.val(con.data[0].con_pc);
							            			$con_hpc.val(con.data[0].con_hpc);
							            			$con_drug_history.val(con.data[0].con_drug_history);

							            			$('#con_form').slideDown();

							            		},
							            		error: function() {
							            			toastr.error('Error loading consultation details!');
							            		}
							            	});

							            });

							            //Save edited Patient consultation details
							            $('#con_save2').on('click', function (){
							            	$('#con_form').slideUp();

							            	var details = {
							            		"con_id" : con_details.data[0].con_id,
							            		"con_date" : $con_date.val(),
							            		"con_pc": $con_pc.val(),
							            		"con_hpc": $con_hpc.val(),
							            		"con_drug_history": $con_drug_history.val(),
							            		"doc_id": $doc_id,
							            		"pat_id": $pat_id

							            	};

							            	details = JSON.stringify(details);
							            	$.ajax({
							            		type: 'PUT',
							            		url: 'http://localhost/clinica/api.samuel-leon.com/api/consultationdetails/update.php',
							            		data: details,
							            		success: function (pat) {

							            			toastr.success("Done")



							            		},
							            		error: function() {
							            			toastr.error("Ooops! Something went wrong!")
							            		}
							            	});

							            });


									}else{
										toastr.info('This patient does not have consultation details!');
										$patient_table += '</tbody>';
										$patient_table += '</table>';
										$mypatient.append($patient_table);
										$('#edit_con').hide();

										/*Patient Consultation*/
										$('#con_save').on('click', function () {
											var con_data = {
												"con_date": $con_date.val(),
												"con_pc": $con_pc.val(),
												"con_hpc": $con_hpc.val(),
												"con_drug_history": $con_drug_history.val(),
												"pat_id": $pat_id,
												"doc_id": $doc_id
											};
											con_data = JSON.stringify(con_data);
											$.ajax({
												type: 'POST',
												url: 'http://localhost/clinica/api.samuel-leon.com/api/consultationdetails/create.php',
												data: con_data,
												success: function (con_details) {
													toastr.success('Details Recorded Successfully');
												},
												error: function() {
													toastr.error('Error Recording The Details!');
												}
											});

										});
									} 
								},
								error: function() {
									toastr.error('Error Loading The Details!');
								}
							});


						} else {
							$patient_table += '</tbody>';
							$patient_table += '</table>';
							$mypatient.append($patient_table);
						    toastr.info('Can not find the Nurse who collected these details!');
					}


					


					$('#con_form').show("slow");
						
					} else {
						$patient_table += '</tbody>';
						$patient_table += '</table>';
						$mypatient.append($patient_table);
						toastr.info('This patient does not have diagnosis details!');
						$('#edit_con').hide();
					}
				},
				error: function() {
					toastr.error('Error Loading Nurse Details');
				}
			});
			

		},
		error: function() {
			toastr.error('Error Loading Diagnosis Details!');

		}
	});

});
