<?php $this->load->view('manager/common/header'); ?>

<div class="container">
    <div class="card">

        <div class="card-body bg-custom3">

            <div id="table_div">
                <?php if (isset($controller_detail_records)) {
                    if (count($controller_detail_records) > 0) { ?>
                        <div class="card-header bg-custom1">
                            <h1 class="h4 text-white">Records</h1>
                        </div>
                        <table id="datatable" class="table table-sm table-striped text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">ESWB</th>
                                    <th scope="col">Fail Start Date</th>
                                    <th scope="col">Fail End Date</th>
                                    <th scope="col">TBF</th>
                                    <th scope="col">TCM</th>
                                    <th scope="col">Desc</th>
                                    <th scope="col">TPM</th>
                                    <th scope="col">Desc</th>
                                    <th scope="col">ADLT</th>
                                    <th scope="col">Desc</th>
                                    <th scope="col">TTR</th>
                                    <th scope="col">Status</th>
                                    <!-- <th scope="col">Reg Date</th> -->
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0;
                                foreach ($controller_detail_records as $data) { ?>
                                    <tr style="<?php if($data['Status'] =="In Progress") {echo 'background-color:#ffcccb;font-weight: bold';}?>">
                                        <td scope="row"><?= ++$count; ?></td>
                                        <td scope="row"><?= $data['Controller_Name']; ?></td>
                                        <td scope="row"><?= $data['ESWB']; ?></td>
                                        <td scope="row" style="width:600px;"><?= $data['Failure_start_date']; ?></td>
                                        <td scope="row" style="width:500px;"><?= $data['Failure_end_date']; ?></td>
                                        <td scope="row"><?= $data['TBF']; ?></td>
                                        <td scope="row"><?= $data['TCM']; ?></td>
                                        <td scope="row" id="tcm_desc" style="width:150px; scroll;"value="<?= $data['TCM_Desc']; ?>"><?= $data['TCM_Desc']; ?></td>
                                        <td scope="row"><?= $data['TPM']; ?></td>
                                        <td scope="row" style="width:150px;"><?= $data['TPM_Desc']; ?></td>
                                        <td scope="row"><?= $data['ADLT']; ?></td>
                                        <td scope="row" style="width:150px;"><?= $data['ADLT_Desc']; ?></td>
                                        <td scope="row"><?= $data['TTR']; ?></td>
                                        <td scope="row" style="width:120px;<?php if($data['Status'] =="In Progress") {echo 'color:red';}?>" ><?= $data['Status']; ?></td>
                                        <!-- <td scope="row"><?= $data['RegDate']; ?></td> -->
                                        <td scope="row" style="width:300px;">
                                           <a class="btn btn-primary rounded-pill text-sm" href="<?= base_url(); ?>manager/update_details/<?= $data['id']; ?>">Update</a>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <div class="card-header">
                            <h1 class="h4 text-gray-900">No Data Available yet</h1>
                        </div>
                    <?php }
                    unset($controller_detail_records);
                    // unset($data['controller_detail_records']);
                } else { ?>

                    <a> No Record Selected. </a>
                <?php  } ?>
            </div>
        </div>

    </div>
    <div class="form-group row justify-content-center my-2">

        <a class="btn btn-primary rounded-pill" id="abc" href="<?= base_url(); ?>manager"><i class="fas fa-chevron-left"></i> Go Back</a>

    </div>

</div>

</div>

<?php $this->load->view('common/footer'); ?>

<script>

    // alert($('#tcm_desc').html());
    // $('#reason_button').on('click', function() {
    //     alert('abc');
    // });

    // $('#reason_button').on('click', function() {
    //     alert('abc');
    //     var tcm_desc = $('tcm_desc').html();
    //     alert(tcm_desc);
    // });

    // $('#abc').on('click', function() {
    //     alert('abc');
    //     var tcm_desc = $('tcm_desc').html();
    //     alert(tcm_desc);
    // });

</script>