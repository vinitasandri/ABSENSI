<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <ol class="breadcrumb breadcrumb-bg-blue">
                <li><a href="javascript:void(0);"><i class="material-icons">home</i> Home</a></li>
                <li class="active"><i class="material-icons">library_books</i> <?= $breadcumb ?></li>
            </ol>
        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $breadcumb ?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($data_karyawan as $row) {
                                        $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama_lengkap'] ?></td>
                                            <td><?= $row['jenis_kelamin'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= sprintf(
                                                    "%s-%s-%s",
                                                    substr($row['no_telp'], 0, 4),
                                                    substr($row['no_telp'], 4, 4),
                                                    substr($row['no_telp'], 8)
                                                ); ?></td>
                                            <td><?= $row['tgl_lahir']; ?></td>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Detail">
                                                        <i class="material-icons">library_books</i>
                                                    </button>
                                                    <button type="button" class="btn bg-blue-grey btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Edit Data">
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                    <button type="button" class="btn bg-default btn-circle waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="top" title="Delete Data">
                                                        <i class="material-icons">delete</i>
                                                    </button>
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