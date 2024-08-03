<!-- /.tabel-anggran-->
<?php $role_id = session()->get('role_id'); ?>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                Data <?= $judul ?>
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
                        <th>EMAIL</th>
                        <th>NO HANDPHONE</th>
                        <th>JABATAN</th>
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
                                <?= $value['nama_user'] ?>
                            </td>
                            <td class="text-center">
                                <?= $value['email'] ?>
                            </td>
                            <td class="text-center">
                                0<?= $value['no_hp'] ?>
                            </td>
                            <td class="text-center">
                                <?= $value['Nama_jabatan'] ?>
                            </td>
                            <?php if ($role_id == 'admin') { ?>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit<?= $value['id_user'] ?>"><i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete<?= $value['id_user'] ?>"><i class="fas fa-trash"></i>
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
                <h4 class="modal-title">Tambah Data Pengurus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('PengurusMasjid/InsertDataPengurus') ?>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input name="nama_user" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">No Handphone</label>
                    <input name="no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control select2">
                        <?php foreach ($jabatan as $key => $idjabatan) { ?>
                            <option value="<?= $idjabatan['id_jabatan'] ?>" <?= $idjabatan['id_jabatan'] == $value['id_jabatan'] ? 'selected' : '' ?>>
                                <?= $idjabatan['Nama_jabatan'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input name="password" class="form-control" required>
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
    <div class="modal fade" id="modal-edit<?= $value['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data Pengurus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('PengurusMasjid/UpdateDataPengurus/' . $value['id_user']) ?>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input name="nama_user" value="<?= $value['nama_user'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input name="email" type="email" value="<?= $value['email'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">No Handphone</label>
                        <input name="no_hp" value="<?= $value['no_hp'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input name="password" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan" class="form-control select2">
                            <?php foreach ($jabatan as $key => $idjabatan) { ?>
                                <option value="<?= $idjabatan['id_jabatan'] ?>" <?= $idjabatan['id_jabatan'] == $value['id_jabatan'] ? 'selected' : '' ?>>
                                    <?= $idjabatan['Nama_jabatan'] ?>
                                </option>
                            <?php } ?>
                        </select>
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
    <div class="modal fade" id="modal-delete<?= $value['id_user'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Petugas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Yakin Ingin Menghapus Data <b><?= $value['nama_user'] ?></b> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('PengurusMasjid/DeleteDataPengurus/' . $value['id_user']) ?>" class="btn btn-danger">Ya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>