<?php $this->load->view('weo/common/header'); ?>
<style>
    .dot {
        height: 180px;
        width: 180px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }

    .center-text {
        margin-top: 75px;
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
    <h1 class="h4 text-gray-900">Welcome WEO</h1>
    <hr>

    <div class="card-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1 ">
                        <h1 class="h4 text-white">Weapon System</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <h6>To check the availability of the complete system, Please select the Weapon.</h6>
                        <hr>
                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row ">
                                <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Weapon</option>
                                        <?php if (isset($controller_data)) {
                                            foreach ($controller_data as $data) { ?>
                                                <option class="form-control form-control-user" value="<?= $data['Controller_Name']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php }
                                        }  ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="system_time" placeholder="Enter Time">
                                </div>
                            </div>

                            <hr>
                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <h4 class="text-center">Availability</h4>
                                </div>

                                <div class="col-sm-6 ">
                                    <h4 class="text-center">Reliability</h4>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <span class="dot" id="system_availability">
                                            <div class="center-text h4" id="availability">0.00%</div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <span class="dot" id="system_reliability">
                                            <div class="center-text h4" id="reliability">0.00%</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="show_graphs" class="btn btn-primary btn-user btn-block">
                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                        Show Detail
                                    </button>
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body" id="sam_card" style="display: none">
        <div class="row">
            <div class="col-lg-12">

                <div class="card bg-custom3">
                    <div class="card-header bg-custom1">
                        <h1 class="h5 text-white">SAM (Surface to Air Missile)</h1>
                    </div>

                    <div class="card-body mx-5 bg-custom3">
                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="CCS_A">A</a> CCS <a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="CCS_R">R</a></div>

                        </div>

                        <div class="lines">
                            <div class="line_bottom"></div>
                            <div class="box_center" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="FC1_A">A</a>FC1<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="FC1_R">R</a></div>
                            <div class="line_middle"></div>
                            <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black;" id="SAM_A">A</a>SAM<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color:black" id="SAM_R">R</a></div>
                        </div>
                        <div class="lines">
                            <div class="line_top"></div>
                        </div>

                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color:black" id="S1_A">A</a>S1<a href="<?= base_url(); ?>HOD" style="float:right;color:black; font-size:small;" id="S1_R">R</a></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body" id="main_gun" style="display: none">
        <div class="row">
            <div class="col-lg-12">

                <div class="card bg-custom3">
                    <div class="card-header bg-custom1">
                        <h1 class="h5 text-white">Main Gun</h1>
                    </div>

                    <div class="card-body mx-5">
                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a>CCS<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="CCS_R">R</a></div>

                        </div>

                        <div class="lines">
                            <div class="line_bottom"></div>
                            <div class="box_center" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="FC2_A">A</a>FC2<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="FC2_R">R</a></div>
                            <div class="line_middle"></div>
                            <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="Main_Gun_A">A</a>Main Gun<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="Main_Gun_R">R</a></div>
                        </div>
                        <div class="lines">
                            <div class="line_top"></div>
                        </div>

                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="S1_A">A</a>S1<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="S1_R">R</a></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body" id="CRG_Port" style="display: none">
        <div class="row">
            <div class="col-lg-12">

                <div class="card bg-custom3">
                    <div class="card-header bg-custom1">
                        <h1 class="h5 text-white">CRG (Port)</h1>
                    </div>

                    <div class="card-body mx-5">
                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a>CCS<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="CCS_R">R</a></div>
                            <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="FC3_A">A</a>FC3<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black;" id="FC3_R">R</a></div>
                        </div>

                        <div class="lines">
                            <div class="line_bottom"></div>
                            <div class="line_bottom"></div>
                            <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CRG_(Port)_A">A</a>CRG (Port)<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="CRG_(Port)_R">R</a></div>
                        </div>

                        <div class="lines">
                            <div class="line_top"></div>
                            <div class="line_top"></div>

                        </div>

                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="S1_A">A</a>S1<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black" id="S1_R">R</a></div>
                            <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black;" id="FC4_A">A</a>FC4<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black;" id="FC4_R">R</a></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body" id="CRG_STDB" style="display: none">
        <div class="row">
            <div class="col-lg-12">

                <div class="card bg-custom3">
                    <div class="card-header bg-custom1">
                        <h1 class="h5 text-white">CRG (STDB)</h1>
                    </div>

                    <div class="card-body mx-5">
                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="CCS_A">A</a>CCS<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black ;" id="CCS_R">R</a></div>
                            <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="FC3_A">A</a>FC3<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="FC3_R">R</a></div>
                        </div>

                        <div class="lines">
                            <div class="line_bottom"></div>
                            <div class="line_bottom"></div>
                            <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small; color: black;" id="CRG_(STDB)_A">A</a>CRG(STDB)<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="CRG_(STDB)_R">R</a></div>
                        </div>

                        <div class="lines">
                            <div class="line_top"></div>
                            <div class="line_top"></div>

                        </div>

                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="S1_A">A</a>S1<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="S1_R">R</a></div>
                            <div class="box" style="background-color:#FA8072;color:white;"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="FC4_A">A</a>FC4<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="FC4_R">R</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body" id="SSM" style="display: none">
        <div class="row">
            <div class="col-lg-12">

                <div class="card bg-custom3">
                    <div class="card-header bg-custom1">
                        <h1 class="h5 text-white">SSM (Surface to Surface Missile)</h1>
                    </div>

                    <div class="card-body mx-5">
                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black" id="S1_A">A</a>S1<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black ;" id="S1_R">R</a></div>   
                        </div>

                        <div class="lines">
                            <div class="line_bottom"></div>
                            <div class="box_center" style="background-color:#4682B4;color:white"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small; color: black;" id="SSM_A">A</a>SSM<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="SSM_R">R</a></div>
                        </div>

                        <div class="lines">
                            <div class="line_top"></div>
                        </div>

                        <div>
                            <div class="box"><a href="<?= base_url(); ?>HOD" style="float:left; font-size:small;color: black; " id="S2_A">A</a>S2<a href="<?= base_url(); ?>HOD" style="float:right; font-size:small;color: black; " id="S2_R">R</a></div>
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
    $('#show_graphs').on('click', function() {
        $('#sam_card').hide();
        $('#main_gun').hide();
        $('#CRG_Port').hide();
        $('#CRG_STDB').hide();
        $('#SSM').hide();
        //$('#sam_card').hide();
        var name = $('#controller_type').val();
        
        if (name == 'SAM') {
            $('#sam_card').show();
        } else if (name == 'Main Gun') {
            $('#main_gun').show();
        } else if (name == 'CRG (Port)') {
            $('#CRG_Port').show();
        } else if (name == 'CRG (STDB)') {
            $('#CRG_STDB').show();
        } else if (name == 'SSM') {
            $('#SSM').show();
        }

        if (name != '') {
            $.ajax({
                url: '<?= base_url(); ?>WEO/get_sensors_data',
                method: 'POST',
                data: {
                    'weapon_name': name
                },
                success: function(data) {
                    result = JSON.parse(data);
                    for (var i in result) {
                        $str = result[i].Controller_Name.replace(" ", "_");
                        $("[id*='" + $str + "_A']").html(String(number_format((result[i].Availability) / 100, 2)));
                        $("[id*='" + $str + "_R']").html(String(number_format((result[i].Reliability) / 100, 2)));
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


    $('#controller_type').on('change', function() {
        //alert('df');
        $('#sam_card').hide();
        $('#main_gun').hide();
        $('#CRG_Port').hide();
        $('#CRG_STDB').hide();
        $('#SSM').hide();
        $('#reliability').html("0.00%");
        document.getElementById("system_reliability").style.backgroundColor = "#bbb";
        $('#system_time').val(null);

        var name = $(this).val();
        if (name != '') {
            $.ajax({
                url: '<?= base_url(); ?>WEO/get_system_availability',
                method: 'POST',
                data: {
                    'weapon_name': name
                },
                success: function(data) {
                    // var result = jQuery.parseJSON(data);
                    //alert(result);
                    $('#availability').html(data + "%");
                    if (data < 50) {
                        document.getElementById("system_availability").style.backgroundColor = "red";
                    } else if (data > 50 && data < 75) {
                        document.getElementById("system_availability").style.backgroundColor = "yellow";
                    } else if (data >= 75) {
                        document.getElementById("system_availability").style.backgroundColor = "green";
                    }
                }
                // ,
                // error: function(data) {
                //     //alert(data);
                //     alert('failure');
                // }
            });
        }
    });

    $('#system_time').on('focusout', function() {
        var name = $('#controller_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>WEO/get_system_reliability',
            method: 'POST',
            data: {
                'weapon_name': name,
                'time': time
            },
            success: function(data) {
                // var result = jQuery.parseJSON(data);
                //alert(result);
                $('#reliability').html(data + "%");
                if (data < 50) {
                    document.getElementById("system_reliability").style.backgroundColor = "red";
                } else if (data > 50 && data < 75) {
                    document.getElementById("system_reliability").style.backgroundColor = "yellow";
                } else if (data >= 75) {
                    document.getElementById("system_reliability").style.backgroundColor = "green";
                }
            },
            error: function(data) {
                //alert(data);
                alert('failure');
            }
        });

    });
</script>