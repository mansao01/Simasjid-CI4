<!-- /.col -->
<?php $role_id = session()->get('role_id'); ?>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <?php if ($role_id == 'admin') { ?>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            <?php } ?>
            <!-- /.card-tools -->
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
                <thead style="text-align: center;">
                    <tr>
                        <th width="5%">No</th>
                        <th width="8%"></th>
                        <th >Nama Agenda</th>
                        <th width="35%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($agenda as $key => $value) { ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle; height: 65px;">
                                <h5><b><?= $no++ ?></b></h5>
                            </td>
                            <td style="text-align: center; vertical-align: middle; height: 65px;">
                                <i class="fas fa-bullhorn fa-3x text-success"></i>
                            </td>
                            <td>
                                <h5><b><?= $value['nama_kegiatan'] ?></b></h5>
                                <div class="agenda-details">
                                    <div class="agenda-info">
                                        Tanggal : <?= $value['tanggal'] ?><br>
                                        Jam : <?= $value['jam'] ?> - Selesai<br>
                                        Tempat : <?= $value['Tempat'] ?>
                                    </div>
                                    <div class="agenda-personnel">
                                        Ketua : <?= $value['ketua'] ?><br>
                                        Sekretaris : <?= $value['sekertaris'] ?><br>
                                        Bendahara : <?= $value['bendahara'] ?>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align: center; vertical-align: middle; height: 65px;">
                                <?php if ($role_id == 'admin') { ?>
                                    <a href="<?= base_url('Agenda/LihatAnggaranBerjalan/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-success"><i class="fas fa-layer-group"></i> Anggaran</a>
                                    <a href="<?= base_url('Agenda/LihatDanaKegiatanBerjalan/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-layer-group"></i> Dana Kegiatan</a>
                                    <button class="btn btn-flat btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit<?= $value['id_agenda'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                    <button class="btn btn-flat btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete<?= $value['id_agenda'] ?>"><i class="fas fa-trash"></i></button>
                                <?php } ?>

                                <?php if ($role_id == 'pengurus') { ?>
                                    <a href="<?= base_url('Agenda/Anggaran/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-success"><i class="fas fa-layer-group"></i> Anggaran</a>
                                    <a href="<?= base_url('Agenda/DetailAgenda/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-layer-group"></i> Dana Kegiatan</a>
                                    <button class="btn btn-flat btn-sm btn-secondary" data-toggle="modal" data-target="#modal-selesai<?= $value['id_agenda'] ?>">Selesai</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- /.Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('Agenda/InsertData') ?>
                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <textarea rows="4" name="nama_kegiatan" class="form-control" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required></input>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jam</label>
                            <input type="time" class="form-control" name="jam" required></input>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tempat</label>
                    <input class="form-control" name="tempat" required></input>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ketua Kegiatan</label>
                            <select name="ketua" class="form-control select2">
                                <?php foreach ($user as $idjabatan) { ?>
                                    <option value="<?= $idjabatan['id_user'] ?>">
                                        <?= $idjabatan['nama_user'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sekertaris Kegiatan</label>
                            <select name="sekertaris" class="form-control select2">
                                <?php foreach ($user as $idjabatan) { ?>
                                    <option value="<?= $idjabatan['id_user'] ?>">
                                        <?= $idjabatan['nama_user'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Bendahara Kegiatan</label>
                            <select name="bendahara" class="form-control select2">
                                <?php foreach ($user as $idjabatan) { ?>
                                    <option value="<?= $idjabatan['id_user'] ?>">
                                        <?= $idjabatan['nama_user'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Modal Edit -->
<?php foreach ($agenda as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_agenda'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header btn-warning">
                    <h4 class="modal-title">Ubah <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('Agenda/UpdateData/' . $value['id_agenda']) ?>
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <textarea rows="6" name="nama_kegiatan" class="form-control" required><?= $value['nama_kegiatan'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" value="<?= $value['tanggal'] ?>" name="tanggal" required></input>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jam</label>
                                <input type="time" class="form-control" value="<?= $value['jam'] ?>" name="jam" required></input>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tempat</label>
                        <input class="form-control" value="<?= $value['Tempat'] ?>" name="tempat" required></input>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ketua Kegiatan</label>
                                <select name="ketua" class="form-control select2">
                                    <?php foreach ($user as $idjabatan) { ?>
                                        <option value="<?= $idjabatan['id_user'] ?>" <?= $idjabatan['id_user'] == $value['ketua'] ? 'selected' : '' ?>>
                                            <?= $idjabatan['nama_user'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sekertaris Kegiatan</label>
                                <select name="sekertaris" class="form-control select2">
                                    <?php foreach ($user as $idjabatan) { ?>
                                        <option value="<?= $idjabatan['id_user'] ?>" <?= $idjabatan['id_user'] == $value['sekertaris'] ? 'selected' : '' ?>>
                                            <?= $idjabatan['nama_user'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bendahara Kegiatan</label>
                                <select name="bendahara" class="form-control select2">
                                    <?php foreach ($user as $idjabatan) { ?>
                                        <option value="<?= $idjabatan['id_user'] ?>" <?= $idjabatan['id_user'] == $value['bendahara'] ? 'selected' : '' ?>>
                                            <?= $idjabatan['nama_user'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.Modal Delete -->
    <div class="modal fade" id="modal-delete<?= $value['id_agenda'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header btn-danger">
                    <h4 class="modal-title">Hapus
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data ? <br>
                    <b>
                        <?= $value['nama_kegiatan'] ?>
                    </b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('Agenda/DeleteData/' . $value['id_agenda']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.Modal Selesai -->
    <div class="modal fade" id="modal-selesai<?= $value['id_agenda'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Selesai
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah <b><?= $value['nama_kegiatan'] ?></b> Kegiatan Sudah Selesai? <br>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('Agenda/SelesaiData/' . $value['id_agenda']) ?>" class="btn btn-secondary">Iya</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>
