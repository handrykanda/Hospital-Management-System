
$.urlParam = function(nurse_id){
	var results = new RegExp('[\?&]' + nurse_id + '=([^&#]*)').exec(window.location.href);
	if (results==null){
		return null;
	}
	else{
		return results[1] || 0;
	}
}

var page = /nurse/;
var url =window.location.href;  
if(page.test(url)){
	$('#sign_up').hide();
	$('#login').hide();
	$('#logout').show();
	var $nurse_id = decodeURIComponent($.urlParam('nurse_id')); 

} 

/*Patient Diagnosis Details*/
var $dia_red_flag = $('#dia_red_flag');
var $dia_date = $('#dia_date');
var $dia_weight = $('#dia_weight');
var $dia_bp = $('#dia_bp');
var $dia_temp = $('#dia_temp');
var $dia_blood_type = $('#dia_blood_type');
var $dia_blood_count = $('#dia_blood_count');
var $dia_glucose_tolerance = $('#dia_glucose_tolerance');
var $dia_pulse = $('#dia_pulse');

var $npatients = $('#npatients');
var $npatient = $('#npatient');
var $npats_header = $('#npats_header');
var $npat_header = $('#pat_header');
var $dia_form = $('#dia_form');

var $npatients_table = '<table id="pat_table" class="display table table-stripped" style="width:100%">'+
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
		$.each(patients.data, function (index, npatient) {
			$npatients_table += '<tr style="cursor: pointer;color: #0c2e8a;" class="nsingle_patient" id="'+npatient.pat_id+'">';
			$npatients_table += '<td>'+npatient.pat_name
			+'</td><td>'+npatient.pat_surname
			+'</td><td>'+npatient.pat_email
			+'</td>';
			$npatients_table += '</tr>';

		});
		$npatients_table += '</tbody>';
		$npatients_table += '</table>';
		$npatients.append($npatients_table);

	},
	error: function() {
		toastr.error('Error loading patients!');
	}
});

