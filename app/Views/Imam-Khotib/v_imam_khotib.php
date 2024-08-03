<!-- /.tabel-anggran-->
<?php $role_id = session()->get('role_id'); ?>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                Data Petugas
            </h3>
            <div class="card-tools">
                <!-- Tombol untuk Tambah Anggaran -->
                <?php if ($role_id == 'admin') { ?>
                    <button type="button" class="btn btn-tool" style="background-color: green; color: white;" data-toggle="modal" data-target="#modal-tambah-masuk">
                        <!-- Ikon "plus" menggunakan font-awesome -->
                        <i class="fas fa-plus"></i> Tambah Data
                    </button>
                <?php } ?>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <?php if (session()->has('pesan')) : ?>
                <script>
                    $(document).ready(function() {
                        toastr.success('<?= session()->getFlashdata('pesan'); ?>');
                    });
                </script>
            <?php endif; ?>
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th width="30px">NO</th>
                        <th>NAMA</th>
                        <th width="200px">NO HP</th>
                        <th width="300px">ALAMAT</th>
                        <?php if ($role_id == 'admin') { ?>
                            <th width="100px">AKSI</th>
                        <?php } ?>
                        <th width="30px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($anggaran as $key => $value) { ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="text-center">
                                <?= $value['nama_petugas'] ?>
                            </td>
                            <td class="text-center">
                                0<?= $value['no_petugas'] ?>
                            </td>
                            <td class="text-center">
                                <?= $value['alamat_petugas'] ?>
                            </td>
                            <?php if ($role_id == 'admin') { ?>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit<?= $value['id_petugas'] ?>"><i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete<?= $value['id_petugas'] ?>"><i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            <?php } ?>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /.modal-tambah-masuk -->
<div class="modal fade" id="modal-tambah-masuk">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Tambah Data Petugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('ImamKhotib/InsertDataPetugas') ?>
                <div class="form-group">
                    <label for="">Nama Petugas</label>
                    <input name="nama_petugas" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">No Handphone</label>
                    <input  type="number" name="no_petugas" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <input name="alamat_petugas" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal-edit -->
<?php foreach ($anggaran as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_petugas'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data Petugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('ImamKhotib/UpdateDataPetugas/' . $value['id_petugas']) ?>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input name="nama_petugas" value="<?= $value['nama_petugas'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">No Handphone</label>
                        <input type="number" name="no_petugas" value="0<?= $value['no_petugas'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input name="alamat_petugas" value="<?= $value['alamat_petugas'] ?>" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Ubah</button>
                    <?php echo form_close() ?>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<!-- /.modal-delete -->
<?php foreach ($anggaran as $key => $value) { ?>
    <!-- /.modal-edit -->
    <div class="modal fade" id="modal-delete<?= $value['id_petugas'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  bg-danger">
                    <h4 class="modal-title">Hapus Data Petugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Yakin Ingin Menghapus Data <b><?= $value['nama_petugas'] ?></b> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('ImamKhotib/DeleteDataPetugas/' . $value['id_petugas']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>