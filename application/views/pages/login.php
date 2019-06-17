<div class="container"><br>

  <div id="login_form" class="row">
    <div class="col-md-3"></div>
    <div style="box-shadow: 10px 10px 5px #D8D8D8;" class="col-md-6">
      <div class="text-center">
        <h5 style="color: #50d8af;">Welcome Back!</h5>
      </div><br>
      <form action="" method="post" role="form" class="contactForm" id="loginForm">
        <fieldset>
        <div for="login_email" class="form-group col-md-12">
          <label for="login_email" class="label control-label">E-mail</label><span class="input-group-addon"><span class="glyphicon glyphicon-envelop"></span></span>
          <input type="email" class="form-control" name="email" id="login_email" placeholder="Your Email" />
          <span class="error">A valid email address is required</span>
        </div>

        <div class="form-group col-md-12">
          <label for="login_pwd" class="label control-label">Password</label><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
          <input type="Password" class="form-control" name="pwd" id="login_pwd" placeholder="Password"/>
          <span class="error">A correct password is required</span>
        </div>

        <div class="form-group col-md-12">
          <label class="label control-label">Login as ...</label>
          <select id="type" class="form-control text">
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
            <option value="nurse">Nurse</option>
            <option value="receptionist">Receptionist</option>
          </select>
        </div>

        <div class="text-center btn-projects scrollto">
          <button id="login_submit" type="button" class="btn btn-success btn-sm" value="submit">Login Now</button>
        </div><br>
        </fieldset>
      </form>
   </div>
   <div class="col-md-3"></div>
 </div>
</div>
<!-- <script type="text/javascript">
  $('#login_submit').on('click', function (e) {
    e.preventDefault();
  });
</script> -->
<script type="text/javascript">
  $(document).ready(function() {
    // Email must be an email
    $('#login_email').on('input', function() {
      var input=$(this);
      var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var is_email=re.test(input.val());
      if(is_email){input.removeClass("invalid").addClass("valid");}
      else{input.removeClass("valid").addClass("invalid");}
    });

    //password
    $('#login_pwd').on('input', function() {
      var input=$(this);
        var is_pwd=input.val();
        if(is_pwd){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });
  });
</script>



