<?php $this->load->view('common/header'); ?>
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
        border: 1px solid black;
        padding: 10px 0px;
        margin: 0px 25px;
        width: 140px;
        text-align: center;
    }

    .box_center {
        display: inline-block;
        border: 1px solid black;
        padding: 10px 0px;
        margin-left: -5px;
        width: 140px;
        text-align: center;
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
    <h1 class="h4 text-gray-900">Welcome CEO</h1>
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">Missions</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row">
                            <div class="col mx-1 my-1 img-aaw" style="height:300px">
                                <div style="margin-top:135px">
                                    <h1 class="h1 text-dark text-center "><strong>AAW</strong></h1>
                                </div>
                            </div>

                            <div class="col mx-1 my-1 img-asuw" style="height:300px">
                                <div style="margin-top:135px">
                                    <h1 class="h1 text-info text-center "><strong>ASuW</strong></h1>
                                </div>
                            </div>
                            <!-- <div class="w-100"></div> -->
                            <div class="col mx-1 my-1 img-asw" style="height:300px">
                                <div style="margin-top:135px">
                                    <h1 class="h1 text-white text-center "><strong>ASW</strong></h1>
                                </div>
                            </div>
                            <div class="col mx-1 my-1 img-ew" style="height:300px">
                                <div style="margin-top:135px">
                                    <h1 class="h1 text-white text-center "><strong>EW</strong></h1>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header bg-custom1">
                                <h5 class="h5 text-white">Detail</h5>
                            </div>

                            <div class="card-body bg-custom3">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="h6 text-grey-900">Availability</h5>
                                        <div class="progress" style="height:40px">
                                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 70%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <h5 class="h6 text-grey-900">Reliability</h5>
                                        <div class="progress" style="height:40px">
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        //$('#sam_card').hide();
        var name = $('#controller_type').val();
        //alert(name);
        if (name == 'SAM') {
            $('#sam_card').show();
        } else if (name == 'Main Gun') {
            $('#main_gun').show();
        } else if (name == 'CRG (Port)') {
            $('#CRG_Port').show();
        } else if (name == 'CRG (STDB)') {
            $('#CRG_STDB').show();
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

        $.ajax({
            url: '<?= base_url(); ?>WEO/get_system_reliability',
            method: 'POST',
            data: {
                'weapon_name': name
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