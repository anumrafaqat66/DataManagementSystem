<?php $this->load->view('weo/common/header'); ?>
<?php !isset($selected_weapon) ? $selected_weapon = "Select Weapon" : $selected_weapon; ?>
<style>
    .dot {
        height: 150px;
        width: 150px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }

    .center-text {
        margin-top: 60px;
        font-weight: bold;
        color: black;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .box {
        display: inline-block;
        /* border: 1px solid black; */
        padding: 10px 0px;
        margin: 0px 25px;
        width: 150px;
        text-align: center;
        box-shadow: 5px 10px #888888;
        border-radius: 10px;
        background-color: #D3D3D3;
    }

    .box_center {
        display: inline-block;
        /* border: 1px solid black; */
        padding: 10px 0px;
        margin-left: -5px;
        width: 150px;
        text-align: center;
        box-shadow: 5px 10px #888888;
        border-radius: 10px;
        background-color: #FA8072;
    }

    .box.hidden {
        visibility: hidden;
    }

    .lines {
        margin-left: 100px;
        height: 29px;
    }

    .line_bottom {
        display: inline-block;
        border: 1px solid black;
        border-top: none;
        border-right: none;
        height: 30px;
        width: 200px;
        margin-left: -5px;
        margin-right: 0;
    }

    .line_top {
        display: inline-block;
        border: 1px solid black;
        border-bottom: none;
        border-right: none;
        height: 30px;
        width: 200px;
        margin-left: -5px;
        margin-right: 0;
    }

    .line_middle {
        display: inline-block;
        border: 1px solid black;
        border-bottom: none;
        border-right: none;
        border-left: none;
        height: 4px;
        width: 200px;
        margin-left: -5px;
        margin-right: 0;

    }

    .connect {
        height: 30px;
        border-right: 1px solid black;
    }

    .connect.three {
        width: 295px;
        margin-top: -6px;
    }
</style>
<div class="container">
    <!-- <h1 class="h4 text-gray-900">Welcome WEO</h1>
    <hr> -->

    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1 ">
                        <h1 class="h4 text-white">Weapon System</h1>
                    </div>

                    <div class="card-body bg-custom3">

                        <!-- <hr> -->
                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row ">
                                <!-- <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="<?= $selected_weapon; ?>"><?= $selected_weapon; ?></option>
                                        <?php //if (isset($controller_data)) {
                                        //foreach ($controller_data as $data) { 
                                        ?>
                                                <option class="form-control form-control-user" value="<?= $data['Controller_Name']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php //}
                                        //}  
                                        ?>
                                    </select>
                                </div> -->
                                <div class="col-sm-7 my-3">
                                    <h6>To check the reliability of the complete weapon system, please enter time:</h6>
                                </div>
                                <div class="col-sm-4 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="system_time" placeholder="Enter Time">
                                </div>
                            </div>

                            <div id="table_div">
                                <?php if (isset($controller_data)) {
                                    if (count($controller_data) > 0) { ?>

                                        <table id="datatable" class="table table-sm table-striped bg-custom3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Availability</th>
                                                    <th scope="col">Reliability</th>

                                                </tr>
                                            </thead>
                                            <tbody id="table_rows">
                                                <?php $count = 0;
                                                foreach ($controller_data as $data) { ?>
                                                    <tr>
                                                        <td scope="row"><?= ++$count; ?></td>
                                                        <td type="button" scope="row" id="weapon_name<?= $count ?>" value="<?= $data['Controller_Name']; ?>" data-toggle="modal" data-target="#<?= $data['Controller_Code']; ?>"><?= $data['Controller_Name']; ?></td>
                                                        <td scope="row"><?= $data['Availability']; ?></td>
                                                        <td scope="row"><?= $data['Reliability']; ?></td>
                                                        <!-- <td>
                                                        <a class="btn btn-primary rounded-pill text-sm" href="<?= base_url(); ?>manager/Update_data/<?= $data['id']; ?>">Update Record</a>
                                                        </td> -->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="card-header">
                                            <h1 class="h4 text-gray-900">No records Available</h1>
                                        </div>
                                    <?php }
                                    unset($sensor_data);
                                    // unset($data['controller_detail_records']);
                                } else { ?>
                                    <a> No Record Available. </a>
                                <?php  } ?>
                            </div>

                            <!-- <hr> -->
                            <!-- <div class="form-group row">

                                <div class="col-sm-6">
                                    <h5 class="text-center">Availability</h5>
                                </div>

                                <div class="col-sm-6 ">
                                    <h5 class="text-center">Reliability</h5>
                                </div>

                            </div> -->

                            <!-- <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <span class="dot" id="system_availability">
                                            <div class="center-text h5" id="availability">0.00%</div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <span class="dot" id="system_reliability">
                                            <div class="center-text h5" id="reliability">0.00%</div>
                                        </span>
                                    </div>
                                </div>
                            </div> -->


                            <!-- <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="show_graphs" class="btn btn-primary btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i>  
                                        Show Detail
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div> -->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="sam_card" > -->
    <!-- <button type="button" class="btn btn-primary rounded-pill" id="reason_button" data-toggle="modal" data-target="#SAM">
        View Reason
    </button> -->

    <div class="modal fade" id="SAM">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">SAM (Surface to Air Missile)</h1>
                        </div>

                        <div class="card-body mx-5 bg-custom3">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="CCS_A">A</a><a href="<?= base_url(); ?>Manager/show_records/3"> CCS </a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="CCS_R">R</a></div>

                            </div>

                            <div class="lines">
                                <div class="line_bottom"></div>
                                <div class="box_center" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="FC1_A">A</a><a href="<?= base_url(); ?>Manager/show_records/4">FC1</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="FC1_R">R</a></div>
                                <div class="line_middle"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black;" id="SAM_A">A</a><a href="<?= base_url(); ?>Manager/show_records/8" style="color:whitesmoke;">SAM</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="SAM_R">R</a></div>
                            </div>
                            <div class="lines">
                                <div class="line_top"></div>
                            </div>

                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="S1_A">A</a><a href="<?= base_url(); ?>Manager/show_records/1">S1</a><a href="<?= base_url(); ?>HOD" style="float:right;color:black; font-size:small;" id="S1_R">R</a></div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>

                </div>

            </div>

        </div>
    </div>


    <div class="modal fade" id="MG">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">Main Gun</h1>
                        </div>

                        <div class="card-body mx-5">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a><a href="<?= base_url(); ?>Manager/show_records/3">CCS</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="CCS_R">R</a></div>

                            </div>

                            <div class="lines">
                                <div class="line_bottom"></div>
                                <div class="box_center" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="FC2_A">A</a><a href="<?= base_url(); ?>Manager/show_records/5">FC2</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="FC2_R">R</a></div>
                                <div class="line_middle"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="Main_Gun_A">A</a><a href="<?= base_url(); ?>Manager/show_records/9" style="color:whitesmoke;">Main Gun</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="Main_Gun_R">R</a></div>
                            </div>
                            <div class="lines">
                                <div class="line_top"></div>
                            </div>

                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="S1_A">A</a><a href="<?= base_url(); ?>Manager/show_records/1">S1</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="S1_R">R</a></div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="CP">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">CRG (Port)</h1>
                        </div>

                        <div class="card-body mx-5">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a><a href="<?= base_url(); ?>Manager/show_records/3">CCS</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="CCS_R">R</a></div>
                                <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="FC3_A">A</a><a href="<?= base_url(); ?>Manager/show_records/6">FC3</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black;" id="FC3_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_bottom"></div>
                                <div class="line_bottom"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CRG_(Port)_A">A</a><a href="<?= base_url(); ?>Manager/show_records/10" style="color:whitesmoke;">CRG (Port)</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="CRG_(Port)_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_top"></div>
                                <div class="line_top"></div>

                            </div>

                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="S1_A">A</a><a href="<?= base_url(); ?>Manager/show_records/1">S1</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="S1_R">R</a></div>
                                <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black;" id="FC4_A">A</a><a href="<?= base_url(); ?>Manager/show_records/7">FC4</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black;" id="FC4_R">R</a></div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="CS">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">CRG (STDB)</h1>
                        </div>

                        <div class="card-body mx-5">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a><a href="<?= base_url(); ?>Manager/show_records/3">CCS</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black ;" id="CCS_R">R</a></div>
                                <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="FC3_A">A</a><a href="<?= base_url(); ?>Manager/show_records/6">FC3</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="FC3_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_bottom"></div>
                                <div class="line_bottom"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small; color: black;" id="CRG_(STDB)_A">A</a><a href="<?= base_url(); ?>Manager/show_records/11" style="color:whitesmoke;">CRG(STDB)</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="CRG_(STDB)_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_top"></div>
                                <div class="line_top"></div>

                            </div>

                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="S1_A">A</a><a href="<?= base_url(); ?>Manager/show_records/1">S1</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="S1_R">R</a></div>
                                <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="FC4_A">A</a><a href="<?= base_url(); ?>Manager/show_records/7">FC4</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="FC4_R">R</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="SSM">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">SSM (Surface to Surface Missile)</h1>
                        </div>

                        <div class="card-body mx-5">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="S1_A">A</a><a href="<?= base_url(); ?>Manager/show_records/1">S1</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black ;" id="S1_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_bottom"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small; color: black;" id="SSM_A">A</a><a href="<?= base_url(); ?>Manager/show_records/12" style="color:whitesmoke;">SSM</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="SSM_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_top"></div>
                            </div>

                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="S2_A">A</a><a href="<?= base_url(); ?>Manager/show_records/2">S2</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="S2_R">R</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="TOR">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">Torpedo</h1>
                        </div>

                        <div class="card-body bg-custom3" style="height:100px;">

                            <div class="lines">
                                <div class="box_center" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="SONAR_A">A</a><a href="<?= base_url(); ?>Manager/show_records/15">SONAR</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="SONAR_R">R</a></div>
                                <div class="line_middle"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black;" id="Torpedo_A">A</a><a href="<?= base_url(); ?>Manager/show_records/13" style="color:whitesmoke;">Torpedo</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="Torpedo_R">R</a></div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="RDC">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">RDC</h1>
                        </div>

                        <div class="card-body bg-custom3" style="height:100px;">
                            <div class="lines">
                                <div class="box_center" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="SONAR_A">A</a><a href="<?= base_url(); ?>Manager/show_records/15">SONAR</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="SONAR_R">R</a></div>
                                <div class="line_middle"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black;" id="RDC_A">A</a><a href="<?= base_url(); ?>Manager/show_records/14" style="color:whitesmoke;">RDC</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="RDC_R">R</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PJ-46">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">PJ-46</h1>
                        </div>

                        <div class="card-body mx-5">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a><a href="<?= base_url(); ?>Manager/show_records/3">CCS</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black ;" id="CCS_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_bottom"></div>
                                <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small; color: black;" id="PJ-46_A">A</a><a href="<?= base_url(); ?>Manager/show_records/3" style="color:whitesmoke;">PJ-46</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="PJ-46_R">R</a></div>
                            </div>

                            <div class="lines">
                                <div class="line_top"></div>
                            </div>

                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="NRJ_A">A</a><a href="<?= base_url(); ?>Manager/show_records/16">NRJ</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="NRJ_R">R</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="NRJ">
        <!-- <div class="row"> -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header" style="width:1000px;">
                    <!-- <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-lg-12">

                    <div class="card bg-custom3">
                        <div class="card-header bg-custom1">
                            <h1 class="h5 text-white">Jammer (NRJ)</h1>
                        </div>

                        <div class="card-body mx-5">
                            <div>
                                <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="NRJ_A">A</a><a href="<?= base_url(); ?>Manager/show_records/16">NRJ</a><a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black ;" id="NRJ_R">R</a></div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</div>

</div>



<?php $this->load->view('common/footer'); ?>
<script>
    $('#table_rows').find('td').click(function() {
        // alert($(this).html());
        var weapon = $(this).html();

        // $('#sam_card').hide();
        // $('#main_gun').hide();
        // $('#CRG_Port').hide();
        // $('#CRG_STDB').hide();
        // $('#SSM').hide();
        // $('#Torpedo').hide();
        // $('#RDC').hide();
        // $('#PJ-46').hide();
        // $('#NRJ').hide();

        // if (weapon == 'SAM') {
        //     $('#sam_card').show();
        // } else if (weapon == 'Main Gun') {
        //     $('#main_gun').show();
        // } else if (weapon == 'CRG (Port)') {
        //     $('#CRG_Port').show();
        // } else if (weapon == 'CRG (STDB)') {
        //     $('#CRG_STDB').show();
        // } else if (weapon == 'SSM') {
        //     $('#SSM').show();
        // } else if (weapon == 'Torpedo') {
        //     $('#Torpedo').show();
        // } else if (weapon == 'RDC') {
        //     $('#RDC').show();
        // } else if (weapon == 'NRJ') {
        //     $('#NRJ').show();
        // } else if (weapon == 'PJ-46') {
        //     $('#PJ-46').show();
        // }

        // alert(weapon);
        if (weapon != '') {
            $.ajax({
                url: '<?= base_url(); ?>WEO/get_sensors_data',
                method: 'POST',
                data: {
                    'weapon_name': weapon
                },
                success: function(data) {
                    result = JSON.parse(data);
                    $str = '';
                    for (var i in result) {
                        $str = result[i].Controller_Name.replace(" ", "_");
                        alert($str);
                        $("[id*='" + $str + "_A']").html(String(number_format(result[i].Availability / 100, 2)));
                        $("[id*='" + $str + "_R']").html(String(number_format(0.00 / 100, 2)));
                    }
                },
                error: function(data) {
                    //alert(data);
                    alert('failure');
                }
            });

        }
        e.preventDefault();
        window.onunload = function() {
            dubugger;
        }

    });

    // window.onload = function() {
    //     var weapon = $('#controller_type').val();
    //     //alert(weapon);
    //     if (weapon != "Select Weapon") {
    //         //alert('iam in IF condition');
    //         $('#sam_card').hide();
    //         $('#main_gun').hide();
    //         $('#CRG_Port').hide();
    //         $('#CRG_STDB').hide();
    //         $('#SSM').hide();
    //         $('#Torpedo').hide();
    //         $('#RDC').hide();
    //         $('#PJ-46').hide();
    //         $('#NRJ').hide();
    //         $('#reliability').html("0.00%");
    //         // document.getElementById("system_reliability").style.backgroundColor = "#bbb";
    //         $('#system_time').val(null);

    //         if (weapon == 'SAM') {
    //             $('#sam_card').show();
    //         } else if (weapon == 'Main Gun') {
    //             $('#main_gun').show();
    //         } else if (weapon == 'CRG (Port)') {
    //             $('#CRG_Port').show();
    //         } else if (weapon == 'CRG (STDB)') {
    //             $('#CRG_STDB').show();
    //         } else if (weapon == 'SSM') {
    //             $('#SSM').show();
    //         } else if (weapon == 'Torpedo') {
    //             $('#Torpedo').show();
    //         } else if (weapon == 'RDC') {
    //             $('#RDC').show();
    //         } else if (weapon == 'NRJ') {
    //             $('#NRJ').show();
    //         } else if (weapon == 'PJ-46') {
    //             $('#PJ-46').show();
    //         }

    //         //var name = $(this).val();
    //         if (weapon != '') {
    //             $.ajax({
    //                 url: '<?= base_url(); ?>WEO/get_system_availability',
    //                 method: 'POST',
    //                 data: {
    //                     'weapon_name': weapon
    //                 },
    //                 success: function(data) {
    //                     // var result = jQuery.parseJSON(data);
    //                     //alert(result);
    //                     $('#availability').html(data + "%");
    //                     if (data < 50) {
    //                         document.getElementById("system_availability").style.backgroundColor = "red";
    //                     } else if (data > 50 && data < 75) {
    //                         document.getElementById("system_availability").style.backgroundColor = "yellow";
    //                     } else if (data >= 75) {
    //                         document.getElementById("system_availability").style.backgroundColor = "green";
    //                     }
    //                 },
    //                 async: false
    //                 // ,
    //                 // error: function(data) {
    //                 //     //alert(data);
    //                 //     alert('failure');
    //                 // }
    //             });
    //         }

    //         if (weapon != '') {
    //             $.ajax({
    //                 url: '<?= base_url(); ?>WEO/get_sensors_data',
    //                 method: 'POST',
    //                 data: {
    //                     'weapon_name': weapon
    //                 },
    //                 success: function(data) {
    //                     result = JSON.parse(data);
    //                     $str = '';
    //                     for (var i in result) {
    //                         $str = result[i].Controller_Name.replace(" ", "_");
    //                         $("[id*='" + $str + "_A']").html(String(number_format(result[i].Availability / 100, 2)));
    //                         $("[id*='" + $str + "_R']").html(String(number_format(0.00 / 100, 2)));
    //                     }
    //                 },
    //                 error: function(data) {
    //                     //alert(data);
    //                     alert('failure');
    //                 }
    //             });

    //         }
    //         e.preventDefault();
    //         window.onunload = function() {
    //             dubugger;
    //         }

    //     }
    // }

    // $('#show_graphs').on('click', function() {
    //     $('#sam_card').hide();
    //     $('#main_gun').hide();
    //     $('#CRG_Port').hide();
    //     $('#CRG_STDB').hide();
    //     $('#SSM').hide();
    //     $('#Torpedo').hide();
    //     $('#RDC').hide();
    //     $('#PJ-46').hide();
    //     $('#NRJ').hide();
    //     //$('#sam_card').hide();
    //     var name = $('#controller_type').val();

    //     if (name == 'SAM') {
    //         $('#sam_card').show();
    //     } else if (name == 'Main Gun') {
    //         $('#main_gun').show();
    //     } else if (name == 'CRG (Port)') {
    //         $('#CRG_Port').show();
    //     } else if (name == 'CRG (STDB)') {
    //         $('#CRG_STDB').show();
    //     } else if (name == 'SSM') {
    //         $('#SSM').show();
    //     } else if (name == 'Torpedo') {
    //         $('#Torpedo').show();
    //     } else if (name == 'RDC') {
    //         $('#RDC').show();
    //     } else if (name == 'NRJ') {
    //         $('#NRJ').show();
    //     } else if (name == 'PJ-46') {
    //         $('#PJ-46').show();
    //     }


    //     if (name != '') {
    //         $.ajax({
    //             url: '<?= base_url(); ?>WEO/get_sensors_data',
    //             method: 'POST',
    //             data: {
    //                 'weapon_name': name
    //             },
    //             success: function(data) {
    //                 result = JSON.parse(data);
    //                 $str = '';
    //                 for (var i in result) {
    //                     $str = result[i].Controller_Name.replace(" ", "_");
    //                     $("[id*='" + $str + "_A']").html(String(number_format((result[i].Availability) / 100, 2)));
    //                     //$("[id*='" + $str + "_R']").html(String(number_format((result[i].Reliability) / 100, 2)));
    //                 }
    //             },
    //             error: function(data) {
    //                 //alert(data);
    //                 alert('failure');
    //             }
    //         });

    //     }
    //     e.preventDefault();
    //     window.onunload = function() {
    //         dubugger;
    //     }

    // });


    // $('#controller_type').on('change', function() {

    //     $('#sam_card').hide();
    //     $('#main_gun').hide();
    //     $('#CRG_Port').hide();
    //     $('#CRG_STDB').hide();
    //     $('#SSM').hide();
    //     $('#Torpedo').hide();
    //     $('#RDC').hide();
    //     $('#PJ-46').hide();
    //     $('#NRJ').hide();
    //     $('#reliability').html("0.00%");
    //     document.getElementById("system_reliability").style.backgroundColor = "#bbb";
    //     $('#system_time').val(null);

    //     var name = $(this).val();
    //     if (name != '') {
    //         $.ajax({
    //             url: '<?= base_url(); ?>WEO/get_system_availability',
    //             method: 'POST',
    //             data: {
    //                 'weapon_name': name
    //             },
    //             success: function(data) {
    //                 // var result = jQuery.parseJSON(data);
    //                 //alert(result);
    //                 $('#availability').html(data + "%");
    //                 if (data < 50) {
    //                     document.getElementById("system_availability").style.backgroundColor = "red";
    //                 } else if (data > 50 && data < 75) {
    //                     document.getElementById("system_availability").style.backgroundColor = "yellow";
    //                 } else if (data >= 75) {
    //                     document.getElementById("system_availability").style.backgroundColor = "green";
    //                 }
    //             }
    //             // ,
    //             // error: function(data) {
    //             //     //alert(data);
    //             //     alert('failure');
    //             // }
    //         });
    //     }


    //     if (name != '') {
    //         $.ajax({
    //             url: '<?= base_url(); ?>WEO/get_sensors_data',
    //             method: 'POST',
    //             data: {
    //                 'weapon_name': name
    //             },
    //             success: function(data) {
    //                 result = JSON.parse(data);
    //                 $str = '';
    //                 for (var i in result) {
    //                     $str = result[i].Controller_Name.replace(" ", "_");
    //                     //$("[id*='" + $str + "_A']").html(0.00);
    //                     $("[id*='" + $str + "_R']").html(String(number_format(0.00 / 100, 2)));
    //                 }
    //             },
    //             error: function(data) {
    //                 //alert(data);
    //                 alert('failure');
    //             }
    //         });

    //     }
    //     e.preventDefault();
    //     window.onunload = function() {
    //         dubugger;
    //     }

    // });

    $('#system_time').on('focusout', function() {
        var name = $('#controller_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>WEO/get_all_weapons_reliability',
            method: 'POST',
            data: {
                'weapon_name': name,
                'time': time
            },
            success: function(data) {
                // var result = jQuery.parseJSON(data);
                //alert(result);
                // $('#reliability').html(data + "%");
                // if (data < 50) {
                //     document.getElementById("system_reliability").style.backgroundColor = "red";
                // } else if (data > 50 && data < 75) {
                //     document.getElementById("system_reliability").style.backgroundColor = "yellow";
                // } else if (data >= 75) {
                //     document.getElementById("system_reliability").style.backgroundColor = "green";
                // }
                setInterval('location.reload()', 100);        // Using .reload() method.
            },
            async: false
            // error: function(data) {
            //     //alert(data);
            //     alert('failure');
            // }
        });

        // result = '';
        // var name = $('#controller_type').val();
        // if (name != '') {
        //     $.ajax({
        //         url: '<?= base_url(); ?>WEO/get_sensors_data',
        //         method: 'POST',
        //         data: {
        //             'weapon_name': name
        //         },
        //         success: function(data) {
        //             result = JSON.parse(data);
        //             $str = '';
        //             for (var i in result) {
        //                 $str = result[i].Controller_Name.replace(" ", "_");
        //                 $("[id*='" + $str + "_A']").html(String(number_format((result[i].Availability) / 100, 2)));
        //                 $("[id*='" + $str + "_R']").html(String(number_format((result[i].Reliability) / 100, 2)));
        //             }
        //         },
        //         error: function(data) {
        //             //alert(data);
        //             alert('failure');
        //         }
        //     });

        // }
        // e.preventDefault();
        // window.onunload = function() {
        //     dubugger;
        // }

    });
</script>