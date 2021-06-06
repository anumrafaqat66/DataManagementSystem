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
  .red-border {
    border: 1px solid red !important;
  }

  html {
    height: 100%;
  }

  .img-cheif {
    background: url('<?= base_url() ?>assets/img/navycheif.jpg');
    background-position: center;
    /* background-size: cover; */
    background-repeat: no-repeat;
    max-width: 100%;
    max-height: 100%;
    background-color: rgb(0, 1, 84);
    /* display: block; */
    /* remove extra space below image */
  }
</style>


<body class="row" style="overflow: hidden;">

  <!-- <div class="container" style="width: 100%"> -->
  <div class="row col-md-12">
    <div class="col-md-6 img-cheif">
    </div>

    <div class="col-md-6" style="float:right; ">
      <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
        <div class="col-lg-6" style="padding:1px !important">
          <div class="p-5">
            <div class="text-center">
              <h1 style="width:320px;" class="h4 text-gray-900 mb-4"><strong>Welcome to Combat System</strong></h1>
            </div>
            <form class="user" role="form" id="login_form" method="post" action="<?php echo base_url(); ?>User_Login/login_process">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Enter Username...">
              </div>
              <div class="form-group">
                <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password">
              </div>
              <div class="form-group row col-md-12" style="padding:0px !important">

                <div class="col-md-4" style="padding:0px !important">
                  <label class="custom-control radio-inline small">
                    <input type="radio" value="hod" name="optradio">&nbsp;H.O.D</label>
                  <label class="custom-control radio-inline small">
                    <input type="radio" value="manager" name="optradio">&nbsp;Manager</label>
                </div>

                <div class="col-md-5" style="padding:0px !important">
                  <label class="custom-control radio-inline small">
                    <input type="radio" value="technician" name="optradio">&nbsp;Technician</label>
                  <label class="custom-control radio-inline small">
                    <input type="radio" value="typecdr" name="optradio">&nbsp;CDR</label>
                </div>

                <div class="col-md-3" style="padding:0px !important">
                  <label class="custom-control radio-inline small">
                    <input type="radio" value="weo" name="optradio">&nbsp;Weo</label>
                  <label class="custom-control radio-inline small">
                    <input type="radio" value="co" name="optradio">&nbsp;CO</label>
                </div>

                <span style="color: red; display: none;font-size: 12px" id="Account_error">
                  *Please select Account type
                </span>

                <button type="button" class="btn btn-primary btn-user btn-block" id="login_btn">
                  <!-- <i class="fab fa-google fa-fw"></i>  -->
                  Login
                </button>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row col-md-12" style="padding-right: 0px !important;">
    <div class="col-md-6" style="float:left; background-color: rgb(0, 1, 84);color: white; text-align: justify; text-justify: inter-word;">
    <h3 style="text-align:center; margin-top:40px; text-decoration: underline;"><strong> Pakistan Navy Vision</strong></h3>
      <h4 style="padding-left:30px;padding-right:30px;padding-bottom:30px;">A combat ready multi-dimensional force manned by highy motivated and professionally competent human resource
        imbued with unwavering faith in Allah SWT and the national cause; that contributes effectively to credible detterence,
        national security and maritime economy; safeguarding Pakistan's maritime interests while radiating influence in the
        region with global outlook.</h4>
    </div>

    <div class="col-md-6" style="padding: 0px !important; padding-right: 0px !important;">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="<?= base_url(); ?>assets/img/moving-1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url(); ?>assets/img/moving-2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url(); ?>assets/img/moving-3.jpg" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="<?= base_url(); ?>assets/img/moving-4.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <script>
    
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
      if (user_type[0].checked != true && user_type[1].checked != true && user_type[2].checked != true && user_type[3].checked != true && user_type[4].checked != true && user_type[5].checked != true) {
        validate = 1;
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