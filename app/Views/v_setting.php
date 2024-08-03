<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                <?= $judul ?>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php if (session()->has('pesan')) : ?>
                <script>
                    $(document).ready(function() {
                        toastr.success('<?= session()->getFlashdata('pesan'); ?>');
                    });
                </script>
            <?php elseif (session()->has('errors')) : ?>
                <script>
                    $(document).ready(function() {
                        let errors = <?= json_encode(session()->getFlashdata('errors')) ?>;
                        for (let error in errors) {
                            toastr.error(errors[error]);
                        }
                    });
                </script>
            <?php endif; ?>

            <?= form_open_multipart('Admin/UpdateSetting') ?>
            <div class="form-group">
                <label>Nama Masjid</label>
                <input name="nama_masjid" value="<?= $setting['nama_masjid'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Kab/Kota</label>
                <select name="id_kota" class="form-control select2">
                    <?php foreach ($kota as $key => $idkota) { ?>
                        <option value="<?= $idkota['id'] ?>" <?= $idkota['id'] == $setting['id_kota'] ? 'selected' : '' ?>>
                            <?= $idkota['lokasi'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" value="<?= $setting['alamat'] ?>" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gambar 1</label><br>
                        <?php if ($setting['gambar1']) { ?>
                            <div>
                                <img src="<?= base_url('uploads/' . $setting['gambar1']) ?>" style="max-height: 100px;" class="img-thumbnail mb-2" onclick="showFullImage('<?= base_url('uploads/' . $setting['gambar1']) ?>')">
                            </div>
                        <?php } ?>
                        <input type="file" name="gambar1">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                        <small class="form-text text-muted">Gambar akan ditampilkan dengan ukuran 1280x420.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gambar 2</label><br>
                        <?php if ($setting['gambar2']) { ?>
                            <div>
                                <img src="<?= base_url('uploads/' . $setting['gambar2']) ?>" style="max-height: 100px;" class="img-thumbnail mb-2" onclick="showFullImage('<?= base_url('uploads/' . $setting['gambar2']) ?>')">
                            </div>
                        <?php } ?>
                        <input type="file" name="gambar2">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                        <small class="form-text text-muted">Gambar akan ditampilkan dengan ukuran 1280x420.</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Gambar 3</label><br>
                        <?php if ($setting['gambar3']) { ?>
                            <div>
                                <img src="<?= base_url('uploads/' . $setting['gambar3']) ?>" style="max-height: 100px;" class="img-thumbnail mb-2" onclick="showFullImage('<?= base_url('uploads/' . $setting['gambar3']) ?>')">
                            </div>
                        <?php } ?>
                        <input type="file" name="gambar3">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                        <small class="form-text text-muted">Gambar akan ditampilkan dengan ukuran 1280x420.</small>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">Simpan</button>
            <?= form_close() ?>
        </div>
    </div>
</div>