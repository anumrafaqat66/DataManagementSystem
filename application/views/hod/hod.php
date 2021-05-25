<?php $this->load->view('hod/common/header'); ?>
<style>
    .dot {
        height: 75px;
        width: 75px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }

    .center-text {
        margin-top: 25px;
        font-weight: bold;
        color: black;
    }
</style>

<div class="container bg-custom2">
    <h1 class="h4 text-gray-900">Welcome HOD</h1>
    <hr>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-custom1">
                        <div class="row">
                            <div class="col-sm-7">
                                <h1 class="h4 text-white">Sensor Detail</h1>
                            </div>
                            <!-- <div class="col-sm-3">
                                <h1 class="h4 text-white">Availability</h1>
                            </div>
                            <div class="col-sm-2">
                                <h1 class="h4 text-white">Reliability</h1>
                            </div> -->
                        </div>
                    </div>

                    <div class="card-body bg-custom3">

                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <!--<div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="sensor_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Sensor</option>
                                        <?php //if (isset($sensor_data)) {
                                        //foreach ($sensor_data as $data) { 
                                        ?>
                                                <option class="form-control form-control-user" value="<?= $data['ID']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php //}
                                        //}  
                                        ?>
                                    </select>
                                </div> -->
                                <div class="col-sm-6 my-3">
                                    <h6> To check the Sensor reliability, please enter the time: </h6>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-user" name="time" id="sensor_time" placeholder="Enter Time">
                                </div>
                                <!-- <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="s_availability">
                                            <div class="center-text" id="sensor_availability">0.00%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="s_reliability">
                                            <div class="center-text" id="sensor_reliability">0.00%</div>
                                        </span>
                                    </div>
                                </div> -->


                            </div>
                            <div id="table_div">
                                <?php if (isset($sensor_data)) {
                                    if (count($sensor_data) > 0) { ?>

                                        <table id="datatable" class="table table-sm table-striped bg-custom3">
                                            <thead>
                                                <tr>
                                                    <th scope="col-3">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Availability</th>
                                                    <th scope="col">Default Reliability (30 Days)</th>
                                                    <th scope="col">Reliability</th>

                                                </tr>
                                            </thead>
                                            <tbody id="table_rows_sensor">
                                                <?php $count = 0;
                                                foreach ($sensor_data as $data) { ?>
                                                    <tr>
                                                        <td scope="row"><?= ++$count; ?></td>
                                                        <td scope="row" id="sensor_name<?= $count; ?>"><?= $data['Controller_Name']; ?></td>
                                                        <td scope="row"><?= $data['Availability']; ?></td>
                                                        <td scope="row" id="rel_sensor_def<?= $count; ?>"><?= $data['Default_Reliability']; ?></td>
                                                        <td scope="row" id="rel_sensor<?= $count; ?>"><?= $data['Reliability']; ?></td>
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">Fire Controller Detail</h1>
                    </div>

                    <div class="card-body bg-custom3">

                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <!-- <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="fire_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Fire Controller</option>
                                        <?php //if (isset($fire_controller_data)) {
                                        //foreach ($fire_controller_data as $data) { 
                                        ?>
                                                <option class="form-control form-control-user" value="<?= $data['ID']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php //}
                                        //}  
                                        ?>
                                    </select>
                                </div> -->
                                <div class="col-sm-6 my-3">
                                    <h6> To check the Fire Controller reliability, please enter the time: </h6>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-user" name="time" id="fire_time" placeholder="Enter Time">
                                </div>
                                <!-- <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="f_availability">
                                            <div class="center-text" id="fire_availability">0.00%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="f_reliability">
                                            <div class="center-text" id="fire_reliability">0.00%</div>
                                        </span>
                                    </div>
                                </div> -->
                            </div>

                            <div id="table_div">
                                <?php if (isset($fire_controller_data)) {
                                    if (count($fire_controller_data) > 0) { ?>

                                        <table id="datatable" class="table table-sm table-striped bg-custom3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Availability</th>
                                                    <th scope="col">Default Reliability (30 Days)</th>
                                                    <th scope="col">Reliability</th>

                                                </tr>
                                            </thead>
                                            <tbody id="table_rows_fire">
                                                <?php $count = 0;
                                                foreach ($fire_controller_data as $data) { ?>
                                                    <tr>
                                                        <td scope="row"><?= ++$count; ?></td>
                                                        <td scope="row" id="fire_name<?= $count; ?>"><?= $data['Controller_Name']; ?></td>
                                                        <td scope="row"><?= $data['Availability']; ?></td>
                                                        <td scope="row" id="rel_fire_def<?= $count; ?>"><?= $data['Default_Reliability']; ?></td>
                                                        <td scope="row" id="rel_fire<?= $count; ?>"><?= $data['Reliability']; ?></td>
                                                        <!-- <td>
                                                        <a class="btn btn-primary rounded-pill text-sm" href="<?= base_url(); ?>manager/Update_data/<?= $data['id']; ?>">Update Record</a>
                                                        </td> -->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="card-header">
                                            <h1 class="h4 text-gray-900">No record available</h1>
                                        </div>
                                    <?php }
                                    unset($fire_controller_data);
                                    // unset($data['controller_detail_records']);
                                } else { ?>
                                    <a> No Record Available. </a>
                                <?php  } ?>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">Weapon Detail</h1>
                    </div>

                    <div class="card-body bg-custom3">

                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <!-- <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="weapon_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Weapon</option>
                                        <? //php if (isset($weapon_data)) {
                                        //foreach ($weapon_data as $data) { 
                                        ?>
                                                <option class="form-control form-control-user" value="<?= $data['ID']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php //}
                                        //}  
                                        ?>
                                    </select>
                                </div> -->
                                <div class="col-sm-6 my-3">
                                    <h6> To check the Weapon reliability, please enter the time: </h6>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-user" name="time" id="weapon_time" placeholder="Enter Time">
                                </div>

                                <!-- <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="w_availability">
                                            <div class="center-text" id="weapon_availability">0.00%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="w_reliability">
                                            <div class="center-text" id="weapon_reliability">0.00%</div>
                                        </span>
                                    </div>
                                </div> -->

                            </div>

                            <div id="table_div">
                                <?php if (isset($weapon_data)) {
                                    if (count($weapon_data) > 0) { ?>

                                        <table id="datatable" class="table table-sm table-striped bg-custom3">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Availability</th>
                                                    <th scope="col">Default Reliability (30 Days)</th>
                                                    <th scope="col">Reliability</th>

                                                </tr>
                                            </thead>
                                            <tbody id="table_rows_weapon">
                                                <?php $count = 0;
                                                foreach ($weapon_data as $data) { ?>
                                                    <tr>
                                                        <td scope="row"><?= ++$count; ?></td>
                                                        <td scope="row" id="weapon_name<?= $count; ?>"><?= $data['Controller_Name']; ?></td>
                                                        <td scope="row"><?= $data['Availability']; ?></td>
                                                        <td scope="row" id="rel_weapon_def<?= $count; ?>"><?= $data['Default_Reliability']; ?></td>
                                                        <td scope="row" id="rel_weapon<?= $count; ?>"><?= $data['Reliability']; ?></td>
                                                        <!-- <td>
                                                        <a class="btn btn-primary rounded-pill text-sm" href="<?= base_url(); ?>manager/Update_data/<?= $data['id']; ?>">Update Record</a>
                                                        </td> -->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="card-header">
                                            <h1 class="h4 text-gray-900">No record available</h1>
                                        </div>
                                    <?php }
                                    unset($weapon_data);
                                    // unset($data['controller_detail_records']);
                                } else { ?>
                                    <a> No Record Available. </a>
                                <?php  } ?>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php $this->load->view('common/footer'); ?>
<script>
    window.onload = function() {

        $count_sensor = 1;
        $('#table_rows_sensor > tr').each(function(index, td) {
            var rel = document.getElementById("rel_sensor" + $count_sensor);
            rel.innerHTML = "0.00";
            $count_sensor++;
        });

        $count_fire = 1;
        $('#table_rows_fire > tr').each(function(index, td) {
            var rel = document.getElementById("rel_fire" + $count_fire);
            rel.innerHTML = "0.00";
            $count_fire++;
        });

        $count_weapon = 1;
        $('#table_rows_weapon > tr').each(function(index, td) {
            var rel = document.getElementById("rel_weapon" + $count_weapon);
            rel.innerHTML = "0.00";
            $count_weapon++;
        });


        $.ajax({
            url: '<?= base_url(); ?>HOD/get_availability_for_all',
            method: 'POST',
            success: function(data) {},
            async: false
            // ,
            // error: function(data) {
            //     //alert(data);
            //     alert('failure');
            // }
        });


        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability_for_all',
            method: 'POST',
            data: {
                //'weapon_name': name,
                'isDefault': 'Yes'
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);
                var loop_sensor = 1;
                var loop_fire = 1;
                var loop_weapon = 1;

                for (var i in result) {

                    if (result[i].Controller_type == "Sensor") {
                        var sn = document.getElementById("sensor_name" + loop_sensor);
                        if (sn.innerHTML == result[i].Controller_Name) {
                            var rel = document.getElementById("rel_sensor_def" + loop_sensor);
                            rel.innerHTML = result[i].Default_Reliability;
                            console.log(rel);
                        }
                        loop_sensor++;
                    }
                    if (result[i].Controller_type == "Fire Controller") {
                        var fn = document.getElementById("fire_name" + loop_fire);
                        if (fn.innerHTML == result[i].Controller_Name) {
                            var rel = document.getElementById("rel_fire_def" + loop_fire);
                            rel.innerHTML = result[i].Default_Reliability;
                            console.log(rel);
                        }
                        loop_fire++;
                    }
                    if (result[i].Controller_type == "Weapon") {
                        var wn = document.getElementById("weapon_name" + loop_weapon);
                        if (wn.innerHTML == result[i].Controller_Name) {
                            var rel = document.getElementById("rel_weapon_def" + loop_weapon);
                            rel.innerHTML = result[i].Default_Reliability;
                        }
                        loop_weapon++;
                    }

                }
            },
            async: false,
            error: function(data) {
                //alert(data);
                alert('failure');
            }
        });



    }

    // $('#sensor_type').on('change', function() {
    //     var id = $(this).val();
    //     $('#sensor_reliability').html("0.00%");
    //     document.getElementById("s_reliability").style.backgroundColor = "#bbb";
    //     $('#sensor_time').val(null);


    //     $.ajax({
    //         url: '<?= base_url(); ?>HOD/get_availability',
    //         method: 'POST',
    //         data: {
    //             'controller_id': id
    //         },
    //         success: function(data) {
    //             $('#sensor_availability').html(data + "%");
    //             if (data < 50) {
    //                 document.getElementById("s_availability").style.backgroundColor = "red";
    //             } else if (data > 50 && data < 75) {
    //                 document.getElementById("s_availability").style.backgroundColor = "yellow";
    //             } else if (data >= 75) {
    //                 document.getElementById("s_availability").style.backgroundColor = "green";
    //             }
    //         },
    //         error: function(data) {
    //             alert('failure');
    //         }
    //     });
    //     e.preventDefault();
    //     window.onunload = function() {
    //         dubugger;
    //     }
    // });

    // $('#fire_type').on('change', function() {
    //     var id = $(this).val();
    //     $('#fire_reliability').html("0.00%");
    //     document.getElementById("f_reliability").style.backgroundColor = "#bbb";
    //     $('#fire_time').val(null);

    //     $.ajax({
    //         url: '<?= base_url(); ?>HOD/get_availability',
    //         method: 'POST',
    //         data: {
    //             'controller_id': id
    //         },
    //         success: function(data) {
    //             $('#fire_availability').html(data + "%");
    //             if (data < 50) {
    //                 document.getElementById("f_availability").style.backgroundColor = "red";
    //             } else if (data > 50 && data < 75) {
    //                 document.getElementById("f_availability").style.backgroundColor = "yellow";
    //             } else if (data > 75) {
    //                 document.getElementById("f_availability").style.backgroundColor = "green";
    //             }
    //         },
    //         error: function(data) {
    //             alert('failure');
    //         }
    //     });
    //     e.preventDefault();
    //     window.onunload = function() {
    //         dubugger;
    //     }
    // });

    // $('#weapon_type').on('change', function() {
    //     var id = $(this).val();
    //     $('#weapon_reliability').html("0.00%");
    //     document.getElementById("w_reliability").style.backgroundColor = "#bbb";
    //     $('#weapon_time').val(null);

    //     $.ajax({
    //         url: '<?= base_url(); ?>HOD/get_availability',
    //         method: 'POST',
    //         data: {
    //             'controller_id': id
    //         },
    //         success: function(data) {
    //             $('#weapon_availability').html(data + "%");
    //             if (data < 50) {
    //                 document.getElementById("w_availability").style.backgroundColor = "red";
    //             } else if (data > 50 && data < 75) {
    //                 document.getElementById("w_availability").style.backgroundColor = "yellow";
    //             } else if (data >= 75) {
    //                 document.getElementById("w_availability").style.backgroundColor = "green";
    //             }
    //         },
    //         error: function(data) {
    //             alert('failure');
    //         }
    //     });
    //     //  e.preventDefault();
    //     window.onunload = function() {
    //         dubugger;
    //     }
    // });

    $('#sensor_time').on('focusout', function() {
        var id = $('#sensor_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability_for_all',
            method: 'POST',
            data: {
                'time': time,
                'isDefault': 'No'
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);
                var loop_sensor = 1;
                // var loop_fire = 1;
                // var loop_weapon = 1;

                for (var i in result) {

                    if (result[i].Controller_type == "Sensor") {
                        var sn = document.getElementById("sensor_name" + loop_sensor);
                        if (sn.innerHTML == result[i].Controller_Name) {
                            var rel = document.getElementById("rel_sensor" + loop_sensor);
                            rel.innerHTML = result[i].Reliability;
                            console.log(rel);
                        }
                        loop_sensor++;
                    }
                    // if (result[i].Controller_type == "Fire Controller") {
                    //     var fn = document.getElementById("fire_name" + loop_fire);
                    //     if (fn.innerHTML == result[i].Controller_Name) {
                    //         var rel = document.getElementById("rel_fire" + loop_fire);
                    //         rel.innerHTML = result[i].Reliability;
                    //         console.log(rel);
                    //     }
                    //     loop_fire++;
                    // }
                    // if (result[i].Controller_type == "Weapon") {
                    //     var wn = document.getElementById("weapon_name" + loop_weapon);
                    //     if (wn.innerHTML == result[i].Controller_Name) {
                    //         var rel = document.getElementById("rel_weapon" + loop_weapon);
                    //         rel.innerHTML = result[i].Reliability;
                    //     }
                    //     loop_weapon++;
                    // }

                }
            },
            error: function(data) {
                //alert(data);
                alert('failure');
            }
        });

    });

    $('#fire_time').on('focusout', function() {
        var id = $('#fire_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability_for_all',
            method: 'POST',
            data: {
                'time': time,
                'isDefault': 'No'
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);
               // var loop_sensor = 1;
                var loop_fire = 1;
                //var loop_weapon = 1;

                for (var i in result) {

                    // if (result[i].Controller_type == "Sensor") {
                    //     var sn = document.getElementById("sensor_name" + loop_sensor);
                    //     if (sn.innerHTML == result[i].Controller_Name) {
                    //         var rel = document.getElementById("rel_sensor" + loop_sensor);
                    //         rel.innerHTML = result[i].Reliability;
                    //         console.log(rel);
                    //     }
                    //     loop_sensor++;
                    // }
                    if (result[i].Controller_type == "Fire Controller") {
                        var fn = document.getElementById("fire_name" + loop_fire);
                        if (fn.innerHTML == result[i].Controller_Name) {
                            var rel = document.getElementById("rel_fire" + loop_fire);
                            rel.innerHTML = result[i].Reliability;
                            console.log(rel);
                        }
                        loop_fire++;
                    }
                    // if (result[i].Controller_type == "Weapon") {
                    //     var wn = document.getElementById("weapon_name" + loop_weapon);
                    //     if (wn.innerHTML == result[i].Controller_Name) {
                    //         var rel = document.getElementById("rel_weapon" + loop_weapon);
                    //         rel.innerHTML = result[i].Reliability;
                    //     }
                    //     loop_weapon++;
                    // }

                }
            },
            error: function(data) {
                //alert(data);
                alert('failure');
            }
        });

    });

    $('#weapon_time').on('focusout', function() {
        var id = $('#weapon_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability_for_all',
            method: 'POST',
            data: {
                'time': time,
                'isDefault': 'No'
            },
            success: function(data) {
                var result = jQuery.parseJSON(data);
                // var loop_sensor = 1;
                // var loop_fire = 1;
                var loop_weapon = 1;

                for (var i in result) {

                    // if (result[i].Controller_type == "Sensor") {
                    //     var sn = document.getElementById("sensor_name" + loop_sensor);
                    //     if (sn.innerHTML == result[i].Controller_Name) {
                    //         var rel = document.getElementById("rel_sensor" + loop_sensor);
                    //         rel.innerHTML = result[i].Reliability;
                    //         console.log(rel);
                    //     }
                    //     loop_sensor++;
                    // }
                    // if (result[i].Controller_type == "Fire Controller") {
                    //     var fn = document.getElementById("fire_name" + loop_fire);
                    //     if (fn.innerHTML == result[i].Controller_Name) {
                    //         var rel = document.getElementById("rel_fire" + loop_fire);
                    //         rel.innerHTML = result[i].Reliability;
                    //         console.log(rel);
                    //     }
                    //     loop_fire++;
                    // }
                    if (result[i].Controller_type == "Weapon") {
                        var wn = document.getElementById("weapon_name" + loop_weapon);
                        if (wn.innerHTML == result[i].Controller_Name) {
                            var rel = document.getElementById("rel_weapon" + loop_weapon);
                            rel.innerHTML = result[i].Reliability;
                        }
                        loop_weapon++;
                    }

                }
            },
            error: function(data) {
                //alert(data);
                alert('failure');
            }
        });

    });
</script>