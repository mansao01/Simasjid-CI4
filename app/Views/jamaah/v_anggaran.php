<!-- /.tabel-anggran-->
<?php $level = session()->get('level'); ?>
<div class="col-md-12">
    <?php
    if ($anggaran == null) {
        $pemasukan[] = 0;
    } elseif (is_array($anggaran)) {
        foreach ($anggaran as $key => $value) {
            $pemasukan[] = $value['biaya'];
        }
    }
    ?>
    <div class="alert alert-success alert-dismissible">
        <h5>Jumlah Anggaran Kegiatan</h5>
        <h3>
            Rp.
            <?= number_format(array_sum($pemasukan), 0) ?>
        </h3>
    </div>
</div>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">
                Anggaran
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th width="70px">NO</th>
                        <th>URAIAN</th>
                        <th width="200px">BIAYA</th>
                        <th width="30px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($anggaran as $key => $value) { ?>
                        <tr>
                            <td class="text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="text-center">
                                <?= $value['uraian'] ?>
                            </td>
                            <td class="text-right">
                                Rp. <?= number_format($value['biaya'], 0) ?>
                            </td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
