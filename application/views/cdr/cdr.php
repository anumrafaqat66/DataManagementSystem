<?php $this->load->view('cdr/common/header'); ?>
<?php !isset($MissionReliability1) ? $MissionReliability1 = 0 : $MissionReliability1; ?>
<?php !isset($MissionReliability2) ? $MissionReliability2 = 0 : $MissionReliability2; ?>
<?php !isset($MissionReliability3) ? $MissionReliability3 = 0 : $MissionReliability3; ?>
<?php !isset($MissionReliability4) ? $MissionReliability4 = 0 : $MissionReliability4; ?>
<?php !isset($reliability) ? $reliability = 0 : $reliability; ?>
<?php !isset($time_entered) ? $time_entered = null : $time_entered; ?>
<?php !isset($button_clicked) ? $button_clicked = null : $button_clicked; ?>

<script src="<?= base_url(); ?>assets/js/canvasjs.min.js"></script>
<style>
    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 0.75rem;
        padding-bottom: 0px;
    }

    .img-ship {
        background: url('<?= base_url() ?>assets/img/ship3.jpg');
        background-position: center;
        background-size: cover;
        height: 250px;
    }

    .img-ship2 {
        background: url('<?= base_url() ?>assets/img/ship1.jpg');
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
                        <h1 class="h4 text-white">Welcome, Type Commander!</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row">
                            <a class="col mx-1 my-1 img-ship" href="<?= base_url(); ?>Cdr/co/<?= 'Ship1' ?>" style="height: 180px">
                                <div style="height:100px">
                                    <div style="margin-top:50px">
                                        <h1 class="h1 text-dark text-center "><strong>Ship 1</strong></h1>
                                        <!-- <h2 class="h2 text-dark text-center "><strong><?php echo $mission1 ?></strong></h2> -->
                                    </div>
                                </div>
                            </a>
                            <a class="col mx-1 my-1 img-ship2" href="<?= base_url(); ?>Cdr/co/<?= 'Ship2' ?>" style="height: 180px">
                                <div style="height:100px">
                                    <div style="margin-top:50px">
                                        <h1 class="h1 text-dark text-center "><strong>Ship 2</strong></h1>
                                        <!-- <h2 class="h2 text-dark text-center "><strong><?php echo $mission2 ?></strong></h2> -->
                                    </div>
                                </div>
                            </a>
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

        function onClick(e) {
            //alert(e.dataSeries.type + ", dataPoint { x:" + e.dataPoint.x + ", y: " + e.dataPoint.y + " }");
            if (e.dataPoint.x == 0) {
                window.location.href = "<?= base_url(); ?>mission/mission/AAW";
            } else if (e.dataPoint.x == 1) {
                window.location.href = "<?= base_url(); ?>mission/mission/ASuW";
            } else if (e.dataPoint.x == 2) {
                window.location.href = "<?= base_url(); ?>mission/mission/ASW";
            } else if (e.dataPoint.x == 3) {
                window.location.href = "<?= base_url(); ?>mission/mission/EW";
            }
        }

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

    $('#Ship_name').on('change', function() {
       // alert('sds');
        var a = $(this).val();
        if ($(this).val() == 'ShipA') {
            window.location.href = "<?= base_url(); ?>Cdr/co/ShipA";
        } else if ($(this).val() == 'ShipB') {
            window.location.href = "<?= base_url(); ?>Cdr/co/ShipB";
        } 
    });
</script>