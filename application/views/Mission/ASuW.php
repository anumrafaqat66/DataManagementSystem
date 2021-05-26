<?php $this->load->view('co/common/header'); ?>
<?php !isset($weaponReliability1) ? $weaponReliability1 = 0 : $weaponReliability1; ?>
<?php !isset($weaponReliability2) ? $weaponReliability2 = 0 : $weaponReliability2; ?>
<?php !isset($weaponReliability3) ? $weaponReliability3 = 0 : $weaponReliability3; ?>
<?php !isset($weaponReliability4) ? $weaponReliability4 = 0 : $weaponReliability4; ?>
<?php !isset($reliability) ? $reliability = 0 : $reliability; ?>
<?php !isset($time_entered) ? $time_entered = null : $time_entered; ?>

<script src="<?= base_url(); ?>assets/js/canvasjs.min.js"></script>

<style>
    .img {
        background: url('<?= base_url() ?>assets/img/ASuW.jpg');
        background-position: center;
        background-size: cover;
        height: 250px;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 0.75rem;
        padding-bottom: 15px;
    }


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
    <!-- <h1 class="h4 text-gray-900">Welcome CO</h1> -->
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">ASuW Mission</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row col-md-12" style="height:180px;">

                            <div class="col-md-4 img" style="width: 200px;height:180px;">
                                <div style="margin-top:135px">

                                </div>
                            </div>
                            <div class="col-md-8" style="width:80%;float: right;height:180px;">

                                <!--  <div style="margin-top:15px"> -->
                                <div class="row" style="padding-left:4%">
                                    <div class="col-sm-7 my-3" style="float: left;">
                                        <h6 class="h6 text-grey-900">To check mission reliabiltiy. Please enter time: </h6>
                                    </div>
                                    <div class="col-sm-5" style="float: right;">
                                        <form class="user" role="form" id="update_form" method="post" action="">
                                            <input type="text" class="form-control form-control-user" name="time" id="system_time" value="<?php echo $time_entered ?>" placeholder="Enter Time">
                                        </form>
                                    </div>
                                </div>
                                <!-- Availability Realibility bars -->
                                <div class="row" style="padding-left :5%;padding-top: 5%;height:75px;">
                                    <div class="col-sm-6">
                                        <h4 class="h4 text-grey-900">Availability</h4>
                                        <div class="progress" style="height:40px">
                                            <div class="progress-bar" id="availability_bar" role="progressbar" style="width: <?= $availability ?>%;" aria-valuenow="<?= $availability ?>" aria-valuemin="0" aria-valuemax="100"><?= $availability . "%" ?></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4 class="h4 text-grey-900">Reliability</h4>

                                        <div class="progress" style="height:40px">
                                            <div class="progress-bar" id="reliability_bar" role="progressbar" style="width: <?= $reliability ?>%;" aria-valuenow="<?= $reliability ?>" aria-valuemin="0" aria-valuemax="100"><?= $reliability . "%" ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!--   </div> -->

                            </div>


                        </div>

                        <div class="card">
                            <div class="card-header bg-custom1">
                                <h5 class="h5 text-white">Mission Statistics Graphs</h5>
                            </div>

                            <!-- <div class="card-body bg-custom3"> -->
                            <!--  <div class="form-group row">
                                    <div class="col-sm-6 my-3">
                                        <h6 class="h6 text-grey-900">To check mission reliabiltiy. Please enter time: </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <form class="user" role="form" id="update_form" method="post" action="">
                                            <input type="text" class="form-control form-control-user" name="time" id="system_time" value="<?php echo $time_entered ?>" placeholder="Enter Time">
                                        </form>
                                    </div>
                                </div> -->

                            <!-- <hr> -->
                            <!--  <div class="form-group row">
                                    <div class="col-sm-6">
                                        <h4 class="h4 text-grey-900">Availability</h4>
                                        <div class="progress" style="height:40px">
                                            <div class="progress-bar" id="availability_bar" role="progressbar" style="width: <?= $availability ?>%;" aria-valuenow="<?= $availability ?>" aria-valuemin="0" aria-valuemax="100"><?= $availability . "%" ?></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h4 class="h4 text-grey-900">Reliability</h4>

                                        <div class="progress" style="height:40px">
                                            <div class="progress-bar" id="reliability_bar" role="progressbar" style="width: <?= $reliability ?>%;" aria-valuenow="<?= $reliability ?>" aria-valuemin="0" aria-valuemax="100"><?= $reliability . "%" ?></div>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </div> -->
                        </div>
                        <!-- Graphs -->
                        <div class="card">
                            <!-- <div class="card-header bg-custom1">
                                <h5 class="h5 text-white">Graphs</h5>
                            </div> -->

                            <div class="card-body bg-custom3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <h3 class="text-grey-900">Availability</h3> -->
                                        <div>
                                            <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                                        </div>
                                        <?php
                                        $dataPoints = array(
                                            array("y" => $weapon1, "label" => "SSM"),
                                            array("y" => $weapon2, "label" => "Main Gun"),
                                            array("y" => $weapon3, "label" => "CRG(port)"),
                                            array("y" => $weapon4, "label" => "CRG(STDB)"),

                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-6" id="reliability_chart">
                                        <!-- <h3 class="text-grey-900">Relaibility</h3> -->
                                        <div>
                                            <div id="chartContainer1" style="height: 250px; width: 100%;"></div>
                                        </div>
                                        <?php
                                        $dataPoints1 = array(
                                            array("y" => $weaponReliability1, "label" => "SSM"),
                                            array("y" => $weaponReliability2, "label" => "Main Gun"),
                                            array("y" => $weaponReliability3, "label" => "CRG(Port)"),
                                            array("y" => $weaponReliability4, "label" => "CRG(STDB)"),
                                        );
                                        ?>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="form-group row justify-content-center my-3">
                            <div class="col-md-6">
                                <a class="btn btn-primary rounded-pill btn-user btn-block" href="<?= base_url(); ?>mission"><i class="fas fa-chevron-left"></i> Back</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
    window.onload = function() {

        $data = $("#availability_bar").html();
        $value = $data.substr(0, $data.length - 1);
        // alert($value);
        if ($value < 50) {
            $("#availability_bar").addClass('bg-danger');
        } else if ($value > 50 && $value <= 75) {
            $("#availability_bar").addClass('bg-warning');
        } else if ($value > 75) {
            $("#availability_bar").addClass('bg-success');
        }

        $data = $("#reliability_bar").html();
        $value_rel = $data.substr(0, $data.length - 1);
        // alert($value);
        if ($value_rel < 50) {
            $("#reliability_bar").addClass('bg-danger');
        } else if ($value_rel > 50 && $value_rel <= 75) {
            $("#reliability_bar").addClass('bg-warning');
        } else if ($value_rel > 75) {
            $("#reliability_bar").addClass('bg-success');
        }

        if ($value_rel > 0) {
            $('#reliability_chart').show();
        }


        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: ""
            },
            axisY: {
                includeZero: true,
                maximum: 100
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                indexLabel: "{y}%", //Shows y value on all Data Points
                indexLabelFontColor: "white",
                indexLabelFontWeight: "bolder",
                indexLabelPlacement: "inside",
                click: onClick,
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        changeColor(chart);
        chart.render();


        var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: ""
            },
            axisY: {
                includeZero: true,
                maximum: 100
            },
            data: [{
                type: "bar", //change type to bar, line, area, pie, etc
                indexLabel: "{y}%", //Shows y value on all Data Points
                indexLabelFontColor: "white",
                indexLabelFontWeight: "bolder",
                indexLabelPlacement: "inside",
                click: onClick,
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        changeColor(chart);
        chart.render();

        function changeColor(chart) {
            for (var i = 0; i < chart.options.data.length; i++) {
                for (var j = 0; j < chart.options.data[i].dataPoints.length; j++) {
                    y = chart.options.data[i].dataPoints[j].y;
                    if (y > 75) {
                        chart.options.data[i].dataPoints[j].color = "green";
                    } else if ((y >= 50) && (y <= 75)) {
                        chart.options.data[i].dataPoints[j].color = "orange";
                    } else if (y < 50) {
                        chart.options.data[i].dataPoints[j].color = "red";
                    }
                }
            }
        }

        // function onClick(e) {
        //     //alert(e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.x + ", y: " + e.dataPoint.y + " }");
        //     if (e.dataPoint.x == 0) {
        //         window.location.href = "<?= base_url(); ?>weo?we=SSM";
        //     } else if (e.dataPoint.x == 1) {
        //         window.location.href = "<?= base_url(); ?>weo?we=Main Gun";
        //     } else if (e.dataPoint.x == 2) {
        //         window.location.href = "<?= base_url(); ?>weo?we=CRG (Port)";
        //     } else if (e.dataPoint.x == 3) {
        //         window.location.href = "<?= base_url(); ?>weo?we=CRG (STDB)";
        //     }
        // }
        function onClick(e) {
            if (e.dataPoint.x == 0) {
                link = e.dataPoint.link;
                $('#SSM').modal('show');
                $entered_time = $('#system_time').val();
                $.ajax({
                    url: '<?= base_url(); ?>Mission/get_sensors_data',
                    method: 'POST',
                    data: {
                        'weapon_name': 'SSM'
                    },
                    success: function(data) {
                        result = JSON.parse(data);
                        $str = '';
                        for (var i in result) {
                            $str = result[i].Controller_Name.replace(" ", "_");

                            $("[id*='" + $str + "_A']").html(String(number_format(result[i].Availability / 100, 2)));
                            if ($entered_time == null || $entered_time == '') {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Default_Reliability / 100, 2)));
                            } else {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Reliability / 100, 2)));
                            }
                        }
                    },
                    error: function(data) {
                        //alert(data);
                        alert('failure');
                    }
                });

            } else if (e.dataPoint.x == 1) {
                link = e.dataPoint.link;
                $('#MG').modal('show');

                $entered_time = $('#system_time').val();
                $.ajax({
                    url: '<?= base_url(); ?>Mission/get_sensors_data',
                    method: 'POST',
                    data: {
                        'weapon_name': 'Main Gun'
                    },
                    success: function(data) {
                        result = JSON.parse(data);
                        $str = '';
                        for (var i in result) {
                            $str = result[i].Controller_Name.replace(" ", "_");

                            $("[id*='" + $str + "_A']").html(String(number_format(result[i].Availability / 100, 2)));
                            if ($entered_time == null || $entered_time == '') {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Default_Reliability / 100, 2)));
                            } else {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Reliability / 100, 2)));
                            }
                        }
                    },
                    error: function(data) {
                        //alert(data);
                        alert('failure');
                    }
                });

            } else if (e.dataPoint.x == 2) {
                link = e.dataPoint.link;
                $('#CP').modal('show');

                $entered_time = $('#system_time').val();
                $.ajax({
                    url: '<?= base_url(); ?>Mission/get_sensors_data',
                    method: 'POST',
                    data: {
                        'weapon_name': 'CRG (Port)'
                    },
                    success: function(data) {
                        result = JSON.parse(data);
                        $str = '';
                        for (var i in result) {
                            $str = result[i].Controller_Name.replace(" ", "_");

                            $("[id*='" + $str + "_A']").html(String(number_format(result[i].Availability / 100, 2)));
                            if ($entered_time == null || $entered_time == '') {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Default_Reliability / 100, 2)));
                            } else {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Reliability / 100, 2)));
                            }
                        }
                    },
                    error: function(data) {
                        //alert(data);
                        alert('failure');
                    }
                });

            } else if (e.dataPoint.x == 3) {
                link = e.dataPoint.link;
                $('#CS').modal('show');

                $entered_time = $('#system_time').val();
                $.ajax({
                    url: '<?= base_url(); ?>Mission/get_sensors_data',
                    method: 'POST',
                    data: {
                        'weapon_name': 'CRG (STDB)'
                    },
                    success: function(data) {
                        result = JSON.parse(data);
                        $str = '';
                        for (var i in result) {
                            $str = result[i].Controller_Name.replace(" ", "_");

                            $("[id*='" + $str + "_A']").html(String(number_format(result[i].Availability / 100, 2)));
                            if ($entered_time == null || $entered_time == '') {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Default_Reliability / 100, 2)));
                            } else {
                                $("[id*='" + $str + "_R']").html(String(number_format(result[i].Reliability / 100, 2)));
                            }
                        }
                    },
                    error: function(data) {
                        //alert(data);
                        alert('failure');
                    }
                });
            }
        }

    }

    var dps = []; //Global
    var reliability;
    var enteredTime;

    $('#system_time').on('focusout', function() {
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>Mission/get_mission_reliability',
            method: 'POST',
            data: {
                'mission_name': 'ASuW',
                'time': time
            },
            success: function(data) {

                $('#reliability_bar').html(data + "%");
                $('#reliability_bar').width(data * 5);
                reliability = data;
                enteredTime = time;
            },
            async: false
        });

        $.ajax({
            url: '<?= base_url(); ?>Mission/get_each_weapon_reliability',
            method: 'POST',
            data: {
                'mission_name': 'ASuW'
            },
            success: function(data) {
                result = JSON.parse(data);

                for (var i in result) {
                    dps.push(result[i]);
                }
            },
            async: false
        });

        $.ajax({
            url: '<?= base_url(); ?>Mission/PageReload',
            method: 'POST',
            data: {
                'page_name': 'ASuW',
                'wr1': dps[0],
                'wr2': dps[1],
                'wr3': dps[2],
                'wr4': dps[3],
                'wp1': <?php echo json_encode($weapon1, JSON_NUMERIC_CHECK); ?>,
                'wp2': <?php echo json_encode($weapon2, JSON_NUMERIC_CHECK); ?>,
                'wp3': <?php echo json_encode($weapon3, JSON_NUMERIC_CHECK); ?>,
                'wp4': <?php echo json_encode($weapon4, JSON_NUMERIC_CHECK); ?>,
                'avail': <?php echo json_encode($availability, JSON_NUMERIC_CHECK); ?>,
                'rel': reliability,
                'time': enteredTime
            },
            success: function(data) {
                var newDoc = document.open("text/html", "replace");
                newDoc.write(data);
                newDoc.close();
            },
            async: false,
            error: function(data) {
                alert('failure');
            }
        });

    });
    $('#mission').on('change', function() {
        var a = $(this).val();
        if ($(this).val() == 'AAW') {
            window.location.href = "<?= base_url(); ?>mission/mission/AAW";
        } else if ($(this).val() == 'ASuW') {
            window.location.href = "<?= base_url(); ?>mission/mission/ASuW";
        } else if ($(this).val() == 'ASW') {
            window.location.href = "<?= base_url(); ?>mission/mission/ASW";
        } else if ($(this).val() == 'EW') {
            window.location.href = "<?= base_url(); ?>mission/mission/EW";
        }
    });
</script>