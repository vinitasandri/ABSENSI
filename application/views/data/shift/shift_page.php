<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                JQUERY DATATABLES
                <small>Taken from <a href="https://datatables.net/" target="_blank">datatables.net</a></small>
            </h2>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            EXPORTABLE TABLE
                        </h2>
                        <span onClick="addData()" data-toggle="modal" data-target="#modal_add">
                            <button style="float: right; position:relative;bottom:25px;" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                                <i class="material-icons">add</i>
                            </button>
                        </span>
                    </div>
                    <?php if ($this->session->flashdata('text')) { ?>
                        <p style="display: none;" id="icon"><?= $this->session->flashdata('icon'); ?></p>
                        <p style="display: none;" id="title"><?= $this->session->flashdata('title'); ?></p>
                        <p style="display: none;" id="text"><?= $this->session->flashdata('text'); ?></p>
                    <?php } ?>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Keterangan</th>
                                        <th>Waktu Check-in</th>
                                        <th>Waktu Check-out</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Keterangan</th>
                                        <th>Waktu Check-in</th>
                                        <th>Waktu Check-out</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($data_shift as $row) {
                                        $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td><?= $row['check_in'] ?></td>
                                            <td><?= $row['check_out'] ?></td>
                                            <td>
                                                <center>
                                                    <span data-toggle="modal" data-target="#modal_add">
                                                        <button onClick="updateData('<?= $row['id_shift']; ?>','<?= $row['keterangan']; ?>','<?= $row['check_in']; ?>','<?= $row['check_out']; ?>')" id="btn_verif" type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                                            <i class="material-icons">mode_edit</i>
                                                        </button>
                                                    </span>
                                                    <span data-toggle="modal" data-target="#modal_delete">
                                                        <button onClick="deleteData('<?= $row['id_shift']; ?>')" type="button" class="btn bg-default btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    </span>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
</section>


<!-- Modal Delete  -->
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Hapus Data Shift</h4>
            </div>
            <hr>
            <div class="modal-body">
                Anda Yakin ingin menghapus data shift tersebut ?
            </div>
            <hr>
            <div class="modal-footer">
                <a id="btn_delete" class="btn btn-link waves-effect">SAVE CHANGES</a>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_modal">Tambah Data Shift</h4>
            </div>
            <hr>
            <div class="modal-body">
                <form id="form_action" action="<?= base_url('shift/add_data/') ?>" method="post">
                    <div class="col-sm-12">
                        <div class="form-group">
                        <label for="shift">Keterangan</label>
                            <div class="form-line">
                                <input type="text" id="keterangan" name="keterangan" placeholder="Keterangan ..." class="form-control">
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="shift">Waktu Check-in</label>
                        <div class="input-group date" id="bs_datepicker_component_container">
                            <div class="form-line">
                                <input type="text" id="check_in" name="check_in" class="timepicker form-control" placeholder="Please choose a time...">
                            </div>
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="shift">Waktu Check-out</label>
                        <div class="input-group date" id="bs_datepicker_component_container">
                            <div class="form-line">
                                <input type="text" id="check_out" name="check_out" class="timepicker form-control" placeholder="Please choose a time...">
                            </div>
                            <span class="input-group-addon">
                                <i class="material-icons">date_range</i>
                            </span>
                        </div>
                    </div>
                    <input type="hidden" id="id_shift" name="id_shift">
            </div>
            <hr>
            <div class="modal-footer">
                <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </form>
            </div>
        </div>
    </div>
</div>