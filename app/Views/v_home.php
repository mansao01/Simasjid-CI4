<div class="col-lg-9">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?= base_url('uploads/' . $profil_masjid['gambar1']) ?>" width="1280" height="420" alt="..." class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p> -->
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?= base_url('uploads/' . $profil_masjid['gambar2']) ?>" width="1280" height="420" alt="..." class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>Second slide label</h5>
          <p>Some representative placeholder content for the second slide.</p> -->
        </div>
      </div>
      <div class="carousel-item">
      <img src="<?= base_url('uploads/' . $profil_masjid['gambar3']) ?>" width="1280" height="420" alt="..." class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p> -->
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>
  <br>
</div>

<!-- /.col -->
<div class="col-lg-3">
  <div class="card card-outline card-success">
    <div class="card-header">
      <h3 class="card-title text-success"><b>
          <?= $waktu['lokasi'] ?>
        </b>
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <ul class="products-list product-list-in-card pl-4 pr-2">
        <li class="item">
          <div class="product-img">
            <i class="far fa-clock fa-3x text-success"></i>
          </div>
          <div class="product-info">
            <a class="product-title">Subuh</a>
            <span class="product-description">
              <?= $waktu['jadwal']['subuh'] ?>
            </span>
          </div>
        </li>
        <li class="item">
          <div class="product-img">
            <i class="far fa-clock fa-3x text-success"></i>
          </div>
          <div class="product-info">
            <a class="product-title">Dzuhur</a>
            <span class="product-description">
              <?= $waktu['jadwal']['dzuhur'] ?>
            </span>
          </div>
        </li>
        <li class="item">
          <div class="product-img">
            <i class="far fa-clock fa-3x text-success"></i>
          </div>
          <div class="product-info">
            <a class="product-title">Ashar</a>
            <span class="product-description">
              <?= $waktu['jadwal']['ashar'] ?>
            </span>
          </div>
        </li>
        <li class="item">
          <div class="product-img">
            <i class="far fa-clock fa-3x text-success"></i>
          </div>
          <div class="product-info">
            <a class="product-title">Maghrib</a>
            <span class="product-description">
              <?= $waktu['jadwal']['maghrib'] ?>
            </span>
          </div>
        </li>
        <li class="item">
          <div class="product-img">
            <i class="far fa-clock fa-3x text-success"></i>
          </div>
          <div class="product-info">
            <a class="product-title">Isya</a>
            <span class="product-description">
              <?= $waktu['jadwal']['isya'] ?>
            </span>
          </div>
        </li>
      </ul>
      <div class="text-center pb-1">
        <b class="text-success">
          <?= $waktu['jadwal']['tanggal'] ?>
        </b>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

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
$pemasukan_hm = array_sum($pemasukan_m);
$pengeluaran_hm = array_sum($pengeluaran_m);
$saldo_m = array_sum($pemasukan_m) - array_sum($pengeluaran_m);

// if ($kas_s == null) {
//   $pemasukan_s[] = 0;
//   $pengeluaran_s[] = 0;
// } elseif (is_array($kas_s)) {
//   foreach ($kas_s as $key => $value) {
//     $pemasukan_s[] = $value['kas_masuk'];
//     $pengeluaran_s[] = $value['kas_keluar'];
//   }
// }
// $saldo_s = array_sum($pemasukan_s) - array_sum($pengeluaran_s);
?>

<div class="col-lg-12">
  <!-- Info boxes -->
  <div class="row">
    <!-- /.col -->
    <div class="col-md-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-wave"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pemasukan Kas Masjid</span>
          <span class="info-box-number">Rp.
            <?= number_format($pemasukan_hm, 0) ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pengeluaran Kas Masjid</span>
          <span class="info-box-number">Rp.
            <?= number_format($pengeluaran_hm, 0) ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-4">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-wallet"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Saldo Kas Masjid</span>
          <span class="info-box-number">Rp.
            <?= number_format($saldo_m, 0) ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>