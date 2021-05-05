<?php $this->load->view('common/header'); ?>
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

<div class="container">
    <h1 class="h4 text-gray-900">Welcome HOD</h1>
    <hr>

    <div class="card-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-7">
                                <h1 class="h4 text-gray-900">Sensor Detail</h1>
                            </div>
                            <div class="col-sm-3">
                                <h1 class="h4 text-gray-900">Availability</h1>
                            </div>
                            <div class="col-sm-2">
                                <h1 class="h4 text-gray-900">Reliability</h1>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="sensor_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Sensor</option>
                                        <?php if (isset($sensor_data)) {
                                            foreach ($sensor_data as $data) { ?>
                                                <option class="form-control form-control-user" value="<?= $data['ID']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php }
                                        }  ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="sensor_time" placeholder="Enter Time">
                                </div>
                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="s_availability">
                                            <div class="center-text" id="sensor_availability">0%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="s_reliability">
                                            <div class="center-text" id="sensor_reliability">0%</div>
                                        </span>
                                    </div>
                                </div>
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
                    <div class="card-header">
                        <h1 class="h4 text-gray-900">Fire Controller Detail</h1>
                    </div>

                    <div class="card-body">
                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="fire_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Fire Controller</option>
                                        <?php if (isset($fire_controller_data)) {
                                            foreach ($fire_controller_data as $data) { ?>
                                                <option class="form-control form-control-user" value="<?= $data['ID']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php }
                                        }  ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="fire_time" placeholder="Enter Time">
                                </div>
                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="f_availability">
                                            <div class="center-text" id="fire_availability">0%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="f_reliability">
                                            <div class="center-text" id="fire_reliability">0%</div>
                                        </span>
                                    </div>
                                </div>
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
                    <div class="card-header">
                        <h1 class="h4 text-gray-900">Weapon Detail</h1>
                    </div>

                    <div class="card-body">
                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <div class="col-sm-3 mb-1">
                                    <select class="form-control rounded-pill" name="controller_type" id="weapon_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Weapon</option>
                                        <?php if (isset($weapon_data)) {
                                            foreach ($weapon_data as $data) { ?>
                                                <option class="form-control form-control-user" value="<?= $data['ID']; ?>"><?= $data['Controller_Name']; ?></option>
                                        <?php }
                                        }  ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="weapon_time" placeholder="Enter Time">
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="w_availability">
                                            <div class="center-text" id="weapon_availability">0%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot" id="w_reliability">
                                            <div class="center-text" id="weapon_reliability">0%</div>
                                        </span>
                                    </div>
                                </div>

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
    $('#sensor_type').on('change', function() {
        var id = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_availability',
            method: 'POST',
            data: {
                'controller_id': id
            },
            success: function(data) {
                 $('#sensor_availability').html(data + "%");
                if(data<50){
                document.getElementById("s_availability").style.backgroundColor  = "red"; 
            }else if(data > 50 && data < 75){
                 document.getElementById("s_availability").style.backgroundColor  = "yellow";
            }else if(data>75){
                 document.getElementById("s_availability").style.backgroundColor  = "green";
            }
            },
            error: function(data) {
                alert('failure');
            }
        });
        e.preventDefault();
        window.onunload = function() {
            dubugger;
        }
    });

    $('#fire_type').on('change', function() {
        var id = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_availability',
            method: 'POST',
            data: {
                'controller_id': id
            },
            success: function(data) {
                $('#fire_availability').html(data + "%");
                  if(data<50){
                document.getElementById("f_availability").style.backgroundColor  = "red"; 
            }else if(data > 50 && data < 75){
                 document.getElementById("f_availability").style.backgroundColor  = "yellow";
            }else if(data>75){
                 document.getElementById("f_availability").style.backgroundColor  = "green";
            }
            },
            error: function(data) {
                alert('failure');
            }
        });
        e.preventDefault();
        window.onunload = function() {
            dubugger;
        }
    });

    $('#weapon_type').on('change', function() {
        var id = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_availability',
            method: 'POST',
            data: {
                'controller_id': id
            },
            success: function(data) {
                $('#weapon_availability').html(data + "%");
                           if(data<50){
                document.getElementById("w_availability").style.backgroundColor  = "red"; 
            }else if(data > 50 && data < 75){
                 document.getElementById("w_availability").style.backgroundColor  = "yellow";
            }else if(data>75){
                 document.getElementById("w_availability").style.backgroundColor  = "green";
            }
            },
            error: function(data) {
                alert('failure');
            }
        });
      //  e.preventDefault();
        window.onunload = function() {
            dubugger;
        }
    });

    $('#sensor_time').on('focusout', function() {
        var id = $('#sensor_type').val();
        var time = $(this).val();



        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability',
            method: 'POST',
            data: {
                'controller_id': id,
                'time': time
            },
            success: function(data) {
                $('#sensor_reliability').html(data + "%");
                                  if(data<50){
                document.getElementById("s_reliability").style.backgroundColor  = "red"; 
            }else if(data > 50 && data < 75){
                 document.getElementById("s_reliability").style.backgroundColor  = "yellow";
            }else if(data>75){
                 document.getElementById("s_reliability").style.backgroundColor  = "green";
            }
            },
            error: function(data) {
                alert('failure');
            }
        });
     //   e.preventDefault();
        window.onunload = function() {
            dubugger;
        }

    });

    $('#fire_time').on('focusout', function() {
        var id = $('#fire_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability',
            method: 'POST',
            data: {
                'controller_id': id,
                'time': time
            },
            success: function(data) {
                $('#fire_reliability').html(data + "%");
                if(data<50){
                document.getElementById("f_reliability").style.backgroundColor  = "red"; 
            }else if(data > 50 && data < 75){
                 document.getElementById("f_reliability").style.backgroundColor  = "yellow";
            }else if(data>75){
                 document.getElementById("f_reliability").style.backgroundColor  = "green";
            }
            },
            error: function(data) {
                alert('failure');
            }
        });
     //   e.preventDefault();
        window.onunload = function() {
            dubugger;
        }

    });

    $('#weapon_time').on('focusout', function() {
        var id = $('#weapon_type').val();
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>HOD/get_reliability',
            method: 'POST',
            data: {
                'controller_id': id,
                'time': time
            },
            success: function(data) {
                $('#weapon_reliability').html(data + "%");
                       if(data<50){
                document.getElementById("w_reliability").style.backgroundColor  = "red"; 
            }else if(data > 50 && data < 75){
                 document.getElementById("w_reliability").style.backgroundColor  = "yellow";
            }else if(data>75){
                 document.getElementById("w_reliability").style.backgroundColor  = "green";
            }
            },
            error: function(data) {
                alert('failure');
            }
        });
        //e.preventDefault();
        window.onunload = function() {
            dubugger;
        }

    });

</script>