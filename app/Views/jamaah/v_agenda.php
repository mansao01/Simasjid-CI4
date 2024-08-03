<!-- /.col -->
<?php $role_id = session()->get('role_id'); ?>
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Data
                <?= $judul ?>
            </h3>
            <!-- /.card-tools -->
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
            <table class="table" id="example1">
                <thead style="text-align: center;">
                    <tr>
                        <th width="5%">No</th>
                        <th width="8%"></th>
                        <th>Nama Agenda</th>
                        <?php if (!empty($agenda) && $agenda[0]['status'] == 'selesai') { ?>
                            <th width="13%">Rating</th>
                        <?php } ?>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($agenda as $key => $value) { ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle; height: 65px;">
                                <h5><b><?= $no++ ?></b></h5>
                            </td>
                            <td style="text-align: center; vertical-align: middle; height: 65px;">
                                <i class="fas fa-bullhorn fa-3x text-success"></i>
                            </td>
                            <td>
                                <h5><b><?= $value['nama_kegiatan'] ?></b></h5>
                                <div class="agenda-details">
                                    <div class="agenda-info">
                                        Tanggal : <?= $value['tanggal'] ?><br>
                                        Jam : <?= $value['jam'] ?> - Selesai<br>
                                        Tempat : <?= $value['Tempat'] ?>
                                    </div>
                                    <div class="agenda-personnel">
                                        Ketua : <?= $value['ketua'] ?><br>
                                        Sekretaris : <?= $value['sekertaris'] ?><br>
                                        Bendahara : <?= $value['bendahara'] ?>
                                    </div>
                                </div>
                            </td>

                            <?php if ($value['status'] == 'selesai') { ?>
                                <td style="text-align: center; vertical-align: middle; height: 65px;">
                                    <div class="star-rating" data-id-agenda="<?= $value['id_agenda'] ?>" data-toggle="modal">
                                        <span class="fa fa-star <?= $value['rating'] >= 5 ? 'checked' : '' ?>"></span>
                                        <span class="fa fa-star <?= $value['rating'] >= 4 ? 'checked' : '' ?>"></span>
                                        <span class="fa fa-star <?= $value['rating'] >= 3 ? 'checked' : '' ?>"></span>
                                        <span class="fa fa-star <?= $value['rating'] >= 2 ? 'checked' : '' ?>"></span>
                                        <span class="fa fa-star <?= $value['rating'] >= 1 ? 'checked' : '' ?>"></span>
                                    </div>
                                </td>
                                <td style="text-align: center; vertical-align: middle; height: 65px;">
                                    <a href="<?= base_url('Agenda/LihatAnggaranSelesai/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-success"><i class="fas fa-layer-group"></i> Anggaran</a>
                                    <a href="<?= base_url('Agenda/LihatDanaKegiatanSelesai/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-layer-group"></i> Dana Kegiatan</a>
                                </td>
                            <?php } elseif ($value['status'] == 'berjalan') { ?>
                                <td style="text-align: center; vertical-align: middle; height: 65px;">
                                    <a href="<?= base_url('Agenda/LihatAnggaranBerjalan/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-success"><i class="fas fa-layer-group"></i> Anggaran</a>
                                    <a href="<?= base_url('Agenda/LihatDanaKegiatanBerjalan/' . $value['id_agenda']) ?>" class="btn btn-flat btn-sm btn-primary"><i class="fas fa-layer-group"></i> Dana Kegiatan</a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- /.Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah
                    <?= $judul ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('Agenda/InsertData') ?>
                <div class="form-group">
                    <label>Nama Kegiatan</label>
                    <textarea rows="6" name="nama_kegiatan" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" name="tanggal"></input>
                </div>
                <div class="form-group">
                    <label>Jam</label>
                    <input type="time" class="form-control" name="jam"></input>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.Modal Edit -->
<?php foreach ($agenda as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_agenda'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open('Agenda/UpdateData/' . $value['id_agenda']) ?>
                    <div class="form-group">
                        <label>Nama Kegiatan</label>
                        <textarea rows="6" name="nama_kegiatan" class="form-control" required><?= $value['nama_kegiatan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" value="<?= $value['tanggal'] ?>" name="tanggal"></input>
                    </div>
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="time" class="form-control" value="<?= $value['jam'] ?>" name="jam"></input>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.Modal Delete -->
    <div class="modal fade" id="modal-delete<?= $value['id_agenda'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete
                        <?= $judul ?>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Ingin Hapus Data ? <br>
                    <b>
                        <?= $value['nama_kegiatan'] ?>
                    </b>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?= base_url('Agenda/DeleteData/' . $value['id_agenda']) ?>" class="btn btn-danger">Delete</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Modal Rating -->
    <?php foreach ($agenda as $key => $value) { ?>
        <div class="modal fade" id="modal-rating<?= $value['id_agenda'] ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Beri Rating <?= $value['nama_kegiatan'] ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('Agenda/saveRating') ?>
                        <input type="hidden" name="id_agenda" value="<?= $value['id_agenda'] ?>">
                        <div class="form-group">
                            <label>Rating (1-5)</label>
                            <div class="star-rating">
                                <input id="star5-<?= $value['id_agenda'] ?>" name="rating" type="radio" value="5" class="radio-btn hide" required />
                                <label for="star5-<?= $value['id_agenda'] ?>">☆</label>
                                <input id="star4-<?= $value['id_agenda'] ?>" name="rating" type="radio" value="4" class="radio-btn hide" required />
                                <label for="star4-<?= $value['id_agenda'] ?>">☆</label>
                                <input id="star3-<?= $value['id_agenda'] ?>" name="rating" type="radio" value="3" class="radio-btn hide" required />
                                <label for="star3-<?= $value['id_agenda'] ?>">☆</label>
                                <input id="star2-<?= $value['id_agenda'] ?>" name="rating" type="radio" value="2" class="radio-btn hide" required />
                                <label for="star2-<?= $value['id_agenda'] ?>">☆</label>
                                <input id="star1-<?= $value['id_agenda'] ?>" name="rating" type="radio" value="1" class="radio-btn hide" required />
                                <label for="star1-<?= $value['id_agenda'] ?>">☆</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Komentar</label>
                            <textarea name="komentar" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    <?php } ?>
<?php } ?>
<!-- Modal Detail -->
<?php foreach ($agenda as $key => $value) { ?>
    <!-- Modal untuk menampilkan detail penilaian -->
    <div class="modal fade" id="modal-detail<?= $value['id_agenda'] ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Penilaian <?= htmlspecialchars($value['nama_kegiatan']) ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    // Filter penilaian untuk id_agenda saat ini
                    $penilaians = array_filter($agenda1, function ($rating) use ($value) {
                        return $rating['id_agenda'] == $value['id_agenda'];
                    });
                    ?>
                    <?php if (!empty($penilaians)) : ?>
                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th width="30%">User</th>
                                    <th width="30%">Rating</th>
                                    <th>Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($penilaians as $rating) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($rating['nama_user']) ?></td>
                                        <td class="text-center">
                                            <div class="star-rating">
                                                <span class="fa fa-star <?= $rating['rating'] >= 5 ? 'checked' : '' ?>"></span>
                                                <span class="fa fa-star <?= $rating['rating'] >= 4 ? 'checked' : '' ?>"></span>
                                                <span class="fa fa-star <?= $rating['rating'] >= 3 ? 'checked' : '' ?>"></span>
                                                <span class="fa fa-star <?= $rating['rating'] >= 2 ? 'checked' : '' ?>"></span>
                                                <span class="fa fa-star <?= $rating['rating'] >= 1 ? 'checked' : '' ?>"></span>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($rating['komentar']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <p>No ratings available.</p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            const userLevel = '<?= session()->get('role_id') ?>'; // Mendapatkan role_id pengguna

            $('.star-rating').on('click', 'span', function() {
                const idAgenda = $(this).closest('.star-rating').data('id-agenda');

                if (userLevel === 'admin') {
                    // Tampilkan modal detail jika admin
                    $('#modal-detail' + idAgenda).modal('show');
                } else {
                    // Tampilkan modal rating jika bukan admin
                    $('#modal-rating' + idAgenda).modal('show');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const stars = document.querySelectorAll('.star-rating input');
            stars.forEach(star => {
                star.addEventListener('change', () => {
                    const rating = star.value;
                    console.log(`Rating selected: ${rating}`);
                    // You can perform additional actions here, such as submitting the form automatically
                });
            });
        });
    </script>


<?php } ?>