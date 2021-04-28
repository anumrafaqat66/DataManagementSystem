 <?php $this->load->view('common/header'); ?>

 <div class="container">

     <div class="card o-hidden border-0 shadow-lg">
         <div class="card-body">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <div class="card-header">
                             <h1 class="h4 text-gray-900">Technician Data Entry Module</h1>
                         </div>

                         <div class="card-body">
                             <form class="user" role="form" method="post" action="">
                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                             <option class="form-control form-control-user" value="">Select Controller</option>
                                             <option class="form-control form-control-user" value="Sensor">Sensor</option>
                                             <option class="form-control form-control-user" value="Fire Controller">Fire Controller</option>
                                         </select>
                                     </div>

                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="eswb" id="eswb" placeholder="ESWB">
                                     </div>

                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="name" id="name" placeholder="Name">
                                     </div>
                                 </div>

                                 <div class="form-group row">
                                     <div class="col-sm-4 mb-1">
                                         <input type="text" class="form-control form-control-user" name="included" id="included" placeholder="Included">
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

         <div class="card-body">
             <!-- Nested Row within Card Body -->
             <div class="row">
                 <div class="col-lg-12">

                     <div class="card">
                         <div class="card-header">
                             <h1 class="h4 text-gray-900">Entered Data</h1>
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
     </div>
 </div>



 <?php $this->load->view('common/footer'); ?>