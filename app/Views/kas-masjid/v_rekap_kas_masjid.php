<div class="col-md-12">
    <?php
    if ($kas == null) {
        $pemasukan[] = 0;
        $pengeluaran[] = 0;
    } elseif (is_array($kas)) {
        foreach ($kas as $key => $value) {
            $pemasukan[] = $value['kas_masuk'];
            $pengeluaran[] = $value['kas_keluar'];
        }
    }
    $saldoakhir = array_sum($pemasukan) - array_sum($pengeluaran);
    ?>
    <div class="alert alert-primary alert-dismissible">
        <h5><i class="fas fa-wallet"></i> Saldo Kas Masjid</h5>
        Pemasukan
        <span style="margin-left: 9px;">: Rp.
            <?= number_format(array_sum($pemasukan), 0) ?>
        </span>
        <br>
        pengeluaran
        <span style="margin-left: 3px;">: Rp.
            <?= number_format(array_sum($pengeluaran), 0) ?>
        </span>
        <hr style="width: 103.5%;">
        <h3>
            Saldo Akhir : Rp.
            <?= number_format($saldoakhir, 0) ?>
        </h3>
    </div>
</div>

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
                        <th width="30px">No</th>
                        <th width="100px">Tanggal</th>
                        <th>Keterangan</th>
                        <th>Kas Masuk</th>
                        <th>Kas Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kas as $key => $value) { ?>
                        <tr class="<?= $value['status'] == 'Masuk' ? 'text-success' : 'text-danger' ?>">
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <?= date('d-m-Y', strtotime($value['tanggal'])) ?>
                            </td>
                            <td>
                                <?= $value['ket'] ?>
                            </td>
                            <td class="text-right"><?= $value['kas_masuk'] != 0 ? 'Rp. ' . number_format($value['kas_masuk'], 0) : '' ?></td>
                            <td class="text-right"><?= $value['kas_keluar'] != 0 ? 'Rp. ' . number_format($value['kas_keluar'], 0) : '' ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>