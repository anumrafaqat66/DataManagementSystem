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

                                    <div class="form-group row">
                                    <div class="col-sm-4 mb-1">
                                         <input type="date" class="form-control form-control-user" id="comission_date" name="Comission_date" placeholder="comission date*">
                                     </div>
                                     <div class="col-sm-4 mb-1">
                                         <select class="form-control rounded-pill" name="Ship_ID" id="Ship_ID" data-placeholder="Select ship" style="font-size: 0.8rem; height:50px;">
                                            <option class="form-control form-control-user" value="">Select Controller</option>
                                        <?php foreach($ships_data as $ship) {?>
                                             <option class="form-control form-control-user" value="<?= $ship['ID'] ?>"><?= $ship['Ship_name'] ?></option>
                                         <?php } ?>
                                         </select>
                                     </div>
                                     <div class="col-sm-4 mb-1">
                                         <input type="number" class="form-control form-control-user" id="Total_Equipped" name="Total_Equipped" placeholder="total equipped*">
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
                                                 <th scope="col">Comission Date</th>
                                                 <th scope="col">Ship</th>
                                                 <th scope="col">Total Equipped</th>

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
                                                      <td scope="row"><?= $data['Comission_date']; ?></td>
                                                      <?php $ship_name = $this->db->where('ID',$data['Ship_ID'])->get('Ship_data')->row_array(); ?>
                                                       <td scope="row"><?= $ship_name['Ship_name'];?></td>
                                                        <td scope="row"><?= $data['Total_Equipped']; ?></td>
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
         var comission_date=$('#comission_date').val();
         var ship_id=$('#Ship_ID').val();
         var total_equipped=$('#Total_Equipped').val();

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
       if (comission_date == '') {
             validate = 1;
             $('#comission_date').addClass('red-border');
         }
         if (ship_id == '') {
             validate = 1;
             $('#Ship_ID').addClass('red-border');
         }
         if ( total_equipped == '') {
             validate = 1;
             $('#Total_Equipped').addClass('red-border');
         }

         if (validate == 0) {
             $('#add_form')[0].submit();
         } else {
             $('#add_btn').removeAttr('disabled');
         }
     });
 </script>