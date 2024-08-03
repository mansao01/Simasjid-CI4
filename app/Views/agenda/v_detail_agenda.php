<?php $role_id = session()->get('role_id'); ?>
<div class="col-md-12">
    <?php
    if ($detail_data == null) {
        $pemasukan[] = 0;
        $pengeluaran[] = 0;
    } elseif (is_array($detail_data)) {
        foreach ($detail_data as $key => $value) {
            $pemasukan[] = $value['pemasukan'];
            $pengeluaran[] = $value['pengeluaran'];
        }
    }
    $saldoakhir = array_sum($pemasukan) - array_sum($pengeluaran);
    ?>

    <?php if (session()->has('pesan')) : ?>
        <script>
            $(document).ready(function() {
                toastr.success('<?= session()->getFlashdata('pesan'); ?>');
            });
        </script>
    <?php endif; ?>
    <?php if (session()->has('errors')) : ?>
        <script>
            $(document).ready(function() {
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    toastr.error('<?= $error ?>');
                <?php endforeach; ?>
            });
        </script>
    <?php endif; ?>

    <div class="alert alert-primary alert-dismissible">
        <h5><i class="fas fa-money-bill-wave"></i> Dana Kegiatan</h5>
        Pemasukan
        <span style="margin-left: 9px;">: Rp.
            <?= number_format(array_sum($pemasukan), 0) ?>
        </span>
        <br>
        Pengeluaran
        <span style="margin-left: 3px;">: Rp.
            <?= number_format(array_sum($pengeluaran), 0) ?>
        </span>
        <hr style="width: 104%;">
        <h3 style="display: flex; width: 104%; justify-content: space-between; align-items: center;">
            <span>
                Saldo Akhir : Rp. <?= number_format($saldoakhir, 0) ?>
            </span>
            <?php if (!empty($detail_data)) : ?>
                <?php $id_agenda = $detail_data[0]['id_agenda']; // Mengambil id_agenda pertama 
                ?>
                <button type="button" class="btn btn-tool" style="background-color: blue; color: white; font-size: 18px;" onclick="printReport('<?= base_url('Agenda/CetakDanaKegiatan/' . $id_agenda) ?>')">
                    Cetak
                </button>
            <?php endif; ?>
        </h3>
    </div>
