<?php 
  session_start();
  if (!isset($_SESSION['pat_id']))
      header("Location: http://localhost/clinica/login");
 ?>

<div class="container"><br>
  <h3 class="text-center">Our Valuable Patient</h3>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="jumbotron col-md-8" id="mypat"></div>
    <div class="col-md-2">
    	<div class="col-md-2"><button style="" id="edit_pat" class="btn btn-success btn-sm">Edit</button></div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-2">
        <a href=""><i onclick="back();" id="backbtn" style="cursor: pointer; margin-left: 50%;padding: 10px; color: #50d8af; font-size: 30px;display: none;" class="fa fa-backward" aria-hidden="true"></i></a>
    </div>
    <div style="display: none;" class="jumbotron col-md-8" id="pat_form">
    	<form action="" method="post" role="form" class="contactForm" id="signupForm">
    	         <div class="form-row">
    	           <div class="form-group col-md-6">
    	             <label class="label control-label">Name</label><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
    	             <input type="text" name="name" class="form-control" id="ename" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
    	             <div class="validation"></div>
    	           </div>
    	              <div class="form-group col-md-6">
    	             <label class="label control-label">Surname</label><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
    	             <input type="text" name="Surname" class="form-control" id="esurname" placeholder="Surname" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
    	             <div class="validation"></div>
    	           </div>
    	           <div class="form-group col-md-6">
    	             <label class="label control-label">E-mail</label><span class="input-group-addon"><span class="glyphicon glyphicon-envelop"></span></span>
    	             <input type="email" class="form-control" name="email" id="eemail" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
    	             <div class="validation"></div>
    	           </div>
    	         </div>
    	         <div class="form-group">
    	           <label class="label control-label">Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
    	           <input type="Password" class="form-control" name="Password" id="epwd" placeholder="Password" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Password" />
    	           <div class="validation"></div>
    	         </div>
    	          <div class="form-group">
    	           <label class="label control-label">Confirm Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-keys"></span></span>
    	           <input type="Password" class="form-control" name="Confirm Password" id="epwd_confirm" placeholder="Confirm Password" data-rule="minlen:4" data-msg="Please enter at least 8 chars of Password" />
    	           <div class="validation"></div>
    	         </div>
    	            <div class="form-group">
    	           <label class="label control-label">Phone number</label><span class="input-group-addon"><span class="glyphicon glyphicon-iphone-shake"></span></span>
    	           <input type="text" class="form-control" name="Phone_number" id="ephone" placeholder="Phone number" data-rule="minlen:4" data-msg="Please enter at least 10 numbers" />
    	           <div class="validation"></div>
    	         </div>
    	         <div class="form-group">
    	           <label for="name">Address</label>
    	           <textarea class="form-control" id="eaddress"></textarea>
    	           <div class="validation"></div>
    	         </div>
    	          <div class="form-group">
    	           <label class="label control-label">Date of Birth</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
    	           <input disabled="true" type="date" class="form-control" name="dob" id="edob" placeholder="Date_of_Birth" data-rule="minlen:4" data-msg="Please enter your Date of Birth"/>
    	           <div class="validation"></div>
    	         </div>
    	           <div class="form-group">
    	           <label class="label control-label">Gender</label>
    	           <select disabled="true" id="egender" class="form-control text">
    	             <option value="Male">Male</option>
    	             <option value="Female">Female</option>
    	           </select>
    	         </div>
    	         <div class="form-group">
    	           <label for="name">medical Histroy</label>
    	           <textarea class="form-control" id="emed_history"></textarea>
    	           <div class="validation"></div>
    	         </div>
    	         <div class="form-group">
    	           <label for="name">Surgeory Histroy</label>
    	           <textarea class="form-control" id="esurg_history"></textarea>
    	           <div class="validation"></div>
    	         </div>
    	          <div class="form-group">
    	           <label for="name">Current Medication</label>
    	           <textarea class="form-control" id="emed_current"></textarea>
    	           <div class="validation"></div>
    	         </div>
    	          <div class="form-group">
    	             <label class="label control-label">Occupation</label><span class="input-group-addon"><span class="glyphicon glyphicon-cars"></span></span>
    	             <input type="text" name="Occupation" class="form-control" id="eoccupation" placeholder="Occupation" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
    	             <div class="validation"></div>
    	           </div>
    	        
    	         <div class="text-center btn-projects scrollto">
    	           <button id="edit_save" type="submit" class="btn btn-success btn-sm">Save</button>
    	         </div><br>
    	       </form>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>




 