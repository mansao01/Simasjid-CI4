<!-- Khotib/Pasaran -->
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title" style="width:100%; text-align: center;">
                JADWAL KHOTIB DAN IMAM RAWATIB <br>
                MASJID AGUNG KUDUS
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
            <?php echo form_open('ImamKhotib/UpdateSetting') ?>
            <input type="hidden" name="id_jadwal" value="<?= $datajadwal[0]['id_jadwal'] ?>">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">KHOTIB/PASARAN</th>
                        <th class="text-center">NO</th>
                        <th class="text-center">IMAM/WAKTU</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datajadwal as $j) { ?>
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td>
                                <label>JUMU'AH PON</label>
                                <select name="pon" class="form-control select2">
                                    <?php foreach ($petugas as $p) { ?>
                                        <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['pon'] ? 'selected' : '' ?>>
                                            <?= $p['nama_petugas'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center align-middle">1</td>
                            <td>
                                <label>DZUHUR</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;">IMAM :</label> <!-- Teks "IMAM :" -->
                                    <select name="imam_dzuhur" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['imam_dzuhur'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="muadzin_dzuhur" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['muadzin_dzuhur'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">2</td>
                            <td>
                                <label>JUMU'AH WAGE</label>
                                <select name="wage" class="form-control select2">
                                    <?php foreach ($petugas as $p) { ?>
                                        <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['wage'] ? 'selected' : '' ?>>
                                            <?= $p['nama_petugas'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center align-middle">2</td>
                            <td>
                                <label>ASHAR</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;">IMAM :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="imam_asar" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['imam_asar'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="muadzin_asar" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['muadzin_asar'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">3</td>
                            <td>
                                <label>JUMU'AH KLIWON</label>
                                <select name="kliwon" class="form-control select2">
                                    <?php foreach ($petugas as $p) { ?>
                                        <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['kliwon'] ? 'selected' : '' ?>>
                                            <?= $p['nama_petugas'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center align-middle">3</td>
                            <td>
                                <label>MAGHRIB</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;">IMAM :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="imam_maghrib" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['imam_maghrib'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="muadzin_maghrib" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['muadzin_maghrib'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">4</td>
                            <td>
                                <label>JUMU'AH LEGI</label>
                                <select name="legi" class="form-control select2">
                                    <?php foreach ($petugas as $p) { ?>
                                        <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['legi'] ? 'selected' : '' ?>>
                                            <?= $p['nama_petugas'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center align-middle">4</td>
                            <td>
                                <label>ISYA'</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;">IMAM :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="imam_isya" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['imam_isya'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="muadzin_isya" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['muadzin_isya'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">5</td>
                            <td>
                                <label>JUMU'AH PAHING</label>
                                <select name="pahing" class="form-control select2">
                                    <?php foreach ($petugas as $p) { ?>
                                        <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['pahing'] ? 'selected' : '' ?>>
                                            <?= $p['nama_petugas'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="text-center align-middle">5</td>
                            <td>
                                <label>SUBUH</label><br>
                                <div class="form-group grid-container">
                                    <label class="grid-item" style="font-weight: normal;">IMAM :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="imam_subuh" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['imam_subuh'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <label class="grid-item" style="font-weight: normal;">MUADZIN :</label> <!-- Tambahkan label "IMAM :" -->
                                    <select name="muadzin_subuh" class="form-control select2 grid-item">
                                        <?php foreach ($petugas as $p) { ?>
                                            <option value="<?= $p['id_petugas'] ?>" <?= $p['id_petugas'] == $j['muadzin_subuh'] ? 'selected' : '' ?>>
                                                <?= $p['nama_petugas'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>