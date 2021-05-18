<?php $this->load->view('co/common/header'); ?>
<?php !isset($weaponReliability1) ? $weaponReliability1 = 0 : $weaponReliability1; ?>
<?php !isset($weaponReliability2) ? $weaponReliability2 = 0 : $weaponReliability2; ?>
<?php !isset($reliability) ? $reliability = 0 : $reliability; ?>
<?php !isset($time_entered) ? $time_entered = null : $time_entered; ?>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
    .img {
        background: url('<?= base_url() ?>assets/img/ASW.jpg');
        background-position: center;
        background-size: cover;
    }
</style>
<div class="container">
    <!-- <h1 class="h4 text-gray-900">Welcome CO</h1> -->
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">Anit-Submarine Warfare Mission</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row">

                            <div class="col mx-1 my-1 img" style="height:300px">
                                <div style="margin-top:135px">

                                </div>
                            </div>

                        </div>
                        <!-- <h2>Page Under Construction!!</h2> -->
                        <div class="card">
                            <div class="card-header bg-custom1">
                                <h5 class="h5 text-white">Mission Statistics</h5>
                            </div>

                            <div class="card-body bg-custom3">
                                <div class="form-group row">
                                    <div class="col-sm-6 my-3">
                                        <h6 class="h6 text-grey-900">To check mission reliabiltiy. Please enter time: </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <form class="user" role="form" id="update_form" method="post" action="">
                                            <input type="text" class="form-control form-control-user" name="time" id="system_time" value = "<?php echo $time_entered ?>" placeholder="Enter Time">
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
                        </div>
                        <!-- Graphs -->
                        <div class="card">
                            <div class="card-body bg-custom3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div>
                                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                        </div>
                                        <?php
                                        $dataPoints = array(
                                            array("y" => $weapon1, "label" => "Torpedo"),
                                            array("y" => $weapon2, "label" => "RDC"),
                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-6" id="reliability_chart">
                                        <div>
                                            <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                        </div>
                                        <?php
                                        $dataPoints1 = array(
                                            array("y" => $weaponReliability1, "label" => "Torpedo"),
                                            array("y" => $weaponReliability2, "label" => "RDC"),
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
            url: '<?= base_url(); ?>Mission/get_mission_reliability',
            method: 'POST',
            data: {
                'mission_name': 'ASW',
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
                'mission_name': 'ASW'
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
                'page_name': 'ASW',
                'wr1': dps[0],
                'wr2': dps[1],
                'wp1': <?php echo json_encode($weapon1, JSON_NUMERIC_CHECK); ?>,
                'wp2': <?php echo json_encode($weapon2, JSON_NUMERIC_CHECK); ?>,
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
</script>