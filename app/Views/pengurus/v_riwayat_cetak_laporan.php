<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <?= $judul ?>
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table" id="example1">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal Cetak</th>
                        <th>Nama</th>
                        <th>Rentan Tanggal</th>
                        <th>Saldo</th>
                        <!-- <th>Ketua Umum</th>
                        <th>Bendahara</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($riwayat as $laporan) { ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++ ?></td>
                            <td style="text-align: center;"><?= date('d-m-Y', strtotime($laporan['tgl_cetak'])) ?></td>
                            <td><?= $laporan['nama_user'] ?></td>
                            <td style="text-align : center;"><?= date('d-m-Y', strtotime($laporan['tgl_awal'])) ?>/
                                <?= date('d-m-Y', strtotime($laporan['tgl_akhir'])) ?></td>
                            <td>Rp. <?= number_format($laporan['saldo'], 0) ?></td>
                            <!-- <td><?= $laporan['ketua_umum'] ?></td>
                            <td><?= $laporan['bendahara'] ?></td> -->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>