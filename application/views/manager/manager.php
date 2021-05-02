 <?php $this->load->view('common/header'); ?>

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

         <div class="card-body">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <div class="card-header">
                             <h1 class="h4 text-gray-900">Select Record to Enter/Update Data</h1>
                         </div>

                         <div class="card-body">
                             <div id="table_div">
                                 <?php if (count($manager_controller_data) > 0) { ?>
                                     <table id="datatable" class="table table-striped">
                                         <thead>
                                             <tr>
                                                 <th scope="col">ID</th>
                                                 <th scope="col">Controller Type</th>
                                                 <th scope="col">ESWB</th>
                                                 <th scope="col">Name</th>
                                                 <!-- <th scope="col">Included</th>
                                                 <th scope="col">Not Included</th>
                                                 <th scope="col">Associated Equipment</th> -->
                                                 <th scope="col">TBF</th>
                                                 <th scope="col">TCM</th>
                                                 <th scope="col">TPM</th>
                                                 <th scope="col">ADLT</th>
                                                 <th scope="col">TTR</th>
                                                 <th scope="col">Action</th>

                                             </tr>
                                         </thead>
                                         <tbody>
                                             <?php $count = 0;
                                                foreach ($manager_controller_data as $data) { ?>
                                                 <tr>
                                                     <td scope="row"><?= $data['id']; ?></td>
                                                     <td scope="row"><?= $data['Controller_type']; ?></td>
                                                     <td scope="row"><?= $data['ESWB']; ?></td>
                                                     <td scope="row"><?= $data['Controller_Name']; ?></td>
                                                     <!-- <td scope="row"><?= $data['Includes']; ?></td>
                                                     <td scope="row"><?= $data['Not_Includes']; ?></td>
                                                     <td scope="row"><?= $data['Associated_Equipment']; ?></td> -->
                                                     <td scope="row"><?= $data['TBF']; ?></td>
                                                     <td scope="row"><?= $data['TCM']; ?></td>
                                                     <td scope="row"><?= $data['TPM']; ?></td>
                                                     <td scope="row"><?= $data['ADLT']; ?></td>
                                                     <td scope="row"><?= $data['TTR']; ?></td>
                                                     <td>
                                                         <a class="btn btn-primary rounded-pill" href="<?= base_url(); ?>manager/Get_Values/<?= $data['id']; ?>">Update</a>
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


         <div class="card-body">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <div class="card-header">
                             <h1 class="h4 text-gray-900">Manager Data Entry Module</h1>
                         </div>

                         <div class="card-body">
                             <form class="user" role="form" id="update_form" method="post" action="<?= base_url(); ?>manager/Update_data/<?php if (isset($selected_controller_data['Controller_type'])) { echo $selected_controller_data['id'];} else {echo "";}; ?>">
                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user bg-light" name="Controller_type" id="Controller_type" placeholder="Controller Type" value="<?php if (isset($selected_controller_data['Controller_type'])) { echo $selected_controller_data['Controller_type'];} else {echo "";}; ?>" disabled>
                                     </div>
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user bg-light" name="ESWB" id="ESWB" placeholder="ESWB" value="<?php if (isset($selected_controller_data['ESWB'])) { echo $selected_controller_data['ESWB'];} else {echo "";}; ?>" disabled>
                                     </div>
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user bg-light" name="Name" id="Name" placeholder="Name" value="<?php if (isset($selected_controller_data['Controller_Name'])) { echo $selected_controller_data['Controller_Name'];} else {echo "";}; ?>" disabled>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['TBF'])) { echo $selected_controller_data['TBF'];} else {echo "";}; ?>" name="TBF" id="TBF" placeholder="TBF*">
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['TCM'])) { echo $selected_controller_data['TCM'];} else {echo "";}; ?>" name="TCM" id="TCM" placeholder="TCM*">
                                     </div>

                                     <div class="col-sm-8 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['TCM_Desc'])) { echo $selected_controller_data['TCM_Desc'];} else {echo "";}; ?>" name="TCM_Desc" id="TCM_Desc" placeholder="Description">
                                     </div>

                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['TPM'])) { echo $selected_controller_data['TPM'];} else {echo "";}; ?>" name="TPM" id="TPM" placeholder="TPM*">
                                     </div>

                                     <div class="col-sm-8 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['TPM_Desc'])) { echo $selected_controller_data['TPM_Desc'];} else {echo "";}; ?>" name="TPM_Desc" id="TPM_Desc" placeholder="Description">
                                     </div>


                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['ADLT'])) { echo $selected_controller_data['ADLT'];} else {echo "";}; ?>" name="ADLT" id="ADLT" placeholder="ADLT*">
                                     </div>

                                     <div class="col-sm-8 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['ADLT_Desc'])) { echo $selected_controller_data['ADLT_Desc'];} else {echo "";}; ?>" name="ADLT_Desc" id="ADLT_Desc" placeholder="Description">
                                     </div>

                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" value="<?php if (isset($selected_controller_data['TTR'])) { echo $selected_controller_data['TTR'];} else {echo "";}; ?>" name="TTR" id="TTR" placeholder="TTR*">
                                     </div>

                                 </div>

                                 <div class="form-group row justify-content-center">
                                     <div class="col-sm-4">
                                         <button type="button" class="btn btn-primary btn-user btn-block" id="update_btn">
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

     $('#TTR').on('click', function() {
   
    var TPM = $('#TPM').val();
     //alert(TPM);
    var TCM = $('#TCM').val();
    //alert(TCM);
    var ALDT = $('#ADLT').val();
    //alert(ALDT);
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
    var ADLT =$('#ADLT').val();
     var TTR =$('#TTR').val();

    if (TBF == '') {
      validate = 1;
      $('#TBF').addClass('red-border');
    }
     if (TCM == '') {
      validate = 1;
      $('#TCM').addClass('red-border');
    }
     if(TPM == '' ){
        validate=1;
        $('#TPM').addClass('red-border');
    }
        if (ADLT == '') {
      validate = 1;
      $('#ADLT').addClass('red-border');
    }
     if(TPM == '' ){
        validate=1;
        $('#TTR').addClass('red-border');
    }
       

   if (validate == 0) {
      $('#update_form')[0].submit();
    } else {
      $('#update_btn').removeAttr('disabled');
    }
});

</script>
