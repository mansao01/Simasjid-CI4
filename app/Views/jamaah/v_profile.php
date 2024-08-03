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
            <?php endif; ?>
            <?= form_open('Profile/UpdateProfile/' . $profilejamaah['id_user']) ?>

            <!-- Form Fields with Bootstrap Grid -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input name="nama" value="<?= $profilejamaah['nama_user'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone</label>
                        <input type="number" name="no_hp" value="<?= $profilejamaah['no_hp'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input name="email" value="<?= $profilejamaah['email'] ?>" class="form-control" readonly>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">Update</button>
            <?php echo form_close() ?>
        </div>
    </div>
</div>


