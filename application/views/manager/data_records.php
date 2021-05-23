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
                        <table id="datatable" class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">ESWB</th>
                                    <th scope="col">TBF</th>
                                    <th scope="col">TCM</th>
                                    <th scope="col">TCM Desc</th>
                                    <th scope="col">TPM</th>
                                    <th scope="col">TPM Desc</th>
                                    <th scope="col">ADLT</th>
                                    <th scope="col">ADLT Desc</th>
                                    <th scope="col">TTR</th>
                                    <th scope="col">Reg Date</th>
                                    <!-- <th scope="col" width="15%">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0;
                                foreach ($controller_detail_records as $data) { ?>
                                    <tr>
                                        <td scope="row"><?= ++$count; ?></td>
                                        <td scope="row"><?= $data['Controller_Name']; ?></td>
                                        <td scope="row"><?= $data['ESWB']; ?></td>
                                        <td scope="row"><?= $data['TBF']; ?></td>
                                        <td scope="row"><?= $data['TCM']; ?></td>
                                        <td scope="row" id="tcm_desc" style="width:150px; scroll;"value="<?= $data['TCM_Desc']; ?>"><?= $data['TCM_Desc']; ?></td>
                                        <!-- <td type="button" class="btn btn-primary rounded-pill" id="reason_button" data-toggle="modal" data-target="#exampleModalCenter">
                                            View Reason
                                        </td> -->
                                        <!-- Modal -->
                                        <!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Reason</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php //$data['TCM_Desc']; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary rounded-pill" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <td scope="row"><?= $data['TPM']; ?></td>
                                        <td scope="row" style="width:150px;"><?= $data['TPM_Desc']; ?></td>
                                        <td scope="row"><?= $data['ADLT']; ?></td>
                                        <td scope="row" style="width:150px;"><?= $data['ADLT_Desc']; ?></td>
                                        <td scope="row"><?= $data['TTR']; ?></td>
                                        <td scope="row"><?= $data['RegDate']; ?></td>
                                        <!-- <td>
                                           <a class="btn btn-primary rounded-pill text-sm" href="<?= base_url(); ?>manager/Update_data/<?= $data['id']; ?>">Update Record</a>
                                        </td> -->

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