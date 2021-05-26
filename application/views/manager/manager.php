 <?php $this->load->view('manager/common/header'); ?>

 <style>
     ::-webkit-input-placeholder {
         color: Grey !important;
     }

     ::-moz-placeholder {
         color: Grey !important;
     }

     ::-ms-placeholder {
         color: Grey !important;
     }

     ::placeholder {
         color: Grey !important;
     }

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

                     <div class="card bg-custom3">
                         <div class="card-header bg-custom1">
                             <h1 class="h4 text-white">Manager Records</h1>
                         </div>
                         <div class="card-body bg-custom3">
                             <div id="table_div">
                                 <?php if (count($manager_controller_data) > 0) { ?>
                                     <table id="datatable" class="table table-sm table-striped">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col" width="15%">Controller Type</th>
                                                 <th scope="col">ESWB</th>
                                                 <th scope="col">Name</th>
                                                 <!-- <th scope="col">Included</th>
                                                 <th scope="col">Not Included</th>
                                                 <th scope="col">Associated Equipment</th> -->
                                                 <th scope="col">MTBF</th>
                                                 <!-- <th scope="col">TCM</th>
                                                 <th scope="col">TPM</th>
                                                 <th scope="col">ADLT</th> -->
                                                 <th scope="col">MTTR</th>
                                                 <th scope="col">Comission Date</th>
                                                 <th scope="col">Ship</th>
                                                 <th scope="col" width="15%">Action</th>
                                                 <!-- <th scope="col" width="15%">Action</th> -->
                                                 <th scope="col" width="15%">Action</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php $count = 0;
                                                foreach ($manager_controller_data as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?= $data['ID']; ?></td>
                                                     <td scope="row"><?= $data['Controller_type']; ?></td>
                                                     <td scope="row"><?= $data['ESWB']; ?></td>
                                                     <td scope="row"><?= $data['Controller_Name']; ?></td>
                                                     <!-- <td scope="row"><?= $data['Includes']; ?></td>
                                                     <td scope="row"><?= $data['Not_Includes']; ?></td>
                                                     <td scope="row"><?= $data['Associated_Equipment']; ?></td> -->
                                                     <td scope="row"><?= $data['MTBF']; ?></td>
                                                     <!-- <td scope="row"><?= $data['TCM']; ?></td>
                                                     <td scope="row"><?= $data['TPM']; ?></td>
                                                     <td scope="row"><?= $data['ADLT']; ?></td> -->
                                                     <td scope="row"><?= $data['MTTR']; ?></td>
                                                     <td scope="row"><?= $data['Comission_date']; ?></td>
                                                     <td scope="row"><?= $data['Ship_name']; ?></td>
                                                     <td>
                                                         <a class="btn btn-danger btn btn-sm rounded-pill text-sm" href="<?= base_url(); ?>manager/add_details/<?= $data['ID']; ?>">Add Fail Report</a>
                                                     </td>
                                                     <!-- <td>
                                                         <a class="btn btn-primary btn btn-sm rounded-pill text-sm" href="<?= base_url(); ?>manager/get_values/<?= $data['ID']; ?>">Add Details </a>
                                                     </td> -->
                                                     <td>
                                                         <a class="btn btn-success btn btn-sm rounded-pill text-sm" href="<?= base_url(); ?>manager/show_records/<?= $data['ID']; ?>">Show Records</a>
                                                     </td>

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


         <!--   <div id="record_detail_div" class="card-body"> -->
         <!-- Nested Row within Card Body -->
         <!--  <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <div class="card-header">
                             <div class="row">
                                 <div class="col-sm-11">
                                     <h1 class="h4 text-gray-900">Record Detail</h1>
                                 </div>
                                 <div class="col-sm-1">
                                     <a class="form-control form-control-user bg-light text-center" style="border:grey solid 1px" onclick="hide_detail_div()">
                                         <i class="fas fa-angle-up"></i>
                                     </a>

                                 </div>
                             </div>
                         </div> -->
         <!--
Data records table place
-->

     </div>

 </div>

 </div>

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

 <?php $this->load->view('common/footer'); ?>

 <script>
     $('#TCM').on('focusout', function() {

         var TPM = $('#TPM').val();
         if (TPM === undefined || TPM === null || TPM === '') {
             TPM = 0.00;
         }
         var TCM = $('#TCM').val();
         if (TCM === undefined || TCM === null || TCM === '') {
             TCM = 0.00;
         }
         var ALDT = $('#ADLT').val();
         if (ALDT === undefined || ALDT === null || ALDT === '') {
             ALDT = 0.00;
         }
         var TTR = parseFloat(TPM) + parseFloat(TCM) + parseFloat(ALDT);
         //alert(TTR);
         document.getElementById("TTR").value = TTR;
         //alert(d_o_b);
     });

     $('#TPM').on('focusout', function() {

         var TPM = $('#TPM').val();
         if (TPM === undefined || TPM === null || TPM === '') {
             TPM = 0.00;
         }
         var TCM = $('#TCM').val();
         if (TCM === undefined || TCM === null || TCM === '') {
             TCM = 0.00;
         }
         var ALDT = $('#ADLT').val();
         if (ALDT === undefined || ALDT === null || ALDT === '') {
             ALDT = 0.00;
         }
         var TTR = parseFloat(TPM) + parseFloat(TCM) + parseFloat(ALDT);
         //alert(TTR);
         document.getElementById("TTR").value = TTR;
         //alert(d_o_b);
     });

     $('#ADLT').on('focusout', function() {

         var TPM = $('#TPM').val();
         if (TPM === undefined || TPM === null || TPM === '') {
            TPM = 0.00;
         }
         var TCM = $('#TCM').val();
         if (TCM === undefined || TCM === null || TCM === '') {
            TCM = 0.00;
         }
         var ALDT = $('#ADLT').val();
         if (ALDT === undefined || ALDT === null || ALDT === '') {
             ALDT = 0.00;
         }
         var TTR = parseFloat(TPM) + parseFloat(TCM) + parseFloat(ALDT);
         //alert(TTR);
         document.getElementById("TTR").value = TTR;
         //alert(d_o_b);
     });

     $('#update_btn').on('click', function() {
         //alert('javascript working');
         $('#update_btn').attr('disabled', true);
         var validate = 0;

         var TBF = $('#TBF').val();
         var TCM = $('#TCM').val();
         var TPM = $('#TPM').val();
         var ADLT = $('#ADLT').val();
         var TTR = $('#TTR').val();

         if (TBF == '') {
             validate = 1;
             $('#TBF').addClass('red-border');
         }
         if (TCM == '') {
             validate = 1;
             $('#TCM').addClass('red-border');
         }
         if (TPM == '') {
             validate = 1;
             $('#TPM').addClass('red-border');
         }
         if (ADLT == '') {
             validate = 1;
             $('#ADLT').addClass('red-border');
         }
         if (TPM == '') {
             validate = 1;
             $('#TTR').addClass('red-border');
         }


         if (validate == 0) {
             $('#update_form')[0].submit();
         } else {
             $('#update_btn').removeAttr('disabled');
         }
     });

     function hide_form_div() {
         $('#form_div').slideUp();
     }

     function hide_detail_div() {
         $('#record_detail_div').slideUp();;
     }

     var element = document.getElementById('page-top');
     element.style.paddingRight = null;
 </script>