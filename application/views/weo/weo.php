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
        padding: 10px 30px;
        margin: 0px 45px;
        width: 100px;
        text-align: center;
    }

    .box.hidden {
        visibility: hidden;
    }

    .lines {
        margin-left: 100px;
    }

    .line {
        display: inline-block;
        border: 1px solid black;
        border-top: none;
        height: 30px;
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
    <h1 class="h4 text-gray-900">Welcome WEO</h1>
    <hr>

    <div class="card-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h1 class="h4 text-gray-900">Weapon System</h1>
                    </div>

                    <div class="card-body">
                        <h6>To check the availability of the complete system, Please select the Weapon.</h6>
                        <hr>
                        <form class="user" role="form" id="update_form" method="post" action="">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <select class="form-control rounded-pill" name="controller_type" id="controller_type" data-placeholder="Select Controller" style="font-size: 0.8rem; height:50px;">\
                                        <option class="form-control form-control-user" value="">Select Weapon</option>
                                         <?php if (isset($controller_data)) {
                                            foreach ($controller_data as $data) { ?>
                                        <option class="form-control form-control-user" value="<?= $data['ID'];?>"><?= $data['Controller_type'];?></option>
                                        <?php } 
                                    }  ?>
                                    </select>
                                </div>


                            </div>
                            <hr>
                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <h4 class="text-center">Availability</h4>
                                </div>

                                <div class="col-sm-6 ">
                                    <h4 class="text-center">Reliability</h4>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text" id="availability">0%</div>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <span class="dot">
                                            <div class="center-text">85%</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-primary btn-user btn-block">
                                        <!-- <i class="fab fa-google fa-fw"></i>  -->
                                        Show Detail
                                    </button>
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
                        Weapon Design
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="box">Foo</div>
                            <div class="box">Bar</div>
                            <div class="box">Baz</div>
                        </div>

                        <div class="lines">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>

                        <div class="connect three">
                        </div>

                        <div>
                            <div class="hidden box"></div>
                            <div class="box">Quux</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


<?php $this->load->view('common/footer'); ?>
<script>
 $('#controller_type').on('change', function() {
    alert('df');
     var id = $(this).val();
    alert(id);

     $.ajax({
      url: '<?= base_url(); ?>WEO/get_availability',
      method: 'POST',
      data: {
        'controller_id': id
      },
      success: function(data) {
       // var result = jQuery.parseJSON(data);
        //alert(result);
        $('#availability').html(data + "%");
      },
      error: function(data) {
        //alert(data);
        alert('failure');
      }
    });
    e.preventDefault();
    window.onunload = function() {
      dubugger;
  }
    });
</script>