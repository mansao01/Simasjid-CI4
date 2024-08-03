<?php
function formatTanggal($tanggal) {
    $bulanIndonesia = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember',
    ];

    $date = new DateTime($tanggal);
    $bulanInggris = $date->format('F'); // Bulan dalam bahasa Inggris
    $bulanTerjemahan = $bulanIndonesia[$bulanInggris];
    return $date->format('d') . ' ' . $bulanTerjemahan . ' ' . $date->format('Y');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan <?= $detail['nama_kegiatan'] ?></title>
    <style>
        body {
            font-family: 'Calibri';
        }

        .container {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
        }

        .section {
            width: 49.5%;
            /* Lebar setengah dari container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .total {
            font-weight: bold;
        }
        h2{
            font-size: 12px;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Keuangan <?= $detail['nama_kegiatan'] ?></h2>

    <div class="container">
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <td colspan="3" class="total">&nbsp;PEMASUKAN</td>
                    </tr>
                    <tr>
                        <th width="30px">NO</th>
                        <th>NAMA</th>
                        <th>PEMASUKAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_pemasukan = 0;
                    foreach ($detail_data as $value) {
                        if ($value['pemasukan'] !== null) {
                            $total_pemasukan += $value['pemasukan'];
                    ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: left;">&nbsp;<?= $value['nama_donatur'] ?></td>
                                <td>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="text-align: left;">&nbsp;Rp.</span>
                                        <span style="text-align: right; flex-shrink: 0;"><?= number_format($value['pemasukan'], 0) ?>&nbsp;</span>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="total" style="text-align: center;">&nbsp;Total Pemasukan</td>
                        <td class="total">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="text-align: left;">&nbsp;Rp.</span>
                                <span style="text-align: right; flex-shrink: 0;"><?= number_format($total_pemasukan, 0) ?>&nbsp;</span>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="section">
            <table>
                <thead>
                    <tr>
                        <td colspan="3" class="total">&nbsp;PENGELUARAN</td>
                    </tr>
                    <tr>
                        <th>TANGGAL</th>
                        <th>URAIAN</th>
                        <th>PENGELUARAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_pengeluaran = 0;
                    foreach ($detail_data as $value) {
                        if ($value['pengeluaran'] !== null) {
                            $total_pengeluaran += $value['pengeluaran'];
                    ?>
                            <tr>
                            <td>&nbsp;<?= formatTanggal($value['tanggal_transaksi']) ?></td>
                                <td style="text-align: left;">&nbsp;<?= $value['keterangan'] ?></td>
                                <td>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="text-align: left;">&nbsp;Rp.</span>
                                        <span style="text-align: right; flex-shrink: 0;"><?= number_format($value['pengeluaran'], 0) ?>&nbsp;</span>
                                    </div>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="total" style="text-align: center;">&nbsp;Total Pengeluaran</td>
                        <td class="total">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="text-align: left;">&nbsp;Rp.</span>
                                <span style="text-align: right; flex-shrink: 0;"><?= number_format($total_pengeluaran, 0) ?>&nbsp;</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="total"  style="text-align: center;">&nbsp;Saldo</td>
                        <td class="total">
                            <div style="display: flex; justify-content: space-between;">
                                <span style="text-align: left;">&nbsp;Rp.</span>
                                <span style="text-align: right; flex-shrink: 0;"><?= number_format($total_pemasukan - $total_pengeluaran, 0) ?>&nbsp;</span>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>