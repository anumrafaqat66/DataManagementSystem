<?php $this->load->view('common/header'); ?>

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
                                    <th scope="col">TPM</th>
                                    <th scope="col">ADLT</th>
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
                                        <td scope="row"><?= $data['TPM']; ?></td>
                                        <td scope="row"><?= $data['ADLT']; ?></td>
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

        <a class="btn btn-primary rounded-pill" href="<?= base_url(); ?>manager"><i class="fas fa-chevron-left"></i> Go Back</a>

    </div>


</div>

</div>

<?php $this->load->view('common/footer'); ?>