<?php 
  session_start();
  if (!isset($_SESSION['rep_id']))
      header("Location: http://localhost/clinica/login");
 ?>

<div class="container"><br>
	<h3 class="text-center" id="rpats_header">Our Valuable Patients</h3>
	<button style="display: none;" id="rbackBtn">Back</button>
	<h3 style="display: none;padding-right: 50px;" class="text-center" id="rpat_header">
		Our Valuable Patient
	</h3>

	<div class="row">
		<div class="col-md-2"></div>
		<div style="box-shadow: 10px 10px 5px #D8D8D8;" class="col-md-8" id="rpatients"></div>
		<div class="col-md-2"><button style="" id="add_pat" class="btn btn-success btn-sm">Add More</button></div>
	</div>


	<div class="row">
		<div class="col-md-2">
			<a href=""><i onclick="back();" id="backbtn" style="cursor: pointer; margin-left: 50%;padding: 10px; color: #50d8af; font-size: 30px; display: none;" class="fa fa-backward" aria-hidden="true"></i></a>
		</div>
		<div style="display: none;" class="col-md-8" id="reg_form">
			<div>
				<h4 style="color: #50d8af;" class="text-center">You are doing a great job.</h4>
			</div>
			<!-- <form action="" method="post" role="form" class="contactForm">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="label control-label">Name</label><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="name" class="form-control" id="pat_name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
						<div class="validation"></div>
					</div>
					<div class="form-group col-md-6">
						<label class="label control-label">Surname</label><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" name="Surname" class="form-control" id="pat_surname" placeholder="Surname" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
						<div class="validation"></div>
					</div>
					<div class="form-group col-md-12">
						<label class="label control-label">E-mail</label><span class="input-group-addon"><span class="glyphicon glyphicon-envelop"></span></span>
						<input type="email" class="form-control" name="email" id="pat_email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
						<div class="validation"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="label control-label">Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input type="Password" class="form-control" name="Password" id="pat_pwd" placeholder="Password" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Password" />
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Confirm Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-keys"></span></span>
					<input type="Password" class="form-control" name="Confirm Password" id="pat_pwd_confirm" placeholder="Confirm Password" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Password" />
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Phone number</label><span class="input-group-addon"><span class="glyphicon glyphicon-iphone-shake"></span></span>
					<input type="text" class="form-control" name="Phone_number" id="pat_phone" placeholder="Phone number" data-rule="minlen:4" data-msg="Please enter at least 10 numbers" />
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Address</label>
					<textarea class="form-control" id="pat_address"></textarea>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Date of Birth</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
					<input type="date" class="form-control" name="dob" id="pat_dob" placeholder="Date_of_Birth" data-rule="minlen:4" data-msg="Please enter your Date of Birth"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Gender</label>
					<select id="pat_gender" class="form-control text">
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<div class="form-group">
					<label for="name">medical History</label>
					<textarea class="form-control" id="pat_med_history"></textarea>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Surgery History</label>
					<textarea class="form-control" id="pat_surg_history"></textarea>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Current Medication</label>
					<textarea class="form-control" id="pat_med_current"></textarea>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Occupation</label><span class="input-group-addon"><span class="glyphicon glyphicon-cars"></span></span>
					<input type="text" name="Occupation" class="form-control" id="pat_occupation" placeholder="Occupation" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
					<div class="validation"></div>
				</div>

				<div class="text-center btn-projects scrollto">
					<button class="btn btn-success btn-sm" id="rregister" type="submit">Register Now</button>
				</div>
			</form> -->

			<form action="" method="post" role="form" class="contactForm" id="signupForm">
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="name" class="label control-label">Name</label><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
			      <input type="text" name="name" class="form-control" id="pat_name" placeholder="Your Name"/>
			      <span class="error">This field is required</span>
			    </div>
			       <div class="form-group col-md-6">
			      <label for="surname" class="label control-label">Surname</label><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
			      <input type="text" name="surname" class="form-control" id="pat_surname" placeholder="Surname"/>
			      <span class="error">This field is required</span>
			    </div>
			    <div class="form-group col-md-12">
			      <label for="pat_email" class="label control-label">E-mail</label><span class="input-group-addon"><span class="glyphicon glyphicon-envelop"></span></span>
			      <input type="email" class="form-control" name="email" id="pat_email" placeholder="Your Email" />
			      <span class="error">A valid email address is required</span>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="pat_pwd" class="label control-label">Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
			    <input type="Password" class="form-control" name="pwd" id="pat_pwd" placeholder="Password"/>
			    <span class="error">This field is required</span>
			  </div>
			   <div class="form-group">
			    <label for="pat_pwd_confirm" class="label control-label">Confirm Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-keys"></span></span>
			    <input type="Password" class="form-control" name="pwd_confirm" id="pat_pwd_confirm" placeholder="Confirm Password"/>
			    <span class="error">This field is required and must match the above password</span>
			  </div>
			     <div class="form-group">
			    <label for="pat_phone" class="label control-label">Phone number</label><span class="input-group-addon"><span class="glyphicon glyphicon-iphone-shake"></span></span>
			    <input type="text" class="form-control" name="phone" id="pat_phone" placeholder="Phone number" />
			    <span class="error">Valid Zim number is required</span>
			  </div>
			  <div class="form-group">
			    <label for="pat_address">Address</label>
			    <textarea name="address" class="form-control" id="pat_address"></textarea>
			    <span class="error">This field is required</span>
			  </div>
			   <div class="form-group">
			    <label for="pat_dob" class="label control-label">Date of Birth</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
			    <input type="date" class="form-control" name="dob" id="pat_dob" placeholder="Date of Birth"/>
			    <span class="error">This field is required</span>
			  </div>
			    <div class="form-group">
			    <label for="pat_gender" class="label control-label">Gender</label>
			    <select id="pat_gender" class="form-control text">
			      <option name="male" value="Male">Male</option>
			      <option name="female" value="Female">Female</option>
			    </select>
			    <span class="error">This field is required</span>
			  </div>
			  <div class="form-group">
			    <label for="pat_med_history">medical Histroy</label>
			    <textarea name="med_history" class="form-control" id="pat_med_history"></textarea>
			    <span class="error">This field is required</span>
			  </div>
			  <div class="form-group">
			    <label for="pat_surg_history">Surgeory Histroy</label>
			    <textarea name="surg_history" class="form-control" id="pat_surg_history"></textarea>
			    <span class="error">This field is required</span>
			  </div>
			   <div class="form-group">
			    <label for="pat_med_current">Current Medication</label>
			    <textarea name="med_current" class="form-control" id="pat_med_current"></textarea>
			    <span class="error">This field is required</span>
			  </div>
			   <div class="form-group">
			      <label for="pat_occupation" class="label control-label">Occupation</label><span class="input-group-addon"><span class="glyphicon glyphicon-cars"></span></span>
			      <input type="text" name="occupation" class="form-control" id="pat_occupation" placeholder="Occupation"/>
			      <span class="error">This field is required</span>
			    </div>
			 
			  <div class="text-center btn-projects scrollto">
			    <button id="rregister" type="submit" class="btn btn-success btn-sm">Register Now</button>
			  </div><br>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
	

