<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<style>
    * {box-sizing: border-box;}
body {font-family: Verdana, sans-serif;}
.mySlides {display: none;
}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
 
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
  .red-border {
    border: 1px solid red !important;
  }
  .box{
    height:480px;
    width: 100%;
  }
  .head{
    background: url(<?=base_url();?>assets/img/navycheif.jpg);
    background-position: center;
    background-size: cover;
  }
</style>


<body class="row" style="overflow: hidden;">

   <!--  <div class="container" style="width: 100%"  > -->
      <div class="row col-md-12 box" >
        <div class="col-md-6 head" style="float:left;">
        </div>

        <div class="col-md-6" style="float:right; " >
           <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Data Management System</h1>
                                    </div>
                                    <form class="user" role="form" id="login_form" method="post" action="<?php echo base_url();?>User_Login/login_process">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="username"  placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password"  name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group row">

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="hod" name="optradio"> <div style="float:right; margin-left:5px;">H.O.D</div> 
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="manager" name="optradio"><div style="float:right; margin-left:5px;">Manager</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="technician" name="optradio"><div style="float:right; margin-left:5px;">Technician</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="typecdr" name="optradio"><div style="float:right; margin-left:5px;">CDR</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="weo" name="optradio"><div style="float:right; margin-left:5px;">Weo</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="co" name="optradio"><div style="float:right; margin-left:5px;">CO</div>
                                            </label>
                                         
                                        </div>
                                        <span style="color: red; display: none;font-size: 12px" id="Account_error">
                                            *Please select Account type
                                        </span> 

                                        <hr> 
                                        <button type="button"  class="btn btn-primary btn-user btn-block" id="login_btn">
                                            <!-- <i class="fab fa-google fa-fw"></i>  -->
                                            Login
                                        </button>

                                    </form>
                                   <hr>
                                   <br><br><br>
                                 
                              </div>
        </div>
      </div>
  </div>
</div>

      <div class="row col-md-12 box">
        <div class="col-md-6" style="float:left; background-color: #225196;padding: 20px;text-align: center;color: white">
            <h2 style="margin-top:20px;">A combat ready multi-dimensional force manned by highy motivated and professionally competent human resource imbued with unwavering faith in Allah SWT and the natinal cause; that contributes effectively to credible detterence,national security and maritime economy; safeguarding Pakistan's maritime interest while radiating influence in the region with global outlook.</h2>
        </div>

        <div  class="col-md-6 slideshow-container" style="float:right;background-color: #225196;" >
              <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <img src="<?= base_url(); ?>assets/img/AAW.jpg" style="width:100%;height: 380px">
      <div class="text">Caption Text</div>
    </div>

    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <img src="<?= base_url(); ?>assets/img/ship--.jpg" style="width:100%;height: 380px">
      <div class="text">Caption Two</div>
    </div>

    <div class="mySlides fade" >
      <div class="numbertext">3 / 3</div>
      <img src="<?= base_url(); ?>assets/img/ship3.jpg" style="width:100%;height: 380px">
      <div class="text">Caption Three</div>
    </div>
        </div>
        <br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

      </div>

       <!--  </div>
 -->
        <!-- Outer Row -->
       <!--  <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card bg-custom3 o-hidden border-0 shadow-lg my-5"> -->
                    <!-- <div class="card-body p-0" style=""> -->
                        <!-- Nested Row within Card Body -->
                       <!--  <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Data Management System</h1>
                                    </div>
                                    <form class="user" role="form" id="login_form" method="post" action="<?php echo base_url();?>User_Login/login_process">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="username"  placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password"  name="password" class="form-control form-control-user" id="password" placeholder="Password">
                                        </div>
                                        <div class="form-group row">

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="hod" name="optradio"> <div style="float:right; margin-left:5px;">H.O.D</div> 
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="manager" name="optradio"><div style="float:right; margin-left:5px;">Manager</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="technician" name="optradio"><div style="float:right; margin-left:5px;">Technician</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="typecdr" name="optradio"><div style="float:right; margin-left:5px;">CDR</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="weo" name="optradio"><div style="float:right; margin-left:5px;">Weo</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="co" name="optradio"><div style="float:right; margin-left:5px;">CO</div>
                                            </label>
                                         
                                        </div>
                                        <span style="color: red; display: none;font-size: 12px" id="Account_error">
                                            *Please select Account type
                                        </span> 

                                        <hr> -->
                                       <!--  <button type="button"  class="btn btn-primary btn-user btn-block" id="login_btn"> -->
                                            <!-- <i class="fab fa-google fa-fw"></i>  -->
                                        <!--     Login
                                        </button>

                                    </form>
                                   <hr>
                                   <br><br><br> -->
                                 
                         <!--        </div>
                            </div>
                        </div> -->

                        <!-- till here -->
                    <!-- </div> -->
<!-- DIv 2 -->


<!-- 
                </div>

            </div>

        </div>

    </div> -->

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <script>
        var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}

$('#login_btn').on('click', function() {
   // alert('javascript working');
    $('#login_btn').attr('disabled', true);
    var validate = 0;

    var user_type = document.getElementsByName("optradio");
               
    var username = $('#username').val();
    var password = $('#password').val();

    if (username == '') {
      validate = 1;
      $('#username').addClass('red-border');
    }
     if (password == '') {
      validate = 1;
      $('#password').addClass('red-border');
    }
     if (user_type[0].checked != true && user_type[1].checked != true && user_type[2].checked != true && user_type[3].checked != true && user_type[4].checked != true && user_type[5].checked != true ) {
                   validate=1;
                   $('#Account_error').show();
                } 

   if (validate == 0) {
      $('#login_form')[0].submit();
    } else {
      $('#login_btn').removeAttr('disabled');
    }
});

</script>

<script src="<?php echo base_url(); ?>assets/swal/swal.all.min.js"></script>
<?php if ($this->session->flashdata('success')) : ?>
    <script>
        Swal.fire(
            '<?php echo $this->session->flashdata('success'); ?>',
            '',
            'success'
        );
    </script> 
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if ($this->session->flashdata('failure')) : ?>
    <script>
        Swal.fire(
            '<?php echo $this->session->flashdata('failure'); ?>',
            'Invalid username or password',
            'error'
        );
    </script>
     <?php unset($_SESSION['failure']); ?>
<?php endif; ?>
</body>

</html>