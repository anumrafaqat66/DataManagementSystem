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
                                    <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Sensor</option>
                                        <option class="form-control form-control-user" value="Sensor">Sensor</option>
                                        <option class="form-control form-control-user" value="Fire Controller">Fire Controller</option>
                                        <option class="form-control form-control-user" value="Weapon">Weapon</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="time" placeholder="Enter Time">
                                </div>
                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">75%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">85%</div>
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
                                    <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Fire Controller</option>
                                        <option class="form-control form-control-user" value="Sensor">Sensor</option>
                                        <option class="form-control form-control-user" value="Fire Controller">Fire Controller</option>
                                        <option class="form-control form-control-user" value="Weapon">Weapon</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="time" placeholder="Enter Time">
                                </div>
                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">75%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">85%</div>
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
                                    <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Weapon</option>
                                        <option class="form-control form-control-user" value="Sensor">Sensor</option>
                                        <option class="form-control form-control-user" value="Fire Controller">Fire Controller</option>
                                        <option class="form-control form-control-user" value="Weapon">Weapon</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 mb-1">
                                    <input type="text" class="form-control form-control-user" name="time" id="time" placeholder="Enter Time">
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">75%</div>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">85%</div>
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