
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Samuel Leon</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo base_url('assets/img/favicon.png'); ?>" rel="icon">
  <link href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url('assets/lib/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url('assets/lib/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/lib/animate/animate.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/lib/ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/lib/magnific-popup/magnific-popup.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/lib/ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/css/table.css'); ?>" rel="stylesheet">

   <script src="<?php echo base_url('assets/lib/jquery/jquery.min.js'); ?>"></script>


  <!-- DataTables  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js" type="text/javascript"></script>
  <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>

  <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

  <!-- Alerts -->
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <style>
    .nav-menu > li > button#sign_up {background: #ffffff;color: #000000; border: 2px solid #50d8af;}
    .nav-menu > li > button#logout {background: #ffffff;color: #000000; border: 2px solid #50d8af;padding: 5px 15px;}
    .nav-menu > li > button#login {padding: 1px 10px;background: #50d8af;color: #000000;}

    /* Preloader */
    #preloader {
      position: fixed;
      top:0;
      left:0;
      right:0;
      bottom:0;
      background-color:#fff; /* change if the mask should have another color then white */
      z-index:99; /* makes sure it stays on top */
    }
    #status {
      width:200px;
      height:200px;
      position:absolute;
      left:50%; /* centers the loading animation horizontally one the screen */
      top:50%; /* centers the loading animation vertically one the screen */
      background-image:url("<?php echo base_url('assets/img/preloader.gif'); ?>"); /* path to your loading animation */
      background-repeat:no-repeat;
      background-position:center;
      margin:-100px 0 0 -100px; /* is width and height divided by two */
    }

    #commentForm {
      width: 500px;
    }
    #commentForm label {
      width: 250px;
    }
    #commentForm label.error, #commentForm input.submit {
      margin-left: 253px;
    }
    #signupForm {
      width: 670px;
    }
    #signupForm label.error {
      margin-left: 10px;
      width: auto;
      display: inline;
    }
    #newsletter_topics label.error {
      display: none;
      margin-left: 103px;
    }
  </style>

</head>

<body id="body">
  <!--preloader-->
       <div id="preloader">
        <div id="status">&nbsp;</div>
      </div>  

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:info@slfamilyclinic.com">info@slfamilyclinic.com</a>
        <i class="fa fa-phone"></i> +263 785 663 459
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="<?php echo base_url(); ?>" class="scrollto">Samuel<span> Leon</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo base_url(); ?>"><span class="fi-arrow-left"></span>Home</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><button id="sign_up" class="btn btn-sm">
            <a href="<?php echo base_url('register'); ?>">Sign Up</a>
          </button></li>
          <li><button id="login" class="btn btn-sm" >
            <a href="<?php echo base_url('login'); ?>">Login</a>
          </button></li>
          <li><button id="logout" style="display: none;" class="btn btn btn-sm" type="submit">
          Logout</button></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->
  