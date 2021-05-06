 <?php $this->load->view('common/header'); ?>

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
                             <h1 class="h4 text-white">Technician Data Entry Module</h1>
                         </div>

                         <div class="card-body bg-custom3">
                             <form class="user" role="form" method="post" id="add_form" action="<?= base_url(); ?>Technician/add_data_into_db">
                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                             <option class="form-control form-control-user" value="">Select Controller</option>
                                             <option class="form-control form-control-user" value="Sensor">Sensor</option>
                                             <option class="form-control form-control-user" value="Fire Controller">Fire Controller</option>
                                             <option class="form-control form-control-user" value="Weapon">Weapon</option>
                                         </select>
                                     </div>

                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" id="eswb" name="eswb" placeholder="ESWB*">
                                     </div>

                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" id="controller_name" name="name" placeholder="Name*">
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="included" placeholder="Included">
                                     </div>

                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="notIncluded" id="notIncluded" placeholder="Not Included">
                                     </div>

                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="AssociatedEquipment" id="AssociatedEquipment" placeholder="Associated Equipment">
                                     </div>
                                 </div>

                                 <div class="form-group row justify-content-center">
                                     <div class="col-sm-4">
                                         <button type="button" class="btn btn-primary btn-user btn-block" id="add_btn">
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

         <div class="card-body bg-custom3">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4 text-white">Entered Data</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($technician_controller_data) > 0) { ?>
                                     <table id="datatable" class="table table-striped">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Controller Type</th>
                                                 <th scope="col">ESWB</th>
                                                 <th scope="col">Name</th>
                                                 <th scope="col">Included</th>
                                                 <th scope="col">Not Included</th>
                                                 <th scope="col">Associated Equipment</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php $count = 0;
                                                foreach ($technician_controller_data as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?php $count++;
                                                                        echo $count; ?></td>
                                                     <td scope="row"><?= $data['Controller_type']; ?></td>
                                                     <td scope="row"><?= $data['ESWB']; ?></td>
                                                     <td scope="row"><?= $data['Controller_Name']; ?></td>
                                                     <td scope="row"><?= $data['Includes']; ?></td>
                                                     <td scope="row"><?= $data['Not_Includes']; ?></td>
                                                     <td scope="row"><?= $data['Associated_Equipment']; ?></td>
                                                 </tr>
                                             <?php } ?>
                                         </tbody>
                                     </table>
                                 <?php } else { ?>
                                     <a> No Data Available yet </a>
                                 <?php } ?>
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
     $('#add_btn').on('click', function() {
         //alert('javascript working');
         $('#add_btn').attr('disabled', true);
         var validate = 0;

         var controller_type = $('#controller_type').val();
         var eswb = $('#eswb').val();
         var name = $('#controller_name').val();

         if (eswb == '') {
             validate = 1;
             $('#eswb').addClass('red-border');
         }
         if (name == '') {
             validate = 1;
             $('#controller_name').addClass('red-border');
         }
         if (controller_type == '') {
             validate = 1;
             $('#controller_type').addClass('red-border');
         }


         if (validate == 0) {
             $('#add_form')[0].submit();
         } else {
             $('#add_btn').removeAttr('disabled');
         }
     });
 </script>