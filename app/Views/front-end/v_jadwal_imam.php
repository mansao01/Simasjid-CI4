<!-- Khotib/Pasaran -->
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title"  style="width:100%; text-align: center;">
                JADWAL KHOTIB DAN IMAM RAWATIB <br>
                MASJID AGUNG KUDUS
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="7%" class="text-center">NO</th>
                        <th width="40%"class="text-center">KHOTIB/PASARAN</th>
                        <th width="7%" class="text-center">NO</th>
                        <th class="text-center">IMAM/WAKTU</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datajadwal as $j) { ?>
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td>
                                <label>JUMU'AH PON</label><br>
                                <?= $j['pon_name'] ?>
                            </td>
                            <td class="text-center align-middle">1</td>
                            <td>
                                <label>DZUHUR</label> <br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;  margin-right: 38px;">IMAM </label> <!-- Teks "IMAM :" -->
                                    :&nbsp;<?= $j['imam_dzuhur_name'] ?> <br>
                                    <label class="grid-item" style="font-weight: normal; margin-right: 10px;">MUADZIN </label> <!-- Tambahkan label "IMAM :" -->
                                    :&nbsp;<?= $j['muadzin_dzuhur_name'] ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">2</td>
                            <td>
                                <label>JUMU'AH WAGE</label> <br>
                                <?= $j['wage_name'] ?>
                            </td>
                            <td class="text-center align-middle">2</td>
                            <td>
                                <label>ASHAR</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;  margin-right: 38px;">IMAM </label> <!-- Teks "IMAM :" -->
                                    :&nbsp;<?= $j['imam_asar_name'] ?> <br>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    :&nbsp;<?= $j['muadzin_asar_name'] ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">3</td>
                            <td>
                                <label>JUMU'AH KLIWON</label> <br>
                                <?= $j['kliwon_name'] ?>
                            <td class="text-center align-middle">3</td>
                            <td>
                                <label>MAGHRIB</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;  margin-right: 38px;">IMAM </label> <!-- Teks "IMAM :" -->
                                    :&nbsp;<?= $j['imam_maghrib_name'] ?> <br>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    :&nbsp;<?= $j['muadzin_maghrib_name'] ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">4</td>
                            <td>
                                <label>JUMU'AH LEGI</label> <br>
                                <?= $j['legi_name'] ?>
                            </td>
                            <td class="text-center align-middle">4</td>
                            <td>
                                <label>ISYA'</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;  margin-right: 38px;">IMAM </label> <!-- Teks "IMAM :" -->
                                    :&nbsp;<?= $j['imam_isya_name'] ?> <br>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    :&nbsp;<?= $j['muadzin_isya_name'] ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">5</td>
                            <td>
                                <label>JUMU'AH PAHING</label> <br>
                                <?= $j['pahing_name'] ?>
                            </td>
                            <td class="text-center align-middle">5</td>
                            <td>
                                <label>SUBUH</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;  margin-right: 38px;">IMAM </label> <!-- Teks "IMAM :" -->
                                    :&nbsp;<?= $j['imam_subuh_name'] ?> <br>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    :&nbsp;<?= $j['muadzin_subuh_name'] ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>