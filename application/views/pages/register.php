<div class="container"><br>
  <div class="row">
    <div class="col-md-2"></div>
      <div style="box-shadow: 10px 10px 5px #D8D8D8;" class="form col-md-8">
        <div>
          <h5 style="color: #50d8af;">Your are just few seconds away to experience it</h5>
        </div>
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
            <button id="register" type="button" class="btn btn-success btn-sm">Register Now</button>
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

    

