<?php $this->load->view('co/common/header'); ?>
<?php !isset($MissionReliability1) ? $MissionReliability1 = 0 : $MissionReliability1; ?>
<?php !isset($MissionReliability2) ? $MissionReliability2 = 0 : $MissionReliability2; ?>
<?php !isset($MissionReliability3) ? $MissionReliability3 = 0 : $MissionReliability3; ?>
<?php !isset($MissionReliability4) ? $MissionReliability4 = 0 : $MissionReliability4; ?>
<?php !isset($reliability) ? $reliability = 0 : $reliability; ?>
<?php !isset($time_entered) ? $time_entered = null : $time_entered; ?>
<?php !isset($button_clicked) ? $button_clicked = null : $button_clicked; ?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
    .img-ship {
        background: url('<?= base_url() ?>assets/img/ship.jpg');
        background-position: center;
        background-size: cover;
        height: 250px;
    }

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
    <!-- <h1 class="h4 text-gray-900">Welcome Commanding Officer!</h1> -->
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">Mission</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row">
                            <a class="col mx-1 my-1 img-ship" href="<?= base_url(); ?>CO/mission">
                                <div style="height:180px">
                                    <div style="margin-top:135px">
                                        <h1 class="h1 text-dark text-center "><strong></strong></h1>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- <div class="form-group row justify-content-center my-3">
                            <div class="col-md-6">
                                <a class="btn btn-primary rounded-pill btn-user btn-block" id="show_ship_detail"> Show Complete Ship Missions Detail</a>
                            </div>
                        </div> -->

                        <div class="card card-body bg-custom3" id='ship_detail'>

                            <div class="card">
                                <div class="card-header bg-custom1">
                                    <h5 class="h5 text-white">Complete Ship Missions Statistics</h5>
                                </div>

                                <div class="card-body bg-custom3">
                                    <div class="form-group row">
                                        <div class="col-sm-6 my-3">
                                            <h6 class="h6 text-grey-900">To check complete ship reliabiltiy. Please enter time: </h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <form class="user" role="form" id="update_form" method="post" action="">
                                                <input type="text" class="form-control form-control-user" name="time" id="system_time" value="<?php echo $time_entered ?>" placeholder="Enter Time">
                                            </form>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
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
                                </div>

                                <!-- Graphs -->
                                <div class="card">

                                    <div class="card-body bg-custom3">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <!-- <h3 class="text-grey-900">Availability</h3> -->
                                                <div>
                                                    <div id="chartContainer" style="height: 370px; width:100%;"></div>
                                                </div>
                                                <?php
                                                $dataPoints = array(
                                                    array("y" => $mission1, "label" => "AAW"),
                                                    array("y" => $mission2, "label" => "ASuW"),
                                                    array("y" => $mission3, "label" => "ASW"),
                                                    array("y" => $mission4, "label" => "EW"),

                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6" id="reliability_chart">
                                                <!-- <h3 class="text-grey-900">Relaibility</h3> -->
                                                <div>
                                                    <div id="chartContainer1" style="height: 370px;width:100%;"></div>
                                                </div>
                                                <?php
                                                $dataPoints1 = array(
                                                    array("y" => $MissionReliability1, "label" => "AAW"),
                                                    array("y" => $MissionReliability2, "label" => "ASuW"),
                                                    array("y" => $MissionReliability3, "label" => "ASW"),
                                                    array("y" => $MissionReliability4, "label" => "EW"),
                                                );
                                                ?>
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

</div>

<?php $this->load->view('common/footer'); ?>

<script>
    $('#show_ship_detail').on('click', function() {
        $('#ship_detail').show();
    });

    window.onload = function() {

        $t = $("#system_time").val();
        if ($t > 0) {
            $('#ship_detail').show();
        }


        $data = $("#availability_bar").html();
        $value = $data.substr(0, $data.length - 1);

        if ($value < 50) {
            $("#availability_bar").addClass('bg-danger');
        } else if ($value >= 50 && $value <= 75) {
            $("#availability_bar").addClass('bg-warning');
        } else if ($value > 75) {
            $("#availability_bar").addClass('bg-success');
        }

        $data = $("#reliability_bar").html();
        $value_rel = $data.substr(0, $data.length - 1);
        // alert($value);
        if ($value_rel < 50) {
            $("#reliability_bar").addClass('bg-danger');
        } else if ($value_rel >= 50 && $value_rel <= 75) {
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
                includeZero: true
            },
            data: [{
                type: "column", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();


        var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: ""
            },
            axisY: {
                includeZero: true
            },
            data: [{
                type: "bar", //change type to bar, line, area, pie, etc
                //indexLabel: "{y}", //Shows y value on all Data Points
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }

    var dps = []; //Global
    var reliability;
    var enteredTime;

    $('#system_time').on('focusout', function() {

        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>CO/get_complete_ship_reliability',
            method: 'POST',
            data: {
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
            url: '<?= base_url(); ?>CO/get_each_mission_reliability',
            method: 'POST',
            success: function(data) {
                result = JSON.parse(data);

                for (var i in result) {
                    dps.push(result[i]);
                }
            },
            async: false
        });

        $.ajax({
            url: '<?= base_url(); ?>CO/PageReload',
            method: 'POST',
            data: {
                'wr1': dps[0],
                'wr2': dps[1],
                'wr3': dps[2],
                'wr4': dps[3],
                'wp1': <?php echo json_encode($mission1, JSON_NUMERIC_CHECK); ?>,
                'wp2': <?php echo json_encode($mission2, JSON_NUMERIC_CHECK); ?>,
                'wp3': <?php echo json_encode($mission3, JSON_NUMERIC_CHECK); ?>,
                'wp4': <?php echo json_encode($mission4, JSON_NUMERIC_CHECK); ?>,
                'avail': <?php echo json_encode($availability, JSON_NUMERIC_CHECK); ?>,
                'rel': reliability,
                'time': enteredTime,
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
</script>