$npatients.delegate('.nsingle_patient','click', function () {
	
	$npatients.slideUp();
	$npatient.slideDown();
	$('#npats_header').hide();
	$('#edit_dia').show();
	$('#backbtn').show();

	var $pat_id = $(this).attr('id');

	var $npatient_table = '<table class="mytable">'+
	'<thead>'+
	'</thead>'+
	'<tbody>';

	$.ajax({
		type: 'GET',
		url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/read_single.php?pat_id='+$pat_id,
		success: function (patient) {
			
			

			$npatient_table += '<tr style="padding=15px;">';

			$npatient_table += '<tr id="headings"><td>Identity Information</td></tr>';
			$npatient_table += '<td><Strong>Name:</strong></td><td>'+patient.data[0].pat_name+'&nbsp;&nbsp;&nbsp;'+patient.data[0].pat_surname+'</td></tr>';
			$npatient_table += '<tr><td><Strong>Date of Birth:</strong></td><td>'+patient.data[0].pat_dob+'</td></tr>';
			$npatient_table += '<tr><td><Strong>Gender:</strong></td><td>'+patient.data[0].pat_gender+'</td></tr>';
			$npatient_table += '<tr id="headings"><td>Medical History</td>';
			$npatient_table += '<tr><td><Strong>Madical History:</strong></td><td>'+patient.data[0].pat_med_history+'</td></tr>';
			$npatient_table += '<tr><td><Strong>Surgery History:</strong></td><td>'+patient.data[0].pat_surg_history+'</td></tr>';
			$npatient_table += '<tr><td><Strong>Current Medical:</strong></td><td>'+patient.data[0].pat_med_current+'</td></tr>';
			$npatient_table += '<tr id="headings"><td>Occupation Details</td></tr>';
			$npatient_table += '<tr><td><Strong>Occupation:</strong></td><td>'+patient.data[0].pat_occupation+'</td></tr>';
			$npatient_table += '<tr id="headings"><td>Contact Information</td></tr>';
			$npatient_table += '<tr><td><Strong>Email Address:</strong></td><td>'+patient.data[0].pat_email+'</td></tr>';
			$npatient_table += '<tr><td><Strong>Phone Number:</strong></td><td>'+patient.data[0].pat_phone+'</td></tr>';
			$npatient_table += '<tr><td><Strong>Address:</strong></td><td>'+patient.data[0].pat_address+'</td>';

			$npatient_table += '</tr>';

			
			
			$npatient.append($npatient_table);

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
							

							if (dia_details.dia_red_flag == 1) {
								toastr.warning('This patient needs special attention!');
							}

							$npatient_table += '<tr>';
							$npatient_table += '<tr id="headings"><td>Diagnosis Details</td></tr>';
							$npatient_table += '<td><Strong>Blood Pressure:</strong></td><td>'+dia_details.data[0].dia_bp+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Blood Type:</strong></td><td>'+dia_details.data[0].dia_blood_type+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Blood Count:</strong></td><td>'+dia_details.data[0].dia_blood_count+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Glucose Tolerance:</strong></td><td>'+dia_details.data[0].dia_glucose_tolerance+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Pulse Rate:</strong></td><td>'+dia_details.data[0].dia_pulse+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Temperature:</strong></td><td>'+dia_details.data[0].dia_temp+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Weight:</strong></td><td>'+dia_details.data[0].dia_weight+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Diagnosis Date:</strong></td><td>'+dia_details.data[0].dia_date+'</td></tr>';

							$npatient_table += '</tr>';

							

							

							$npatient_table += '<tr>';
							$npatient_table += '<tr id="headings"><td>Collected By:</td></tr>';
							$npatient_table += '<td><Strong>Name:</strong></td><td>'+nurse_details.data[0].nurse_name+'&nbsp;&nbsp;&nbsp;'+nurse_details.data[0].nurse_surname+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Email Address:</strong></td><td>'+nurse_details.data[0].nurse_email+'</td></tr>';
							$npatient_table += '<tr><td><Strong>Phone Number:</strong></td><td>'+nurse_details.data[0].nurse_phone+'</td></tr>';

							$npatient_table += '</tr>';

							

							$.ajax({
								type: 'GET',
								url: 'http://localhost/clinica/api.samuel-leon.com/api/consultationdetails/read_single.php?pat_id='+$pat_id,
								success: function (con_details) {
									if ($pat_id == con_details.data[0].pat_id) {
										

										$npatient_table += '<tr>';
										$npatient_table += '<tr id="headings"><td>Consultation Details:</td></tr>';
										$npatient_table += '<td><Strong>Primary Complaint:</strong></td><td>'+con_details.data[0].con_pc+'</td></tr>';
										$npatient_table += '<tr><td><Strong>History Primary<br> Complaint:</strong></td><td>'+con_details.data[0].con_hpc+'</td></tr>';
										$npatient_table += '<tr><td><Strong>Drug History:</strong></td><td>'+con_details.data[0].con_drug_history+'</td></tr>';
										$npatient_table += '<tr><td><Strong>Consultation Date:</strong></td><td>'+con_details.data[0].con_date+'</td></tr>';

										$npatient_table += '</tr>';


										$npatient_table += '</tbody>';
										$npatient_table += '</table>';
										$npatient.append($npatient_table);
									}else{
										$npatient_table += '</tbody>';
										$npatient_table += '</table>';
										$npatient.append($npatient_table);
									} 
								},
								error: function() {
									toastr.error('Error Loading The Details!');
								}
							});


						} 
						else {
							$npatient_table += '</tbody>';
							$npatient_table += '</table>';
							$npatient.append($npatient_table);
							toastr.info('Can not find the Nurse who collected these details!');
						}


						
						

						//Edit diagnosis
						
						$('#edit_dia').on('click', function (){
							$('#mydia').slideUp();
							$npatient.slideUp();
							$('#edit_dia').slideUp();
							$('#dia_save').hide();
							$('#dia_save2').show();



							$.ajax({
								type: 'GET',
								url: 'http://localhost/clinica/api.samuel-leon.com/api/diagnosisdetails/read_single.php?pat_id='+dia_details.data[0].pat_id,
								success: function (dia) {

									$dia_red_flag.val(dia.data[0].dia_red_flag);
									$dia_date.val(dia.data[0].dia_date);
									$dia_weight.val(dia.data[0].dia_weight);
									$dia_bp.val(dia.data[0].dia_bp);
									$dia_temp.val(dia.data[0].dia_temp);
									$dia_blood_type.val(dia.data[0].dia_blood_type);
									$dia_blood_count.val(dia.data[0].dia_blood_count);
									$dia_glucose_tolerance.val(dia.data[0].dia_glucose_tolerance);
									$dia_pulse.val(dia.data[0].dia_pulse);

									$('#dia_form').slideDown();

								},
								error: function() {
									toastr.error('Error loading diagnosis details!');
								}
							});

						});
						

						//Save edited Patient details
						$('#dia_save2').on('click', function (){
							$('#dia_form').slideUp();

							var details = {
								"dia_id" : dia_details.data[0].dia_id,
								"dia_red_flag" : $dia_red_flag.val(),
								"dia_date": $dia_date.val(),
								"dia_weight": $dia_weight.val(),
								"dia_bp": $dia_bp.val(),
								"dia_temp": $dia_temp.val(),
								"dia_blood_type": $dia_blood_type.val(),
								"dia_blood_count": $dia_blood_count.val(),
								"dia_glucose_tolerance": $dia_glucose_tolerance.val(),
								"dia_pulse": $dia_pulse.val(),
								"nurse_id": $nurse_id,
								"pat_id": $pat_id

							};

							details = JSON.stringify(details);
							$.ajax({
								type: 'PUT',
								url: 'http://localhost/clinica/api.samuel-leon.com/api/diagnosisdetails/update.php',
								data: details,
								success: function (pat) {

									toastr.success("Done")

								},
								error: function() {
									toastr.error("Ooops! Something went wrong!")
								}
							});

							$('#mypat').show();

						});
						
					} 
					else {
						toastr.info('This patient does not have diagnosis details!');

						
						$('#edit_dia').hide();

						$dia_form.slideDown();

						
						/* Patient diagnosis*/
						$('#dia_save').on('click', function () {

							$.urlParam = function(nurse_id){
								var results = new RegExp('[\?&]' + nurse_id + '=([^&#]*)').exec(window.location.href);
								if (results==null){
									return null;
								}
								else{
									return results[1] || 0;
								}
							}

							var page = /nurse/;
							var url =window.location.href;  
							if(page.test(url)){
								$('#sign_up').hide();
								$('#login').hide();
								$('#logout').show();
								var $nurse_id = decodeURIComponent($.urlParam('nurse_id')); 

							}  

							$npatients.slideDown();
							$npats_header.show();
							$dia_form.hide();

							var dia_patient = {
								"dia_red_flag": $dia_red_flag.val(),
								"dia_date": $dia_date.val(),
								"dia_weight": $dia_weight.val(),
								"dia_bp": $dia_bp.val(),
								"dia_temp": $dia_temp.val(),
								"dia_blood_type": $dia_blood_type.val(),
								"dia_blood_count": $dia_blood_count.val(),
								"dia_glucose_tolerance": $dia_glucose_tolerance.val(),
								"dia_pulse": $dia_pulse.val(),
								"pat_id": $pat_id,
								"nurse_id": $nurse_id
							};

							dia_patient = JSON.stringify(dia_patient);

							$.ajax({
								type: 'POST',
								url: 'http://localhost/clinica/api.samuel-leon.com/api/diagnosisdetails/create.php',
								data: dia_patient,
								success: function () {
									toastr.success('Diagnosis Details Recorded');
								},
								error: function() {
									toastr.success('Diagnosis Details Recorded');
								}
							});

						});
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


