<?php
if ($kas_m == null) {
    $pemasukan_m[] = 0;
    $pengeluaran_m[] = 0;
} elseif (is_array($kas_m)) {
    foreach ($kas_m as $key => $value) {
        $pemasukan_m[] = $value['kas_masuk'];
        $pengeluaran_m[] = $value['kas_keluar'];
    }
}
$total_pemasukan = array_sum($pemasukan_m);
$total_pengeluaran = array_sum($pengeluaran_m);
$saldo_m = $total_pemasukan - $total_pengeluaran;

// if ($kas_s == null) {
//     $pemasukan_s[] = 0;
//     $pengeluaran_s[] = 0;
// } elseif (is_array($kas_s)) {
//     foreach ($kas_s as $key => $value) {
//         $pemasukan_s[] = $value['kas_masuk'];
//         $pengeluaran_s[] = $value['kas_keluar'];
//     }
// }
// $total_pemasukan = array_sum($pemasukan_s);
// $total_pengeluaran = array_sum($pengeluaran_s);
// $saldo_s = $total_pemasukan - $total_pengeluaran;
?>
<!-- ./Total Pemasukan -->
<div class="col-lg-4 col-12">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h4>Total Pemasukan</h4>
            <h3>Rp.
                <?= number_format($total_pemasukan, 0) ?>,-
            </h3>
        </div>
        <div class="icon">
            <i class="fas fa-money-bill-wave"></i>
        </div>
        <a href="<?= base_url('KasMasjid/KasMasuk') ?>" class="small-box-footer">Rincian <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./Total Pengeluaran -->
<div class="col-lg-4 col-12">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h4>Total Pengeluaran</h4>
            <h3>Rp.
                <?= number_format($total_pengeluaran, 0) ?>,-
            </h3>
        </div>
        <div class="icon">
            <i class="fas fa-hand-holding-usd"></i>
        </div>
        <a href="<?= base_url('KasMasjid/KasKeluar') ?>" class="small-box-footer">Rincian <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./Total Saldo -->
<div class="col-lg-4 col-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Saldo Keuangan Masjid</h4>
            <h3>Rp.
                <?= number_format($saldo_m, 0) ?>,-
            </h3>
        </div>
        <div class="icon">
            <i class="fas fa-wallet"></i>
        </div>
        <a href="<?= base_url('KasMasjid') ?>" class="small-box-footer">Rincian <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./Grafik -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Kas Masjid</h3>
                <a href="<?= base_url('Admin/GrafikKas') ?>">View Report</a>
            </div>
        </div>
        <div class="card-body">
            <!-- <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Rp. <?php echo number_format($total_kas, 2, ',', '.'); ?></span>
                    <span>Total Pemasukan Bulan Ini</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                    <span
                        class="<?php echo $persentase_perubahan_kas_masuk > 0 ? 'text-success' : ($persentase_perubahan_kas_masuk < 0 ? 'text-danger' : 'text-primary'); ?>">
                        <?php if ($persentase_perubahan_kas_masuk > 0) : ?>
                            <i class="fas fa-arrow-up"></i>
                            <?php echo number_format($persentase_perubahan_kas_masuk, 1); ?>%
                        <?php elseif ($persentase_perubahan_kas_masuk < 0) : ?>
                            <i class="fas fa-arrow-down"></i>
                            <?php echo number_format(abs($persentase_perubahan_kas_masuk), 1); ?>%
                        <?php else : ?>
                            <i class="fas fa-arrow-right"></i> 0%
                        <?php endif; ?>
                    </span>
                    <span class="text-muted">Pemasukan Dari Bulan Lalu</span>
                </p>
            </div> -->
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
                <canvas id="sales-chart" height="200"></canvas>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
<!-- ./Grafik Dana Kegiatan -->
<div class="col-lg-6">
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Dana Kegiatan</h3>
                <a href="<?= base_url('Admin/GrafikDanaKegiatan') ?>">View Report</a>
            </div>
        </div>
        <div class="card-body">
            <div class="position-relative mb-4">
                <canvas id="sales-chart-1" height="200"></canvas>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>

<!--/.Kas Masjid 
    <div class="col-lg-6 col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                Rekap Kas Masjid Bulan
                <?= date('M Y') ?>
            </h3>
        </div>
        /.card-header
        <div class="card-body">
            <table class="table text-sm">
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
                    foreach ($kasmasjid as $key => $value) { ?>
                        <tr class="<?= $value['status'] == 'Masuk' ? 'text-success' : 'text-danger' ?>">
                            <td>
                                <?= $no++ ?>
                            </td>
                            <td>
                                <?= $value['tanggal'] ?>
                            </td>
                            <td>
                                <?= $value['ket'] ?>
                            </td>
                            <td class="text-right">
                                Rp.
                                <?= number_format($value['kas_masuk'], 0) ?>
                            </td>
                            <td class="text-right">
                                Rp.
                                <?= number_format($value['kas_keluar'], 0) ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
<!-- ./Menampilkan Data Kas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("sales-chart").getContext("2d");

        // Menggabungkan nama bulan dan tahun
        var labels = <?= json_encode(array_map(function($item) {
            return $item['nama_bulan'] . ' ' . $item['tahun'];
        }, $sales_data)) ?>;

        var salesChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "Pemasukan",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($sales_data, 'total_kas_masuk')) ?>,
                }, {
                    label: "Pengeluaran",
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($sales_data, 'total_kas_keluar')) ?>,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<!-- ./Menampilkan Data Dana Kegiatan -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("sales-chart-1").getContext("2d");

        var salesChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: <?= json_encode(array_column($dana_kegiatan, 'kegiatan')) ?>,
                datasets: [{
                    label: "Pemasukan",
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($dana_kegiatan, 'total_pemasukan')) ?>,
                }, {
                    label: "Pengeluaran",
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    data: <?= json_encode(array_column($dana_kegiatan, 'total_pengeluaran')) ?>,
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            autoSkip: false, // Menonaktifkan penjajaran otomatis
                            maxRotation: -90, // Rotasi maksimum label (dalam derajat)
                            minRotation: -90, // Rotasi minimum label (dalam derajat)
                            padding: 10, // Padding antara label dan sumbu
                            mirror: true // Memperluas label di luar sumbu
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>