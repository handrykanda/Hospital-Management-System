<?php 
  session_start();
  if (!isset($_SESSION['doc_id']))
      header("Location: http://localhost/clinica/login");
 ?>

<div class="container"><br>
		<h3 class="text-center" id="pats_header">Our Valuable Patients</h3>
		<h3 style="display: none;padding-right: 50px;" class="text-center" id="pat_header">
			 Our Valuable Patient
		</h3>
  
  <div class="row">
    <div class="col-md-2"></div>
    <div style="box-shadow: 10px 10px 5px #D8D8D8;" class="col-md-8" id="patients"></div>
    <div class="col-md-2"></div>
  </div>

  <div class="row">
    <div class="col-md-2">
       <a href=""><i onclick="back();" id="backbtn" style="cursor: pointer; margin-left: 50%;padding: 10px; color: #50d8af; font-size: 30px;display: none;" class="fa fa-backward" aria-hidden="true"></i></a>
    </div>
    <div style="display: none;" class="jumbotron col-md-8" id="patient"></div>
    <div class="col-md-2">
        <div class="col-md-2"><button id="edit_con" class="btn btn-success btn-sm">Edit</button></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div style="display: none;" class="jumbotron col-md-8" id="con_form">
    		  <div>
    		    <h5 class="text-center">Consultation Details </h5>
    		  </div>
    		  <form action="" method="post" role="form">
    		   
    		   <div class="form-group">
    		    <label class="label control-label">Date</label><span class="input-group-addon"><span class="glyphicon glyphicon-calender"></span></span>
    		    <input type="date" class="form-control" name="con_date" id="con_date" placeholder="Date of Consultation" data-rule="minlen:4" data-msg="Please enter your Date of Date_of_diagnosis"/>
    		    <div class="validation"></div>
    		  </div>
    		  <div class="form-group">
    		    <label for="name">Presentation Complain</label>
    		    <textarea class="form-control" id="con_pc"></textarea>
    		    <div class="validation"></div>
    		  </div>
    		  <div class="form-group">
    		    <label for="name">History Presentation Complain</label>
    		    <textarea class="form-control" id="con_hpc"></textarea>
    		    <div class="validation"></div>
    		  </div>
    		  <div class="form-group">
    		    <label for="name">Drug History</label>
    		    <textarea class="form-control" id="con_drug_history"></textarea>
    		    <div class="validation"></div>
    		  </div>
    		  <div class="text-center btn-projects scrollto">
    		  	<button id="con_save" class="btn btn-success btn-sm" type="submit">Save Now</button>
                <button style="display: none;" id="con_save2" class="btn btn-success btn-sm" type="submit">Update</button>
    		  </div>
    		</form>
    </div>
    <div class="col-md-2"><button style="display: none;" class="btn btn-success btn-sm" id="print">PRINT</button></div>
  </div>
</div>
<script type="text/javascript">
    $("#print").on('click',function () {

        var divToPrint=document.getElementById('patient');

          var newWin=window.open('','Print-Window');

          newWin.document.open();

          newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

          newWin.document.close();

          setTimeout(function(){newWin.close();},10);
        
    } );
</script>t