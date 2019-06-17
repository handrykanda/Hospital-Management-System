<!--==========================
    Footer
  ============================-->
  <div style="padding-top: 20px;"></div>
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Samuel Leon</strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="">Samuel Leon Tech Team</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- preloader -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>
 <script src="<?php echo base_url('assets/lib/jquery/jquery.validate.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery/jquery-migrate.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/easing/easing.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/superfish/hoverIntent.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/superfish/superfish.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/wow/wow.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/magnific-popup/magnific-popup.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/lib/sticky/sticky.js'); ?>"></script>



  <!-- Template Main Javascript File -->
 <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

  <!-- custom Javascript File -->
  <script src="<?php echo base_url('assets/js/doctor.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/nurse.js'); ?>"></script>  
  <script src="<?php echo base_url('assets/js/patient.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/reception.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/login.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/print.js'); ?>"></script>
  

  <!-- Alerts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>


  <!-- DataTables  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js" type="text/javascript"></script>
  <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>

  <script type="text/javascript">
    
    $(document).ready( function () {
        $('#pat_table').DataTable();
    } );
  </script>

  <script type="text/javascript">
    $('#edit_dia').hide();
    $('#edit_con').hide();
      function back () {
          $patient.hide();
          $npatient.hide();
          $rpatient.hide();
          $('#con_form').hide();
          $('#dia_form').hide();
          $('#pat_header').hide();
          $('#npat_header').hide();
          $('#rpat_header').hide();
          $('#reg_form').hide();
          $('#pats_header').show();
          $('#npats_header').show();
          $('#rpats_header').show();
          $('#add_pat').show();
          $patients.slideDown();
          $npatients.slideDown();
          $rpatients.slideDown();
      }
  </script>

</body>
</html>
