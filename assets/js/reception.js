
$.urlParam = function(rep_id){
	var results = new RegExp('[\?&]' + rep_id + '=([^&#]*)').exec(window.location.href);
	if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
}

var page = /reception/;
var url =window.location.href;  
if(page.test(url)){
	$('#sign_up').hide();
	$('#login').hide();
	$('#logout').show();

	var $rep_id = decodeURIComponent($.urlParam('rep_id')); 

} 

/*Patient Demographic Details*/
var $pat_name = $('#pat_name');
var $pat_surname = $('#pat_surname');
var $pat_email = $('#pat_email');
var $pat_pwd = $('#pat_pwd');
var $pat_phone = $('#pat_phone');
var $pat_address = $('#pat_address');
var $pat_dob = $('#pat_dob');
var $pat_gender = $('#pat_gender');
var $pat_med_history = $('#pat_med_history');
var $pat_surg_history = $('#pat_surg_history');
var $pat_med_current = $('#pat_med_current');
var $pat_occupation = $('#pat_occupation');


var $rpatients = $('#rpatients');
var $rpatient = $('#rpatient');
var $add_pat = $('#add_pat');
var $rpats_header = $('#rpats_header');
var $reg_form = $('#reg_form');
var $rpatients_table = '<table id="pat_table" class="display table table-stripped" style="width:100%">'+
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
	success: function (rpatients) {
		$.each(rpatients.data, function (index, rpatient) {
					$rpatients_table += '<tr style="cursor: pointer;color: #0c2e8a;" class="rsingle_patient" id="'+rpatient.pat_id+'">';
			        $rpatients_table += '<td>'+rpatient.pat_name
			        +'</td><td>'+rpatient.pat_surname
			        +'</td><td>'+rpatient.pat_email
			        +'</td>';
			        $rpatients_table += '</tr>';
								
		});
		$rpatients_table += '</tbody>';
		$rpatients_table += '</table>';
		$rpatients.append($rpatients_table);

	},
	error: function() {
		toastr.error('Error loading patients!');
	}
});

/*Add Patient*/
$('#add_pat').on('click', function (){
	$rpatients.slideUp();
	$add_pat.hide();
	$rpats_header.hide();
	$reg_form.slideDown();
	$('#backbtn').show();

});

/* Patient Registration*/
$('#rregister').on('click', function (event) {

	var form_data=$("#signupForm").serializeArray();
	var error_free=true;
	for (var input in form_data){
		var element=$("#pat_"+form_data[input]['name']);
		var valid=element.hasClass("valid");
		var error_element=$("span", element.parent());
		if (!valid){
			error_element.removeClass("error").addClass("error_show"); 
			error_free=false;
		}
		else{
			error_element.removeClass("error_show").addClass("error");
		}
	}
	if (!error_free){
		event.preventDefault(); 

	}
	else{

		$.ajax({
			type: 'GET',
			url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/checkemail.php?pat_email='+$pat_email.val(),
			success: function (res) {
				
				if (res.data[0].response == $pat_email.val()) {
					toastr.error('The email already exists!');
				} else {
					var patient = {
						"pat_name": $pat_name.val(),
						"pat_surname": $pat_surname.val(),
						"pat_email": $pat_email.val(),
						"pat_pwd": $pat_pwd.val(),
						"pat_phone": $pat_phone.val(),
						"pat_address": $pat_address.val(),
						"pat_dob": $pat_dob.val(),
						"pat_gender": $pat_gender.val(),
						"pat_med_history": $pat_med_history.val(),
						"pat_surg_history": $pat_surg_history.val(),
						"pat_med_current": $pat_med_current.val(),
						"pat_occupation": $pat_occupation.val()
					};
					patient = JSON.stringify(patient);
					$.ajax({
						type: 'POST',
						url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/create.php',
						data: patient,
						success: function () {
							toastr.success('Patient Registered');
						},
						error: function() {
							toastr.success('Patient Registered');
						}
					});
				}
			},
			error: function() {
				toastr.error('Error loading data!');
			}
		});
	}

	

});