 <?php $this->load->view('common/header'); ?>

<style>
::-webkit-input-placeholder {
    color:Grey !important;
}

::-moz-placeholder {
    color:Grey !important; 
}

::-ms-placeholder {
    color:Grey !important;
}

::placeholder {
    color:Grey !important;
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
                                         <tr>
                                             <td scope="row"></td>
                                             <td scope="row"></td>
                                             <td scope="row"></td>
                                             <td scope="row"></td>
                                             <td scope="row"></td>
                                             <td scope="row"></td>
                                             <td scope="row"></td>
                                         </tr>

                                     </tbody>
                                 </table>
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
                             <form class="user" role="form" method="post" action="">
                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user bg-light" name="tbf" id="tbf" placeholder="Controller Type" disabled>
                                     </div>
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user bg-light" name="tbf" id="tbf" placeholder="ESWB" disabled>
                                     </div>
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user bg-light" name="tbf" id="tbf" placeholder="Name"disabled>
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="tbf" id="tbf" placeholder="TBF*">
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="tcm" id="tcm" placeholder="TCM*">
                                     </div>

                                     <div class="col-sm-8 mb-1">
                                         <input type="text" class="form-control form-control-user" name="tcm_desc" id="tcm_desc" placeholder="Description">
                                     </div>

                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="tpm" id="tpm" placeholder="TPM*">
                                     </div>

                                     <div class="col-sm-8 mb-1">
                                         <input type="text" class="form-control form-control-user" name="tpm_desc" id="tpm_desc" placeholder="Description">
                                     </div>


                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="adlt" id="adlt" placeholder="ADLT*">
                                     </div>

                                     <div class="col-sm-8 mb-1">
                                         <input type="text" class="form-control form-control-user" name="adlt_desc" id="adlt_desc" placeholder="Description">
                                     </div>

                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="ttr" id="ttr" placeholder="TTR">
                                     </div>

                                 </div>

                                 <div class="form-group row justify-content-center">
                                     <div class="col-sm-4">
                                         <button type="submit" class="btn btn-primary btn-user btn-block">
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



 <?php $this->load->view('common/footer'); ?>