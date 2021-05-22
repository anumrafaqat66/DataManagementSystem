<?php $this->load->view('co/common/header'); ?>
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
    <h1 class="h4 text-gray-900">Welcome Commanding Officer!</h1>
    <div class="card-body">

        <div class="form-group row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header bg-custom1">
                        <h1 class="h4 text-white">Missions</h1>
                    </div>

                    <div class="card-body bg-custom3">
                        <div class="form-group row">
                            <a class="col mx-1 my-1 img-aaw" href="<?= base_url(); ?>mission/<?= 'AAW' ?>">
                                <div style="height:200px">
                                    <div style="margin-top:100px">
                                        <h1 class="h1 text-dark text-center "><strong>AAW</strong></h1>
                                        <h2 class="h2 text-dark text-center "><strong><?php echo $mission1 ?></strong></h2>
                                    </div>
                                </div>
                            </a>
                            <a class="col mx-1 my-1 img-asuw" href="<?= base_url(); ?>mission/<?= 'ASuW' ?>">
                                <div style="height:200px">
                                    <div style="margin-top:100px">
                                        <h1 class="h1 text-primary text-center "><strong>ASuW</strong></h1>
                                        <h2 class="h2 text-primary text-center "><strong><?php echo $mission2 ?></strong></h2>
                                    </div>
                                </div>
                            </a>
                            <!-- <div class="w-100"></div> -->
                            <a class="col mx-1 my-1 img-asw" href="<?= base_url(); ?>mission/<?= 'ASW' ?>">
                                <div style="height:200px">
                                    <div style="margin-top:100px">
                                        <h1 class="h1 text-white text-center "><strong>ASW</strong></h1>
                                        <h2 class="h2 text-white text-center "><strong><?php echo $mission3 ?></strong></h2>
                                    </div>
                                </div>
                            </a>
                            <a class="col mx-1 my-1 img-ew" href="<?= base_url(); ?>mission/<?= 'EW' ?>">
                                <div style="height:200px">
                                    <div style="margin-top:100px">
                                        <h1 class="h1 text-white text-center "><strong>EW</strong></h1>
                                        <h2 class="h2 text-white text-center "><strong><?php echo $mission4 ?></strong></h2>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- <div class="card">
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
                        </div> -->
                        <div class="form-group row justify-content-center my-3">
                            <div class="col-md-6">
                                <a class="btn btn-primary rounded-pill btn-user btn-block" href="<?= base_url(); ?>CO"><i class="fas fa-chevron-left"></i> Back</a>
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