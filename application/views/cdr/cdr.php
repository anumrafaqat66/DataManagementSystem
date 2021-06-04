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
        height: 170px;
        border-radius: 20px;
    }

    .img-ship2 {
        background: url('<?= base_url() ?>assets/img/ship1.jpg');
        background-position: center;
        background-size: cover;
        height: 170px;
        border-radius: 20px;
    }

    .img-ship3 {
        background: url('<?= base_url() ?>assets/img/ship3.jpg');
        background-position: center;
        background-size: cover;
        height: 170px;
        border-radius: 20px;
    }

    .img-ship4 {
        background: url('<?= base_url() ?>assets/img/ship1.jpg');
        background-position: center;
        background-size: cover;
        height: 170px;
        border-radius: 20px;
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

                    <div class="card-body bg-custom3" style="background-color: 315deg;background-image: linear-gradient(315deg, #d4418e 15%, #4B0082 85%);">
                        <div class="row" style="padding:1px;">

                            <!-- <div class="col-sm-12"> -->
                            <div class="col-sm-5 mx-1 my-1 img-ship" style="margin-left:75px !important;">
                                <a href="<?= base_url(); ?>Cdr/co/<?= 'Ship1' ?>">
                                    <h1 class="h1 text-center " style="margin-top: 20px; color:black;"><strong><?php echo $ship_data1 ?></strong></h1>
                                    <h2 class="h4 text-center " style="color:black;"><strong>A: <?php echo $availability_missionA ?></strong></h2>
                                    <h2 class="h4 text-center " style="color:black;"><strong>R: <?php echo $reliability_missionA ?></strong></h2>
                                </a>
                            </div>

                            <div class="col-sm-5 mx-1 my-1 img-ship2" style="padding:5px;">
                                <a href="<?= base_url(); ?>Cdr/co/<?= 'Ship2' ?>">
                                    <h1 class="h1 text-center" style="margin-top: 20px; color:#DCDCDC;"><strong><?php echo $ship_data2 ?></strong></h1>
                                    <h2 class="h4 text-center " style="color:#DCDCDC;"><strong>A: <?php echo $availability_missionB ?></strong></h2>
                                    <h2 class="h4 text-center " style="color:#DCDCDC;"><strong>R: <?php echo $reliability_missionB ?></strong></h2>
                                </a>
                            </div>

                            <!-- </div> -->
                        </div>
                        <div class="row " style="padding:1px;">

                            <!-- <div class="col-sm-12"> -->
                            <div class="col-sm-5 mx-1 my-1 img-ship3" style="margin-left:75px !important;">
                                <a href="<?= base_url(); ?>Cdr/co/<?= 'Ship3' ?>">
                                    <h1 class="h1 text-center " style="margin-top: 20px; color:black;"><strong><?php echo $ship_data3 ?></strong></h1>
                                    <h2 class="h4 text-center " style="color:black;"><strong>A: <?php echo $availability_missionC ?></strong></h2>
                                    <h2 class="h4 text-center " style="color:black;"><strong>R: <?php echo $reliability_missionC ?></strong></h2>
                                </a>
                            </div>

                            <div class="col-sm-5 mx-1 my-1 img-ship4" style="padding:5px;">
                                <a href="<?= base_url(); ?>Cdr/co/<?= 'Ship4' ?>">
                                    <h1 class="h1 text-center" style="margin-top: 20px; color:#DCDCDC;"><strong><?php echo $ship_data4 ?></strong></h1>
                                    <h2 class="h4 text-center " style="color:#DCDCDC;"><strong>A: <?php echo $availability_missionD ?></strong></h2>
                                    <h2 class="h4 text-center " style="color:#DCDCDC;"><strong>R: <?php echo $reliability_missionD ?></strong></h2>
                                </a>
                            </div>

                            <!-- </div> -->
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-1 my-3">
                                
                            </div>
                            <div class="col-sm-4 my-3">
                                <h6 class="h6 text-grey-900" style="color:white">To check all ships reliabiltiy. Please enter time: </h6>
                            </div>
                            <div class="col-sm-4">
                                <form class="user" role="form" id="update_form" method="post" action="">
                                    <input type="text" class="form-control form-control-user" name="time" id="system_time" value="<?php if (isset($entered_time)) {
                                                                                                                                                        echo $entered_time;
                                                                                                                                                    } else {
                                                                                                                                                        echo "";
                                                                                                                                                    }; ?>" placeholder="Enter Time">
                                </form>
                            </div>
                            <div class="col-sm-4">

                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div id="table_div">
                                    <table id="datatable" class="table table-sm table-striped bg-custom3 text-center" style="border-radius:20px;">

                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" ></th>
                                                <th scope="col" colspan="2" style="border-right:5px solid black; "><?php echo $ship_data1 ?></th>
                                                <th scope="col" colspan="2" style="border-right:5px solid black;"><?php echo $ship_data2 ?></th>
                                                <th scope="col" colspan="2" style="border-right:5px solid black;"><?php echo $ship_data3 ?></th>
                                                <th scope="col" colspan="2" ><?php echo $ship_data4 ?></th>
                                            </tr>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">A</th>
                                                <th scope="col" style="border-right:5px solid black;">R</th>
                                                <th scope="col">A</th>
                                                <th scope="col" style="border-right:5px solid black;">R</th>
                                                <th scope="col">A</th>
                                                <th scope="col" style="border-right:5px solid black;">R</th>
                                                <th scope="col">A</th>
                                                <th scope="col">R</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table_rows">

                                            <tr id="table_rows_AAW">
                                                <th style="background-color:#5a5c69; color:white; border-radius:20px;">AAW</th>
                                                <td id="AAW1" style="border-right:5px solid orange;"><?php echo $shipA_mission1 ?>%</td>
                                                <td id="AAW_R1" style="border-right:5px solid black;"><?php echo $shipA_mission_rel1 ?>%</td>

                                                <td id="AAW2" style="border-right:5px solid orange;"><?php echo $shipB_mission1 ?>%</td>
                                                <td id="AAW_R2" style="border-right:5px solid black;"><?php echo $shipB_mission_rel1 ?>%</td>

                                                <td id="AAW3" style="border-right:5px solid orange;"><?php echo $shipC_mission1 ?>%</td>
                                                <td id="AAW_R3" style="border-right:5px solid black;"><?php echo $shipC_mission_rel1 ?>%</td>

                                                <td id="AAW4" style="border-right:5px solid orange;"><?php echo $shipD_mission1 ?>%</td>
                                                <td id="AAW_R4" ><?php echo $shipD_mission_rel1 ?>%</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color:#5a5c69; color:white;border-radius:20px;">ASuW</th>
                                                <td id="ASuW1" style="border-right:5px solid orange;"><?php echo $shipA_mission2 ?>%</td>
                                                <td id="ASuW_R1" style="border-right:5px solid black;"><?php echo $shipA_mission_rel2 ?>%</td>

                                                <td id="ASuW2" style="border-right:5px solid orange;"><?php echo $shipB_mission2 ?>%</td>
                                                <td id="ASuW_R2" style="border-right:5px solid black;"><?php echo $shipB_mission_rel2 ?>%</td>

                                                <td id="ASuW3" style="border-right:5px solid orange;"><?php echo $shipC_mission2 ?>%</td>
                                                <td id="ASuW_R3" style="border-right:5px solid black;"><?php echo $shipC_mission_rel2 ?>%</td>

                                                <td id="ASuW4" style="border-right:5px solid orange;"><?php echo $shipD_mission2 ?>%</td>
                                                <td id="ASuW_R4" ><?php echo $shipD_mission_rel2 ?>%</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color:#5a5c69; color:white;border-radius:20px;">ASW</th>
                                                <td id="ASW1" style="border-right:5px solid orange;"><?php echo $shipA_mission3 ?>%</td>
                                                <td id="ASW_R1" style="border-right:5px solid black;"><?php echo $shipA_mission_rel3 ?>%</td>

                                                <td id="ASW2" style="border-right:5px solid orange;"><?php echo $shipB_mission3 ?>%</td>
                                                <td id="ASW_R2" style="border-right:5px solid black;"><?php echo $shipB_mission_rel3 ?>%</td>

                                                <td id="ASW3" style="border-right:5px solid orange;"><?php echo $shipC_mission3 ?>%</td>
                                                <td id="ASW_R3" style="border-right:5px solid black;"><?php echo $shipC_mission_rel3 ?>%</td>

                                                <td id="ASW4" style="border-right:5px solid orange;"><?php echo $shipD_mission3 ?>%</td>
                                                <td id="ASW_R4" ><?php echo $shipD_mission_rel3 ?>%</td>
                                            </tr>
                                            <tr>
                                                <th style="background-color:#5a5c69; color:white;border-radius:20px;">EW</th>
                                                <td id="EW1" style="border-right:5px solid orange;"><?php echo $shipA_mission4 ?>%</td>
                                                <td id="EW_R1" style="border-right:5px solid black;"><?php echo $shipA_mission_rel4 ?>%</td>

                                                <td id="EW2" style="border-right:5px solid orange;"><?php echo $shipB_mission4 ?>%</td>
                                                <td id="EW_R2" style="border-right:5px solid black;"><?php echo $shipB_mission_rel4 ?>%</td>

                                                <td id="EW3" style="border-right:5px solid orange;"><?php echo $shipC_mission4 ?>%</td>
                                                <td id="EW_R3" style="border-right:5px solid black;"><?php echo $shipC_mission_rel4 ?>%</td>

                                                <td id="EW4" style="border-right:5px solid orange;"><?php echo $shipD_mission4 ?>%</td>
                                                <td id="EW_R4"><?php echo $shipD_mission_rel4 ?>%</td>
                                            </tr>
                                        </tbody>
                                    </table>
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

        $count = 1;
        $('#table_rows > tr').each(function(index, td) {
            var a1 = document.getElementById("AAW" + $count);
            var a_r1 = document.getElementById("AAW_R" + $count);
            var a2 = document.getElementById("ASuW" + $count);
            var a_r2 = document.getElementById("ASuW_R" + $count);
            var a3 = document.getElementById("ASW" + $count);
            var a_r3 = document.getElementById("ASW_R" + $count);
            var a4 = document.getElementById("EW" + $count);
            var a_r4 = document.getElementById("EW_R" + $count);

            if (a1 != null) {
                if (parseFloat(a1.innerHTML) >= 75 && a1 != null) {
                    a1.style.color = "#008000";
                    a1.style.fontSize = "18px";
                    a1.innerHTML = "<b>" + a1.innerHTML + "</b>";
                } else if (parseFloat(a1.innerHTML) >= 50 && parseFloat(a1.innerHTML) < 75) {
                    a1.style.color = "#ffa500";
                    a1.style.fontSize = "18px";
                    a1.innerHTML = "<b>" + a1.innerHTML + "</b>";
                } else if (parseFloat(a1.innerHTML) < 50) {
                    a1.style.color = "#ff0000";
                    a1.style.fontSize = "18px";
                    a1.innerHTML = "<b>" + a1.innerHTML + "</b>";
                }
            }

            if (a_r1 != null) {
                if (parseFloat(a_r1.innerHTML) >= 75 && a_r1 != null) {
                    a_r1.style.color = "#008000";
                    a_r1.style.fontSize = "18px";
                    a_r1.innerHTML = "<b>" + a_r1.innerHTML + "</b>";
                } else if (parseFloat(a_r1.innerHTML) >= 50 && parseFloat(a_r1.innerHTML) < 75) {
                    a_r1.style.color = "#ffa500";
                    a_r1.style.fontSize = "18px";
                    a_r1.innerHTML = "<b>" + a_r1.innerHTML + "</b>";
                } else if (parseFloat(a_r1.innerHTML) < 50) {
                    a_r1.style.color = "#ff0000";
                    a_r1.style.fontSize = "18px";
                    a_r1.innerHTML = "<b>" + a_r1.innerHTML + "</b>";
                }
            }


            if (a2 != null) {
                if (parseFloat(a2.innerHTML) >= 75) {
                    a2.style.color = "#008000";
                    a2.style.fontSize = "18px";
                    a2.innerHTML = "<b>" + a2.innerHTML + "</b>";
                } else if (parseFloat(a2.innerHTML) >= 50 && parseFloat(a2.innerHTML) < 75) {
                    a2.style.color = "#ffa500";
                    a2.style.fontSize = "18px";
                    a2.innerHTML = "<b>" + a2.innerHTML + "</b>";
                } else if (parseFloat(a2.innerHTML) < 50) {
                    a2.style.color = "#ff0000";
                    a2.style.fontSize = "18px";
                    a2.innerHTML = "<b>" + a2.innerHTML + "</b>";
                }
            }

            if (a_r2 != null) {
                if (parseFloat(a_r2.innerHTML) >= 75) {
                    a_r2.style.color = "#008000";
                    a_r2.style.fontSize = "18px";
                    a_r2.innerHTML = "<b>" + a_r2.innerHTML + "</b>";
                } else if (parseFloat(a_r2.innerHTML) >= 50 && parseFloat(a_r2.innerHTML) < 75) {
                    a_r2.style.color = "#ffa500";
                    a_r2.style.fontSize = "18px";
                    a_r2.innerHTML = "<b>" + a_r2.innerHTML + "</b>";
                } else if (parseFloat(a_r2.innerHTML) < 50) {
                    a_r2.style.color = "#ff0000";
                    a_r2.style.fontSize = "18px";
                    a_r2.innerHTML = "<b>" + a_r2.innerHTML + "</b>";
                }
            }

            if (a3 != null) {
                if (parseFloat(a3.innerHTML) >= 75) {
                    a3.style.color = "#008000";
                    a3.style.fontSize = "18px";
                    a3.innerHTML = "<b>" + a3.innerHTML + "</b>";
                } else if (parseFloat(a3.innerHTML) >= 50 && parseFloat(a3.innerHTML) < 75) {
                    a3.style.color = "#ffa500";
                    a3.style.fontSize = "18px";
                    a3.innerHTML = "<b>" + a3.innerHTML + "</b>";
                } else if (parseFloat(a3.innerHTML) < 50) {
                    a3.style.color = "#ff0000";
                    a3.style.fontSize = "18px";
                    a3.innerHTML = "<b>" + a3.innerHTML + "</b>";
                }
            }

            if (a_r3 != null) {
                if (parseFloat(a_r3.innerHTML) >= 75) {
                    a_r3.style.fontSize = "18px";
                    a_r3.style.color = "#008000";
                    a_r3.innerHTML = "<b>" + a_r3.innerHTML + "</b>";
                } else if (parseFloat(a_r3.innerHTML) >= 50 && parseFloat(a_r3.innerHTML) < 75) {
                    a_r3.style.color = "#ffa500";
                    a_r3.style.fontSize = "18px";
                    a_r3.innerHTML = "<b>" + a_r3.innerHTML + "</b>";
                } else if (parseFloat(a_r3.innerHTML) < 50) {
                    a_r3.style.color = "#ff0000";
                    a_r3.style.fontSize = "18px";
                    a_r3.innerHTML = "<b>" + a_r3.innerHTML + "</b>";
                }
            }

            if (a4 != null) {
                if (parseFloat(a4.innerHTML) >= 75) {
                    a4.style.color = "#008000";
                    a4.style.fontSize = "18px";
                    a4.innerHTML = "<b>" + a4.innerHTML + "</b>";
                } else if (parseFloat(a4.innerHTML) >= 50 && parseFloat(a4.innerHTML) < 75) {
                    a4.style.color = "#ffa500";
                    a4.style.fontSize = "18px";
                    a4.innerHTML = "<b>" + a4.innerHTML + "</b>";
                } else if (parseFloat(a4.innerHTML) < 50) {
                    a4.style.color = "#ff0000";
                    a4.style.fontSize = "18px";
                    a4.innerHTML = "<b>" + a4.innerHTML + "</b>";
                }
            }

            if (a_r4 != null) {
                if (parseFloat(a_r4.innerHTML) >= 75) {
                    a_r4.style.color = "#008000";
                    a_r4.style.fontSize = "18px";
                    a_r4.innerHTML = "<b>" + a_r4.innerHTML + "</b>";
                } else if (parseFloat(a_r4.innerHTML) >= 50 && parseFloat(a_r4.innerHTML) < 75) {
                    a_r4.style.color = "#ffa500";
                    a_r4.style.fontSize = "18px";
                    a_r4.innerHTML = "<b>" + a_r4.innerHTML + "</b>";
                } else if (parseFloat(a_r4.innerHTML) < 50) {
                    a_r4.style.color = "#ff0000";
                    a_r4.style.fontSize = "18px";
                    a_r4.innerHTML = "<b>" + a_r4.innerHTML + "</b>";
                }
            }
            $count++;
        });


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
            url: '<?= base_url(); ?>Cdr/get_all_ships_reliability',
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
            url: '<?= base_url(); ?>Cdr/PageReload',
            method: 'POST',
            data: {
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


    $('#Ship_name').on('change', function() {
        // alert('sds');
        var a = $(this).val();
        if ($(this).val() == 'Zafr') {
            window.location.href = "<?= base_url(); ?>Cdr/co/Ship1";
        } else if ($(this).val() == 'Saif') {
            window.location.href = "<?= base_url(); ?>Cdr/co/Ship2";
        } else if ($(this).val() == 'S/Sheer') {
            window.location.href = "<?= base_url(); ?>Cdr/co/Ship3";
        } else if ($(this).val() == 'ASLT') {
            window.location.href = "<?= base_url(); ?>Cdr/co/Ship4";
        }
    });
</script>