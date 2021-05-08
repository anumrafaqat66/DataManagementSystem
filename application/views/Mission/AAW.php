<?php $this->load->view('common/header'); ?>
<?php $weaponReliability1 = 1; ?>
<?php $weaponReliability2 = 1; ?>
<?php $weaponReliability3 = 1; ?>
<?php $weaponReliability4 = 1; ?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
    .img {
        background: url('<?= base_url() ?>assets/img/AAW.jpg');
        background-position: center;
        background-size: cover;
    }
</style>
<div class="container">
    <h1 class="h4 text-gray-900">Welcome CO</h1>
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">AAW Mission</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row">

                            <div class="col mx-1 my-1 img" style="height:300px">
                                <div style="margin-top:135px">

                                </div>
                            </div>

                        </div>

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
                                            <input type="text" class="form-control form-control-user" name="time" id="system_time" placeholder="Enter Time">
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
                                            <div class="progress-bar" id="reliability_bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                        </div>
                                        <?php
                                        $dataPoints = array(
                                            array("y" => $weapon1, "label" => "SAM"),
                                            array("y" => $weapon2, "label" => "Main Gun"),
                                            array("y" => $weapon3, "label" => "CRG(port)"),
                                            array("y" => $weapon4, "label" => "CRG(STDB)"),

                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-6"  id="reliability_chart">
                                        <!-- <h3 class="text-grey-900">Relaibility</h3> -->
                                        <div>
                                            <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                        </div>
                                        <?php
                                        $dataPoints1 = array(
                                            array("y" => $weaponReliability1, "label" => "SAM"),
                                            array("y" => $weaponReliability2, "label" => "Main Gun"),
                                            array("y" => $weaponReliability3, "label" => "CRG(Port)"),
                                            array("y" => $weaponReliability4, "label" => "CRG(STDB)"),

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


    $('#system_time').on('focusout', function() {
        var time = $(this).val();

        $.ajax({
            url: '<?= base_url(); ?>Mission/get_mission_reliability',
            method: 'POST',
            data: {
                'mission_name': 'AAW',
                'time': time
            },
            success: function(data) {

                $('#reliability_bar').html(data + "%");
                $('#reliability_bar').width(data * 5);

                $("#reliability_bar").removeClass('bg-danger');
                $("#reliability_bar").removeClass('bg-warning');
                $("#reliability_bar").removeClass('bg-success');
                if (data < 50) {
                    $("#reliability_bar").addClass('bg-danger');
                } else if (data > 50 && data <= 75) {
                    $("#reliability_bar").addClass('bg-warning');
                } else if (data > 75) {
                    $("#reliability_bar").addClass('bg-success');
                }

            },
    
        });

        var arrayFromPHP = [];
        arrayFromPHP = <?php echo json_encode($dataPoints1); ?>;
        // $.each(arrayFromPHP, function(index) {
        //     console.log(index + ':' + this.y);
        //     console.log(index + ':' + this.label);
        // });
var dps = [];
        $.ajax({
            url: '<?= base_url(); ?>Mission/get_each_weapon_reliability',
            method: 'POST',
            data: {
                'mission_name': 'AAW'
            },
            success: function(data) {
                //alert(data[0][weaponReliability$datarow]);
                result = JSON.parse(data);
                alert(result.weaponReliability1);
                alert(result.weaponReliability2);
                alert(result.weaponReliability3);
                alert(result.weaponReliability4);
                // for (var i in result) {
                //     dps.push({
                //     y:result[i]
                //     });
                // }
                
        var chart2 = new CanvasJS.Chart("chartContainer1", {
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
                //dataPoints:dps
               dataPoints: [
                { y: 20 },
                { y:  59},
                { y:80 },
                { y:  40 }   
           ]
            }]
        });

     // function parseDataPoints () {
     //    for (var i in result)
     //      dps.push({y: result[i]});     
     // };
     // alert(dps)
        
     // parseDataPoints();
     // chart2.options.data[0].dataPoints = dps;
    chart2.render();

                // $.each(arrayFromPHP , function(i) {
                //     // this.y = result[i];
                //     // console.log(result[i]);
                //     console.log(i + ':' + this.y);
                //     console.log(i + ':' + this.label);
                // });
            },
            error: function(data) {
                //alert(data);
                alert('failure');
            }
        });

        $('#reliability_chart').show();


    });
</script>