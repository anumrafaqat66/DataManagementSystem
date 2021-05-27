<?php $this->load->view('Admin/common/header'); ?>
 <style>
     .red-border {
         border: 1px solid red !important;
     }
 </style>

 <div class="container">

     <div class="card o-hidden border-0 shadow-lg">
         <div class="card-body bg-custom3">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <div class="card-header bg-custom1">
                             <h1 class="h4 text-white">Create New User</h1>
                         </div>

                         <div class="card-body bg-custom3">
                             <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Admin/add_user">
                                 <div class="form-group row">
                                     
  									<div class="col-sm-6 mb-1">
                                         <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="username*">
                                     </div>
                                     <div class="col-sm-6 mb-1">
                                         <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="password*">
                                     </div>

                                    
                                 </div>

                                 <div class="form-group row">
                                   <div class="col-sm-12 mb-1">
                                         <select class="form-control rounded-pill" name="status" id="status" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                             <option class="form-control form-control-user" value="">Select Status</option>
                                             <option class="form-control form-control-user" value="co">CO</option>
                                             <option class="form-control form-control-user" value="hod">HOD</option>
                                             <option class="form-control form-control-user" value="manager">Manager</option>
                                             <option class="form-control form-control-user" value="cdr">CDR</option>
                                              <option class="form-control form-control-user" value="weo">WEO</option>
                                               <option class="form-control form-control-user" value="technician">Technician</option>
                                         </select>
                                     </div>

                                   
                                 </div>

                                 <div class="form-group row justify-content-center">
                                     <div class="col-sm-4">
                                         <button type="button" class="btn btn-primary btn-user btn-block" id="add_btni">
                                             <!-- <i class="fab fa-google fa-fw"></i>  -->
                                             Submit Data
                                         </button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>


                 </div>
             </div>
         </div>
     </div>
 </div>

 </div>
<?php $this->load->view('common/footer'); ?>
 <script>
     $('#add_btni').on('click', function() {
         //alert('javascript working');
         $('#add_btn').attr('disabled', true);
         var validate = 0;

         var username = $('#username').val();
         var password = $('#password').val();
         var status = $('#status').val();

         if (username == '') {
             validate = 1;
             $('#username').addClass('red-border');
         }
         if (password == '') {
             validate = 1;
             $('#password').addClass('red-border');
         }
         if (status == '') {
             validate = 1;
             $('#status').addClass('red-border');
         }


         if (validate == 0) {
             $('#add_form')[0].submit();
         } else {
             $('#add_btni').removeAttr('disabled');
         }
     });
 </script>