</div>

<script type="text/javascript">
  $(document).ready(function() {
    // name
    $('#pat_name').on('input', function() {
      var input=$(this);
        var is_name=input.val();
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // surname
    $('#pat_surname').on('input', function() {
      var input=$(this);
        var is_surname=input.val();
        if(is_surname){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // Email must be an email
    $('#pat_email').on('input', function() {
      var input=$(this);
      var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var is_email=re.test(input.val());
      if(is_email){input.removeClass("invalid").addClass("valid");}
      else{input.removeClass("valid").addClass("invalid");}
    });

    //password
    $('#pat_pwd').on('input', function() {
      var input=$(this);
        var is_pwd=input.val();
        if(is_pwd){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // confirm password
    $('#pat_pwd_confirm').on('input', function() {
      var input1=$('input#pat_pwd').val();
      var input2=$(this);
      var is_confirm=$(this).val();
        if(input1==is_confirm){input2.removeClass("invalid").addClass("valid");}
        else{input2.removeClass("valid").addClass("invalid");}
      });

    // phone number
    $('#pat_phone').on('input', function() {
      var input=$(this);
      var re = /^((\+?[263])|(00263)|(0)|(263))*?[7]{1}((7)|(3)|(1))\d{7}$/;
      var is_phone=re.test(input.val());
      if(is_phone){input.removeClass("invalid").addClass("valid");}
      else{input.removeClass("valid").addClass("invalid");}
    });

    // address
    $('#pat_address').on('input', function() {
      var input=$(this);
        var is_address=input.val();
        if(is_address){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // DOB
    $('#pat_dob').on('input', function() {
      var input=$(this);
        var is_dob=input.val();
        if(is_dob){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // gender
    $('#pat_gender').on('input', function() {
      var input=$(this);
        var is_gender=input.val();
        if(is_gender){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // pat_med_history
    $('#pat_med_history').on('input', function() {
      var input=$(this);
        var is_med_history=input.val();
        if(is_med_history){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // pat_surg_history
    $('#pat_surg_history').on('input', function() {
      var input=$(this);
        var is_surg_history=input.val();
        if(is_surg_history){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // pat_med_current
    $('#pat_med_current').on('input', function() {
      var input=$(this);
        var is_med_current=input.val();
        if(is_med_current){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

    // pat_occupation
    $('#pat_occupation').on('input', function() {
      var input=$(this);
        var is_occupation=input.val();
        if(is_occupation){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });


  });

</script>