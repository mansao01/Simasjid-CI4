<?php $level = session()->get('level'); ?>
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
                <?php if (isset($detail['status']) && $detail['status'] == "selesai" && $level == 'admin') : ?>
                    <button type="button" class="btn btn-tool" style="background-color: blue; color: white; font-size: 18px;" onclick="printReport('<?= base_url('Agenda/CetakDanaKegiatan/' . $id_agenda) ?>')">
                        Cetak
                    </button>
                <?php endif; ?>
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
                                    <?= date('d-m-Y', strtotime($value['tanggal_transaksi'])) ?>
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
                                    <?= date('d-m-Y', strtotime($value['tanggal_transaksi'])) ?>
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
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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