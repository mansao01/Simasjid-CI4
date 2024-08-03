<!-- /.col -->
<div class="col-md-4">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Rekening Saluran Donasi
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table">
                <tbody>
                    <?php
                    foreach ($rek as $key => $value) { ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle; height: 100px;">
                                <i class="fas fa-money-check fa-2x text-success"></i>
                            </td>
                            <td>
                                <h5><b>
                                        <?= $value['nama_bank'] ?>
                                    </b>
                                </h5>
                                <h6>
                                    <?= $value['no_rek'] ?> <br>
                                </h6>
                                <h6>a.n :
                                    <?= $value['atas_nama'] ?>
                                </h6>
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


<!-- /.Kirim Donasi -->
<div class="col-md-8">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Konfirmasi Donasi
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (session()->has('pesan')) { ?>
                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('pesan'); ?>
                </div>
            <?php } ?>
            <?php echo form_open_multipart('Home/KirimDonasi') ?>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Rekening Tujuan</label>
                        <select class="form-control" name="id_rekening">
                            <?php foreach ($rek as $key => $value) { ?>
                                <option value="<?= $value['id_rekening'] ?>">
                                    <?= $value['nama_bank'] ?> |
                                    <?= $value['no_rek'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Jenis Donasi Untuk</label>
                        <select class="form-control" name="jenis_donasi">
                                <option value="Masjid">Masjid</option>
                                <option value="Sosial">Sosial</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Nama BANK Pengirim</label>
                <input class="form-control" name="nama_bank" required></input>
            </div>
            <div class="form-group">
                <label>No Rek Pengirim</label>
                <input class="form-control" name="no_rek" required></input>
            </div>
            <div class="form-group">
                <label>Nama Pengirim</label>
                <input class="form-control" name="nama_pengirim" required></input>
            </div>
            <div class="form-group">
                <label>Jumlah Donasi (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" required></input>
            </div>
            <div class="form-group">
                <label>Bukti Transfer</label>
                <input type="file" class="form-control" name="bukti"  accept="image/*" required></input>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Kirim</button>
        </div>
        <?php echo form_close() ?>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>