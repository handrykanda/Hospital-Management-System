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

/*login credentials*/
var $email = $('#login_email');
var $pwd = $('#login_pwd');
var $type = $('#type');


/* Patient Registration*/
$('#register').on('click', function (event) {

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
							setTimeout(toLogin(), 1000);
						},
						error: function() {
							toastr.success('Patient Registered');
							setTimeout(toLogin(), 1000);
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


/* Patient Login*/
$('#login_submit').on('click', function (event) {
	event.preventDefault(); 
	/*login credentials*/
	var $email = $('#login_email');
	var $pwd = $('#login_pwd');
	var $type = $('#type');

	var form_data=$("#loginForm").serializeArray();
	var error_free=true;
	for (var input in form_data){
		var element=$("#login_"+form_data[input]['name']);
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
		toastr.error('Valid email and password are required!');

	}
	else{

	//remove jwt
	setCookie("jwt", "", 1);

	/*http request*/
	if ($type.val() == "patient"){

		var patient = {
			"pat_email": $email.val(),
			"pat_pwd": $pwd.val()
		};
		patient = JSON.stringify(patient);

		$.ajax({
			type: 'POST',
			url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/login.php',
			data: patient,
			success: function (result) {
				setCookie("jwt", result.jwt, 1);

				var pat_id = result.pat_id;

				//validate jwt to verify access
				var jwt = getCookie('jwt');
				var my_jwt = {"jwt": jwt};
				my_jwt = JSON.stringify(my_jwt);
				$.ajax({
					type: 'POST',
					url: 'http://localhost/clinica/api.samuel-leon.com/api/patient/validate_token.php',
					data: my_jwt,
					success: function () {
						
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectP(pat_id), 1000);
					},
					error: function(data) {
						console.log(data);

						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectP(pat_id), 1000);
					}
				});

				
			},
			error: function() {
				toastr.error('Login Failed!');
			}
		});

	}else if ($type.val() == "doctor") {

		var doctor = {
			"doc_email": $email.val(),
			"doc_pwd": $pwd.val()
		};
		doctor = JSON.stringify(doctor);

		$.ajax({
			type: 'POST',
			url: 'http://localhost/clinica/api.samuel-leon.com/api/doctor/login.php',
			data: doctor,
			success: function (result) {
				setCookie("jwt", result.jwt, 1);

				var doc_id = result.doc_id;
				//validate jwt to verify access
				var jwt = getCookie('jwt');
				var my_jwt = {"jwt": jwt};
				my_jwt = JSON.stringify(my_jwt);
				$.ajax({
					type: 'POST',
					url: 'http://localhost/clinica/api.samuel-leon.com/api/doctor/validate_token.php',
					data: my_jwt,
					success: function () {
						
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectD(doc_id), 1000);
					},
					error: function() {
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectD(doc_id), 1000);
					}
				});
			},
			error: function() {
				toastr.error('Login Failed!');
			}
		});

	}else if ($type.val() == "nurse") {

		var nurse = {
			"nurse_email": $email.val(),
			"nurse_pwd": $pwd.val()
		};
		nurse = JSON.stringify(nurse);

		$.ajax({
			type: 'POST',
			url: 'http://localhost/clinica/api.samuel-leon.com/api/nurse/login.php',
			data: nurse,
			success: function (result) {
				setCookie("jwt", result.jwt, 1);

				var nurse_id = result.nurse_id;

				//validate jwt to verify access
				var jwt = getCookie('jwt');
				var my_jwt = {"jwt": jwt};
				my_jwt = JSON.stringify(my_jwt);
				$.ajax({
					type: 'POST',
					url: 'http://localhost/clinica/api.samuel-leon.com/api/nurse/validate_token.php',
					data: my_jwt,
					success: function () {
						
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectN(nurse_id), 1000);
					},
					error: function() {
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectN(nurse_id), 1000);
					}
				});
			},
			error: function() {
				toastr.error('Login Failed!');
			}
		});

	}else{
		
		var receptionist = {
			"rep_email": $email.val(),
			"rep_pwd": $pwd.val()
		};
		receptionist = JSON.stringify(receptionist);

		$.ajax({
			type: 'POST',
			url: 'http://localhost/clinica/api.samuel-leon.com/api/receptionist/login.php',
			data: receptionist,
			success: function (result) {
				setCookie("jwt", result.jwt, 1);

				var rep_id = result.rep_id;

				//validate jwt to verify access
				var jwt = getCookie('jwt');
				var my_jwt = {"jwt": jwt};
				my_jwt = JSON.stringify(my_jwt);
				$.ajax({
					type: 'POST',
					url: 'http://localhost/clinica/api.samuel-leon.com/api/receptionist/validate_token.php',
					data: my_jwt,
					success: function () {
						
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectR(rep_id), 1000);
					},
					error: function() {
						// showLogged in menu
						showLoggedInMenu();
						toastr.success('Login Successfully');
						setTimeout(RedirectR(rep_id), 1000);
					}
				});
			},
			error: function() {
				toastr.error('Login Failed!');
			}
		});
	}

}
});



$('#logout').on('click', function (){


	$.ajax({
		type: 'GET',
		url: 'http://localhost/clinica/api.samuel-leon.com/api/doctor/logout.php',
		success: function () {
			killCookie();
			setTimeout(toLogin(), 1000);
		},
		error: function() {
		}
	});
});

function RedirectD(id) {
	window.location="http://localhost/clinica/doctor?doc_id="+id;
}
function RedirectP(id) {
	window.location="http://localhost/clinica/patient?pat_id="+id;
}
function RedirectN(id) {
	window.location="http://localhost/clinica/nurse?nurse_id="+id;
}
function RedirectR(id) {
	window.location="http://localhost/clinica/reception?rep_id="+id;
}

function toLogin() {
	window.location="http://localhost/clinica/login";
}

function killCookie() {
	//remove jwt
	setCookie("jwt", "", 1);
}

// to store jwt on the cookie
function setCookie(cname, cvalue, exdays) {
	
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function showLoggedOutMenu() {
	
}


// getCookie
function getCookie(cname) {
	
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');

	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while(c.charAt(0) == ' '){
			c = c.substring(1);
		}

		if (c.indexOf(name) == 0) {

			return c.substring(name.length, c.length);
		}
	}
	return " ";
}

//show logged in menu
function showLoggedInMenu() {
	
	$('#sign_up').hide();
	$('#login').hide();
	$('#logout').show();
}

//show login form
function showLoginForm() {
	$('#login_form').slideDown();
}



  // loader 
$(window).load(function() { // makes sure the whole site is loaded
$('#status').fadeOut(); // will first fade out the loading animation
$('#preloader').delay(500).fadeOut('slow'); // will fade out the white DIV that covers the website.
$('body').delay(500).css({'overflow':'visible'});
})

