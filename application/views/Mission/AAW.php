<?php $this->load->view('common/header'); ?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<style>
    .img {
    background: url('<?= base_url()?>assets/img/AAW.jpg');
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
                          
                            <div  class="col mx-1 my-1 img" style="height:300px">
                                <div style="margin-top:135px">
                           
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
                                            <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 90%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span><?= $availability ."%" ?></span></div>
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
						<!-- Graphs -->
                         <div class="card">
                            <div class="card-header bg-custom1">
                                <h5 class="h5 text-white">Graphs</h5>
                            </div>

                            <div class="card-body bg-custom3">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="text-grey-900">Availability</h3>
                                        <div >
                                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                        </div> 
                                        <?php 
												$dataPoints = array(
													array("y" => 55, "label" => "SAM"),
													array("y" => 68.4, "label" => "Main Gun"),
													array("y" => 46, "label" => "CRG(port)"),
													array("y" => 89.5, "label" => "CRG(STDB)"),
													
												);	
												?>
                                    </div>
                                     <div class="col">
                                        <h3 class="text-grey-900">Relaibility</h3>
                                        <div >
                                            <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                        </div> 
                                        <?php 
												$dataPoints1 = array(
													array("y" => 70,"label" => "SAM" ),
													array("y" => 56.8,"label" => "Main Gun" ),
													array("y" => 34.5,"label" => "CRG(Port)" ),
													array("y" => 18,"label" => "CRG(STDB)" ),
													
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
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text:""
	},
	axisY:{
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
	title:{
		text:""
	},
	axisY:{
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
</script>