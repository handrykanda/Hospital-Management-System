$.urlParam = function(pat_id){
	var results = new RegExp('[\?&]' + pat_id + '=([^&#]*)').exec(window.location.href);
	if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
}
var $pat_id=null;
var page = /patient/;
var url = window.location.href; 
if(page.test(url)){
	$('#sign_up').hide();
	$('#login').hide();
	$('#logout').show();

	var $pat_id = decodeURIComponent($.urlParam('pat_id')); 

} 


var $mypat = $('#mypat');

var $pat_table = '<table class="mytable">'+
'<thead>'+
'</thead>'+
'<tbody>';

$.ajax({
	type: 'GET',
	url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/read_single.php?pat_id='+$pat_id,
	success: function (pat) {
		$.each(pat.data, function (index, patient) {

			$pat_table += '<tr style="padding=15px;">';

			$pat_table += '<tr id="headings"><td>Identity Information</td></tr>';
			$pat_table += '<td><Strong>Name:</strong></td><td>'+patient.pat_name+'&nbsp;&nbsp;&nbsp;'+patient.pat_surname+'</td></tr>';
			$pat_table += '<tr><td><Strong>Date of Birth:</strong></td><td>'+patient.pat_dob+'</td></tr>';
			$pat_table += '<tr><td><Strong>Gender:</strong></td><td>'+patient.pat_gender+'</td></tr>';
			$pat_table += '<tr id="headings"><td>Medical History</td>';
			$pat_table += '<tr><td><Strong>Madical History:</strong></td><td>'+patient.pat_med_history+'</td></tr>';
			$pat_table += '<tr><td><Strong>Surgery History:</strong></td><td>'+patient.pat_surg_history+'</td></tr>';
			$pat_table += '<tr><td><Strong>Current Medical:</strong></td><td>'+patient.pat_med_current+'</td></tr>';
			$pat_table += '<tr id="headings"><td>Occupation Details</td></tr>';
			$pat_table += '<tr><td><Strong>Occupation:</strong></td><td>'+patient.pat_occupation+'</td></tr>';
			$pat_table += '<tr id="headings"><td>Contact Information</td></tr>';
			$pat_table += '<tr><td><Strong>Email Address:</strong></td><td>'+patient.pat_email+'</td></tr>';
			$pat_table += '<tr><td><Strong>Phone Number:</strong></td><td>'+patient.pat_phone+'</td></tr>';
			$pat_table += '<tr><td><Strong>Address:</strong></td><td>'+patient.pat_address+'</td>';

			$pat_table += '</tr>';

		});

		$mypat.append($pat_table);

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

							$pat_table += '<tr>';
							$pat_table += '<tr id="headings"><td>Diagnosis Details</td></tr>';
							$pat_table += '<td><Strong>Blood Pressure:</strong></td><td>'+details.dia_bp+'</td></tr>';
							$pat_table += '<tr><td><Strong>Blood Type:</strong></td><td>'+details.dia_blood_type+'</td></tr>';
							$pat_table += '<tr><td><Strong>Blood Count:</strong></td><td>'+details.dia_blood_count+'</td></tr>';
							$pat_table += '<tr><td><Strong>Glucose Tolerance:</strong></td><td>'+details.dia_glucose_tolerance+'</td></tr>';
							$pat_table += '<tr><td><Strong>Pulse Rate:</strong></td><td>'+details.dia_pulse+'</td></tr>';
							$pat_table += '<tr><td><Strong>Temperature:</strong></td><td>'+details.dia_temp+'</td></tr>';
							$pat_table += '<tr><td><Strong>Weight:</strong></td><td>'+details.dia_weight+'</td></tr>';
							$pat_table += '<tr><td><Strong>Diagnosis Date:</strong></td><td>'+details.dia_date+'</td></tr>';

							$pat_table += '</tr>';

						});

						$.each(nurse_details.data, function (index, nurse) {

							$pat_table += '<tr>';
							$pat_table += '<tr id="headings"><td>Collected By:</td></tr>';
							$pat_table += '<td><Strong>Name:</strong></td><td>'+nurse.nurse_name+'&nbsp;&nbsp;&nbsp;'+nurse.nurse_surname+'</td></tr>';
							$pat_table += '<tr><td><Strong>Email Address:</strong></td><td>'+nurse.nurse_email+'</td></tr>';
							$pat_table += '<tr><td><Strong>Phone Number:</strong></td><td>'+nurse.nurse_phone+'</td></tr>';

							$pat_table += '</tr>';

						});

						$.ajax({
							type: 'GET',
							url: 'http://localhost/clinica/api.samuel-leon.com/api/consultationdetails/read_single.php?pat_id='+$pat_id,
							success: function (con_details) {
								if ($pat_id == con_details.data[0].pat_id) {
									$.each(con_details.data, function (index, con) {

										$pat_table += '<tr>';
										$pat_table += '<tr id="headings"><td>Consultation Details:</td></tr>';
										$pat_table += '<td><Strong>Primary Complaint:</strong></td><td>'+con.con_pc+'</td></tr>';
										$pat_table += '<tr><td><Strong>History Primary<br> Complaint:</strong></td><td>'+con.con_hpc+'</td></tr>';
										$pat_table += '<tr><td><Strong>Drug History:</strong></td><td>'+con.con_drug_history+'</td></tr>';
										$pat_table += '<tr><td><Strong>Consultation Date:</strong></td><td>'+con.con_date+'</td></tr>';

										$pat_table += '</tr>';

									});
									$pat_table += '</tbody>';
									$pat_table += '</table>';
									$mypat.append($pat_table);
								}else{
									$pat_table += '</tbody>';
									$pat_table += '</table>';
									$mypat.append($pat_table);
								} 
							},
							error: function() {
								toastr.error('Error Loading The Details!');
							}
						});


					} else {
						toastr.info('Can not find the Nurse who collected these details!');
					}

				} else {
					toastr.info('This patient does not have diagnosis details!');
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

/*Edit Patient*/
$(document).ready(function(){
  $('#edit_pat').on('click', function (){
    $('#mypat').slideUp();
    $('#edit_pat').slideUp();
    $('#backbtn').show();

    

    $.ajax({
      type: 'GET',
      url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/read_single.php?pat_id='+$pat_id,
      success: function (pat) {
        
        $('#ename').val(pat.data[0].pat_name);
        $('#esurname').val(pat.data[0].pat_surname);
        $('#eemail').val(pat.data[0].pat_email);
        $('#epwd').val(pat.data[0].pat_pwd);
        $('#ephone').val(pat.data[0].pat_phone);
        $('#eaddress').val(pat.data[0].pat_address);
        $('#edob').val(pat.data[0].pat_dob);
        $('#egender').val(pat.data[0].pat_gender);
        $('#emed_history').val(pat.data[0].pat_med_history);
        $('#esurg_history').val(pat.data[0].pat_surg_history);
        $('#emed_current').val(pat.data[0].pat_med_current);
        $('#eoccupation').val(pat.data[0].pat_occupation);

        $('#pat_form').slideDown();

      },
      error: function() {
        toastr.error('Error loading patient!');
      }
    });

  });
});

/*Save edited Patient details*/
$(document).ready(function(){
  $('#edit_save').on('click', function (){
    $('#pat_form').slideUp();
    

    var patient = {
      "pat_name": $('#ename').val(),
      "pat_surname": $('#esurname').val(),
      "pat_email": $('#eemail').val(),
      "pat_pwd": $('#epwd').val(),
      "pat_phone": $('#ephone').val(),
      "pat_address": $('#eaddress').val(),
      "pat_dob": $('#edob').val(),
      "pat_gender": $('#egender').val(),
      "pat_med_history": $('#emed_history').val(),
      "pat_surg_history": $('#esurg_history').val(),
      "pat_med_current": $('#emed_current').val(),
      "pat_occupation": $('#eoccupation').val(),
       "jwt" : getCookie('jwt')

    };

    patient = JSON.stringify(patient);
    $.ajax({
      type: 'PUT',
      url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/update.php',
      data: patient,
      success: function (pat) {
        
        toastr.success("Done")

        

      },
      error: function() {
        toastr.error("Ooops! Something went wrong!")
      }
    });

    $('#mypat').show();

  });
});