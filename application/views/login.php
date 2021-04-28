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

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Data Management System</h1>
                                    </div>
                                    <form class="user" role="form" method="post" action="<?php echo base_url();?>User_Login/login_process">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" id="exampleInputUsername"  placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password"  name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
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
                                                <input type="radio" value="toplevel" name="optradio"><div style="float:right; margin-left:5px;">Top Level</div>
                                            </label>

                                            <label class="custom-control radio-inline small">
                                                <input type="radio" value="other" name="optradio"><div style="float:right; margin-left:5px;">Other Account</div>
                                            </label>
                                            <!-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">
                                                    HOD &nbsp;</label>
                                            </div>
                                            
                                             <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">
                                                    Manager &nbsp;</label>
                                            </div>
                                              <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Technician&nbsp
                                                    </label>
                                            </div>
                                              <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">
                                                    Top level&nbsp</label>
                                            </div>
                                             <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">
                                                    Other Account</label>
                                            </div> -->
                                        </div>

                                        <hr>
                                        <button type="submit"  class="btn btn-primary btn-user btn-block">
                                            <!-- <i class="fab fa-google fa-fw"></i>  -->
                                            Login
                                        </button>

                                    </form>
                                   <hr>
                                   <!--   <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

<script src="<?php echo base_url(); ?>assets/swal/swal.all.min.js"></script>
<?php if ($this->session->flashdata('success')) : ?>
    <script>
        Swal.fire(
            '<?php echo $this->session->flashdata('success'); ?>',
            '',
            'success'
        );
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('failure')) : ?>
    <script>
        Swal.fire(
            '<?php echo $this->session->flashdata('failure'); ?>',
            '',
            'error'
        );
    </script>
<?php endif; ?>
</body>

</html>