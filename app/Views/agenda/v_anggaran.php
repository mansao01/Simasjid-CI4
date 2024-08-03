<!-- /.tabel-anggran-->
<?php $role_id = session()->get('role_id'); ?>
<div class="col-md-12">
    <?php
    if ($anggaran == null) {
        $pemasukan[] = 0;
    } elseif (is_array($anggaran)) {
        foreach ($anggaran as $key => $value) {
            $pemasukan[] = $value['biaya'];
        }
    }
    ?>
    <div class="alert alert-success alert-dismissible">
        <h5>Jumlah Anggaran Kegiatan</h5>
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
                Anggaran
            </h3>
            <div class="card-tools">
                <!-- Tombol untuk Tambah Anggaran -->
                <?php if ($role_id == 'pengurus') { ?>
                    <button type="button" class="btn btn-tool" style="background-color: green; color: white;" data-toggle="modal" data-target="#modal-tambah-masuk">
                        <!-- Ikon "plus" menggunakan font-awesome -->
                        <i class="fas fa-plus"></i> Tambah Anggaran
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
                        <th width="70px">NO</th>
                        <th>URAIAN</th>
                        <th width="200px">BIAYA</th>
                        <?php if ($role_id == 'pengurus') { ?>
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
                                <?= $value['uraian'] ?>
                            </td>
                            <td class="text-right">
                                Rp. <?= number_format($value['biaya'], 0) ?>
                            </td>
                            <?php if ($role_id == 'pengurus') { ?>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit<?= $value['id_anggaran'] ?>"><i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete<?= $value['id_anggaran'] ?>"><i class="fas fa-trash"></i>
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
                <h4 class="modal-title">Tambah Anggaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('Agenda/InsertAnggaran') ?>
                <input value="<?= $detail['id_agenda'] ?>" name="id_agenda" hidden></input>
                <div class="form-group">
                    <label for="">Uraian</label>
                    <input name="uraian" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Biaya (Rp.)</label>
                    <input type="number" min="0" value="0" name="biaya" class="form-control" required>
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
    <div class="modal fade" id="modal-edit<?= $value['id_anggaran'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Ubah Data Anggaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('Agenda/EditAnggaran/' . $value['id_anggaran'] . '/' . $value['id_agenda']) ?>
                    <div class="form-group">
                        <label for="">Uraian</label>
                        <input name="uraian" value="<?= $value['uraian'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Biaya (Rp.)</label>
                        <input name="biaya" type="number" min="0" value="<?= $value['biaya'] ?>" class="form-control" required>
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
    <div class="modal fade" id="modal-delete<?= $value['id_anggaran'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data Anggaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Yakin Ingin Menghapus Data?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('Agenda/DeleteAnggaran/' . $value['id_anggaran'] . '/' . $value['id_agenda']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>