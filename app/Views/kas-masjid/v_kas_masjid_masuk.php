<?php $role_id = session()->get('role_id'); ?>
<?php $id_user = session()->get('id_user'); ?>
<div class="col-md-12">
    <?php
    if ($kas == null) {
        $pemasukan[] = 0;
    } elseif (is_array($kas)) {
        foreach ($kas as $key => $value) {
            $pemasukan[] = $value['kas_masuk'];
        }
    }
    ?>
    <div class="alert alert-success alert-dismissible">
        <h5><i class="fas fa-money-bill-wave"></i> Total Pemasukan Kas Masjid</h5>
        <h3>
            Rp.
            <?= number_format(array_sum($pemasukan), 0) ?>
        </h3>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                <?= $judul ?>
            </h3>
            <?php if ($role_id == 'pengurus') { ?>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            <?php } ?>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (session()->has('pesan')) : ?>
                <script>
                    $(document).ready(function() {
                        toastr.success('<?= session()->getFlashdata('pesan'); ?>');
                    });
                </script>
            <?php endif; ?>
            <table class="table" id="example1">
                <thead>
                    <tr class="text-center">
                        <th width="30px">No</th>
                        <?php if ($role_id == 'admin') { ?>
                            <th>Petugas Entri</th>
                        <?php } ?>
                        <th width="100px">Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kas as $key => $value) { ?>
                        <tr>
                            <td>
                                <?= $no++ ?>
                            </td>
                            <?php if ($role_id == 'admin') { ?>
                                <td>
                                    <?= $value['nama_user'] ?>
                                </td>
                            <?php } ?>
                            <td>
                                <?= date('d-m-Y', strtotime($value['tanggal'])) ?>
                            </td>
                            <td>
                                <?= $value['ket'] ?>
                            </td>
                            <td class="text-right">
                                Rp.
                                <?= number_format($value['kas_masuk'], 0) ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit<?= $value['id_kas_masjid'] ?>"><i class="fas fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete<?= $value['id_kas_masjid'] ?>"><i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- /.modal-tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header  bg-success">
                <h4 class="modal-title">Tambah Data Kas Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('KasMasjid/InsertKasMasuk') ?>
                <input type="hidden" name="id_user" value="<?= $id_user ?>">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input name="ket" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Jumlah(Rp. )</label>
                    <input type="number" min="0" value="0" name="kas_masuk" class="form-control" required>
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
<?php foreach ($kas as $key => $value) { ?>
    <!-- /.modal-edit -->
    <div class="modal fade" id="modal-edit<?= $value['id_kas_masjid'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  bg-warning">
                    <h4 class="modal-title">Ubah Data Kas Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('KasMasjid/UpdateKasMasuk/' . $value['id_kas_masjid']) ?>
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="form-group">
                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" value="<?= $value['tanggal'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input name="ket" value="<?= $value['ket'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah(Rp. )</label>
                        <input type="number" min="0" value="<?= $value['kas_masuk'] ?>" name="kas_masuk" class="form-control" required>
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
<?php foreach ($kas as $key => $value) { ?>
    <!-- /.modal-edit -->
    <div class="modal fade" id="modal-delete<?= $value['id_kas_masjid'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header  bg-danger">
                    <h4 class="modal-title">Hapus Data Kas Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Yakin Ingin Menghapus Data <b><?= $value['ket'] ?></b> ?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('KasMasjid/DeleteKasMasuk/' . $value['id_kas_masjid']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>