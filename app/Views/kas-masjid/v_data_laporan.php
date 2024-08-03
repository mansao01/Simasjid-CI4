<!DOCTYPE html>
<html>

<head>
  <title>Laporan Kas Masjid</title>
  <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/laporan.css">
</head>

<body>
  <form id="formLaporan" name="formLaporan" method="POST" action="<?= base_url('v_laporan_kas_masjid/SaveAndPrintLaporan') ?>">
    <input type="hidden" id="saldoAkhir" name="saldoAkhir" value="<?= $saldoAkhir ?>">
    <input type="hidden" id="totalPemasukan" name="totalPemasukan" value="<?= $totalPemasukan ?>">
    <input type="hidden" id="totalPengeluaran" name="totalPengeluaran" value="<?= $totalPengeluaran ?>">
    <input type="hidden" id="saldoSebelumnya" name="saldoSebelumnya" value="<?= $saldoSebelumTglAwal ?>">
    <input type="hidden" id="saldoSetelahnya" name="saldoSetelahnya" value="<?= $totalsaldosetelah ?>">
    <input type="hidden" id="namaKetua" name="namaKetua" value="<?= $namaKetua ?>">
    <input type="hidden" id="namaBendahara" name="namaBendahara" value="<?= $namaBendahara ?>">
  </form>
  <h3 style="text-align: center;"><b>LAPORAN KEUANGAN <?= strtoupper($masjid['nama_masjid']) ?><br>
      <?= $judultglawal ?> - <?= $judultglakhir ?></b></h3>
  <table class="table table-bordered" style="font-family: 'Times New Roman';
            font-size: 14px;">
    <tr class="keterangan">
      <th width="5%">No</th>
      <th width="8%">TANGGAL</th>
      <th width="30%">URAIAN</th>
      <th width="19%">MASUK</th>
      <th width="19%">KELUAR</th>
      <th width="19%">SALDO</th>
    </tr>
    <tr>
      <th colspan="3" class="text-center">Saldo Sebelum Tanggal <?= date('d-m-Y', strtotime($tglAwal)) ?></th>
      <th class="text-right">Rp. <?= number_format($totalPemasukanBefore, 0) ?></th>
      <th class="text-right">Rp. <?= number_format($totalPengeluaranBefore, 0) ?></th>
      <th class="text-right">Rp. <?= number_format($saldoSebelumTglAwal, 0) ?></th>
    </tr>
    <?php $no = 1;
    $saldo = $saldoSebelumTglAwal;
    foreach ($kas as $key => $value) {
      $saldo += $value['kas_masuk'] - $value['kas_keluar'];
    ?>
      <tr>
        <td style="text-align:center"><?= $no++ ?></td>
        <td class="text-right"><?= date('d-m-Y', strtotime($value['tanggal'])) ?></td>
        <td class="<?= $value['kas_masuk'] != 0 ? 'text-right' : '' ?>"><?= $value['ket'] ?></td>
        <td class="text-right"><?= $value['kas_masuk'] != 0 ? 'Rp. ' . number_format($value['kas_masuk'], 0) : '' ?></td>
        <td class="text-right"><?= $value['kas_keluar'] != 0 ? 'Rp. ' . number_format($value['kas_keluar'], 0) : '' ?></td>
        <td class="text-right">Rp. <?= number_format($saldo, 0) ?></td>
      </tr>
    <?php } ?>
    <tr>
      <th colspan="3" class="text-center">Saldo <?= date('d-m-Y', strtotime($tglAwal)) ?> Sampai <?= date('d-m-Y', strtotime($tglAkhir)) ?></th>
      <th class="text-right">Rp. <?= number_format($totalPemasukan, 0) ?></th>
      <th class="text-right">Rp. <?= number_format($totalPengeluaran, 0) ?></th>
      <th class="text-right">Rp. <?= number_format($saldoAkhir, 0) ?></th>
    </tr>
    <tr>
      <th colspan="3" class="text-center">Total Saldo Sampai <?= date('d-m-Y', strtotime($tglAkhir)) ?></th>
      <th class="text-right">Rp. <?= number_format($totalPemasukan + $totalPemasukanBefore, 0) ?></th>
      <th class="text-right">Rp. <?= number_format($totalPengeluaran + $totalPengeluaranBefore, 0) ?></th>
      <th class="text-right">Rp. <?= number_format($totalsaldosetelah, 0) ?></th>
    </tr>
  </table>

  <div class="signature-section">
    <div class="signature">
      <p>Mengetahui<br>Ketua Umum</p>
      <p class="name"><?= $namaKetua ?></p>
    </div>
    <div class="signature signature-right">
      <p>Kudus, <?= $tanggalSekarang ?><br>Bendahara</p>
      <p class="name"><?= $namaBendahara ?></p>
    </div>
  </div>
</body>

</html>