</div>
<!-- /.tabel-dana-pemasukan-->
<div class="col-md-6">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                Pemasukan
            </h3>
            <div class="card-tools">
                <!-- Tombol untuk Dana Masuk -->
                <button type="button" class="btn btn-tool" style="background-color: green; color: white;" data-toggle="modal" data-target="#modal-tambah-masuk">
                    <!-- Ikon "plus" menggunakan font-awesome -->
                    <i class="fas fa-plus"></i> Dana Masuk
                </button>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 350px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th width="100px">Nama</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                        <?php if ($role_id == 'pengurus') { ?>
                            <th width="100px">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($detail_data as $key => $value) {
                        if ($value['pemasukan'] !== null) { ?>
                            <tr class="<?= $value['pengeluaran'] === null ? 'text-success' : 'text-danger' ?>">
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= $value['nama_donatur'] ?>
                                </td>
                                <td>
                                    <?= $value['tanggal_transaksi'] ?>
                                </td>
                                <?php if ($value['pemasukan'] !== null) : ?>
                                    <td class="text-right">
                                        Rp. <?= number_format($value['pemasukan'], 0) ?>
                                    </td>
                                <?php endif; ?>
                                <?php if ($value['pengeluaran'] !== null) : ?>
                                    <td class="text-right">
                                        Rp. <?= number_format($value['pengeluaran'], 0) ?>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <img src="<?= base_url('bukti/' . $value['bukti']) ?>" width="50px" class="img-thumbnail" onclick="showFullImage('<?= base_url('bukti/' . $value['bukti']) ?>')">
                                </td>
                                <?php if ($role_id == 'pengurus') { ?>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit<?= $value['id_keuangan'] ?>"><i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete<?= $value['id_keuangan'] ?>"><i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /.tabel-dana-pengeluaran-->
<div class="col-md-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">
                Pengeluaran
            </h3>
            <div class="card-tools ml-3">
                <!-- Tombol untuk Dana Keluar -->
                <button type="button" class="btn btn-tool" style="background-color: red; color: white;" data-toggle="modal" data-target="#modal-tambah-keluar">
                    <!-- Ikon "plus" menggunakan font-awesome -->
                    <i class="fas fa-plus"></i> Dana Keluar
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 350px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Bukti</th>
                        <?php if ($role_id == 'pengurus') { ?>
                            <th width="100px">Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($detail_data as $key => $value) {
                        if ($value['pengeluaran'] !== null) { ?>
                            <tr class="<?= $value['pengeluaran'] === null ? 'text-success' : 'text-danger' ?>">
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= $value['tanggal_transaksi'] ?>
                                </td>
                                <td>
                                    <?= $value['keterangan'] ?>
                                </td>
                                <?php if ($value['pemasukan'] !== null) : ?>
                                    <td class="text-right">
                                        Rp. <?= number_format($value['pemasukan'], 0) ?>
                                    </td>
                                <?php endif; ?>
                                <?php if ($value['pengeluaran'] !== null) : ?>
                                    <td class="text-right">
                                        Rp. <?= number_format($value['pengeluaran'], 0) ?>
                                    </td>
                                <?php endif; ?>
                                <td>
                                    <img src="<?= base_url('bukti/' . $value['bukti']) ?>" width="50px" class="img-thumbnail" onclick="showFullImage('<?= base_url('bukti/' . $value['bukti']) ?>')">
                                </td>
                                <?php if ($role_id == 'pengurus') { ?>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-edit<?= $value['id_keuangan'] ?>"><i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete<?= $value['id_keuangan'] ?>"><i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                <?php } ?>
                            </tr>
                    <?php }
                    } ?>
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
                <h4 class="modal-title">Tambah Dana Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('Agenda/InsertDanaMasuk') ?>
                <input type="hidden" name="id_agenda" value="<?= $detail['id_agenda'] ?>">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dana_masuk">Jumlah (Rp.)</label>
                    <input type="number" id="dana_masuk" name="dana_masuk" min="0" value="0" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bukti">Bukti</label><br>
                    <input type="file" id="bukti" name="bukti" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
                <?= form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal-tambah-keluar -->
<div class="modal fade" id="modal-tambah-keluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Tambah Dana Keluar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('Agenda/InsertDanaKeluar') ?>
                <input value="<?= $detail['id_agenda'] ?>" name="id_agenda" hidden></input>
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
                    <input type="number" min="0" value="0" name="dana_keluar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="bukti">Bukti</label><br>
                    <input type="file" id="bukti" name="bukti" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Tambah</button>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal-edit -->
<?php foreach ($detail_data as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_keuangan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header <?= $value['pemasukan'] ? 'bg-warning' : 'bg-warning' ?>">
                    <h4 class="modal-title"><?= $value['pemasukan'] ? 'Ubah Dana Masuk' : 'Ubah Dana Keluar' ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('Agenda/EditDataKeuangan/'. $value['id_keuangan'] .'/' . $value['id_agenda']) ?>
                    <?php if ($value['pemasukan']) { ?>
                        <!-- Form untuk pemasukan -->
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input name="nama" value="<?= $value['nama_donatur'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" value="<?= $value['tanggal_transaksi'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah (Rp. )</label>
                            <input type="number" min="0" value="<?= $value['pemasukan'] ?>" name="dana_masuk" class="form-control" required>
                        </div>
                    <?php } else { ?>
                        <!-- Form untuk pengeluaran -->
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" name="tanggal" value="<?= $value['tanggal_transaksi'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input name="ket" value="<?= $value['keterangan'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah (Rp. )</label>
                            <input type="number" min="0" value="<?= $value['pengeluaran'] ?>" name="dana_keluar" class="form-control" required>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="">Bukti</label><br>
                        <?php if ($value['bukti']) { ?>
                            <div>
                                <img src="<?= base_url('bukti/' . $value['bukti']) ?>" width="100px" class="img-thumbnail mb-2" onclick="showFullImage('<?= base_url('bukti/' . $value['bukti']) ?>')">
                            </div>
                        <?php } ?>
                        <input type="file" name="bukti">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti bukti.</small>
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
<?php foreach ($detail_data as $key => $value) { ?>
    <!-- /.modal-edit -->
    <div class="modal fade" id="modal-delete<?= $value['id_keuangan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data Dana Kegiatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Yakin Ingin Menghapus Data?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="<?= base_url('Agenda/DeleteDataKeuangan/' . $value['id_keuangan'] . '/' . $value['id_agenda']) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>

<!-- Modal Gambar-->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Ukuran Penuh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="fullImage" src="" alt="Gambar Ukuran Penuh" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    function showFullImage(src) {
        // Set src dari gambar modal
        document.getElementById('fullImage').src = src;
        // Tampilkan modal
        $('#imageModal').modal('show');
    }
</script>

<script>
    function printReport(url) {
        var printWindow = window.open(url, 'PrintWindow', 'toolbar=no, width=1500, height=800, scrollbars=yes');

        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();

            // Tutup jendela cetak setelah beberapa detik
            setTimeout(function() {
                printWindow.close();
            }, 1000); // Sesuaikan waktu penundaan sesuai kebutuhan
        };
    }
</script>