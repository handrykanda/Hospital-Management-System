<?php 
  session_start();
  if (!isset($_SESSION['nurse_id']))
      header("Location: http://localhost/clinica/login");
 ?>

<div class="container"><br>
	<h3 class="text-center" id="npats_header">Our Valuable Patients</h3>
	<h3 style="display: none;" class="text-center" id="npat_header">
		Our Valuable Patient
	</h3>

	<div class="row">
		<div class="col-md-2"></div>
		<div style="box-shadow: 10px 10px 5px #D8D8D8;" class="col-md-8" id="npatients"></div>
		<div class="col-md-2"></div>
	</div>

	<div class="row">
		<div class="col-md-2">
			<a href=""><i onclick="back();" id="backbtn" style="display: none ;cursor: pointer; margin-left: 50%;padding: 10px; color: #50d8af; font-size: 30px;" class="fa fa-backward" aria-hidden="true"></i></a>
		</div>
		<div style="display: none;" class="jumbotron col-md-8" id="npatient"></div>
		<div class="col-md-2">
			<div class="col-md-2"><button style="" id="edit_dia" class="btn btn-success btn-sm">Edit</button></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div style="display: none;" class="jumbotron col-md-8" id="dia_form">
			<h5 class="text-center">Diagonosis Details</h5>
			<form action="" method="post" role="form">

				<div class="form-group">
					<label class="label control-label">Date</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
					<input type="date" class="form-control" name="dob" id="dia_date" placeholder="Date_of_diagnosis" data-rule="minlen:4" data-msg="Please enter the Date"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Weight</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
					<input type="text" class="form-control" name="weight" id="dia_weight" placeholder="weight" data-rule="minlen:4" data-msg="Please enter weight"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Blood Pressure</label>
					<input type="text" class="form-control" name="dia_bp" id="dia_bp" placeholder="Blood Pressure" data-rule="minlen:4" data-msg="Please enter blood pressure"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label class="label control-label">Temperature</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
					<input type="text" class="form-control" name="temperature" id="dia_temp" placeholder="temperature" data-rule="minlen:4" data-msg="Please enter temperature"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Blood Type</label>
					<input type="text" class="form-control" name="dia_blood_type" id="dia_blood_type" placeholder="Blood Type" data-rule="minlen:4" data-msg="Please enter blood type"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Blood Count</label>
					<input type="text" class="form-control" name="dia_blood_count" id="dia_blood_count" placeholder="Blood Count" data-rule="minlen:4" data-msg="Please enter blood count"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Glucose Tolerance</label>
					<input type="text" class="form-control" name="dia_glucose_tolerance" id="dia_glucose_tolerance" placeholder="Blood Tolerance" data-rule="minlen:4" data-msg="Please enter glucose tolerance"/>
					<div class="validation"></div>
				</div>
				<div class="form-group">
					<label for="name">Blood Purse</label>
					<input type="text" class="form-control" name="dia_pulse" id="dia_pulse" placeholder="Blood Purse" data-rule="minlen:4" data-msg="Please enter blood purse"/>
					<div class="validation"></div>
				</div>

				  <div class="form-group">
				  <label class="label control-label">Reg Flag</label>
				  <select id="dia_red_flag" class="form-control text">
				    <option value="0">No</option>
				    <option value="1">Yes</option>
				  </select>
				</div>

				<div class="text-center btn-projects scrollto">
					<button id="dia_save" class="btn btn-success btn-sm" type="submit">Save Now</button>
					<button style="display: none;" id="dia_save2" class="btn btn-success btn-sm" type="submit">Update</button>
				</div>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>

</div>