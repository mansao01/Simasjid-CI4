<!-- /.col -->
<div class="col-md-12">
    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Laporan Kas Masjid</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form id="formLaporan" name="form10" action="your-action-url" method="post" target="_self" style="margin-bottom: 30px;">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="txtTglAwal">Tanggal Mulai</label>
                            <input name="txtTglAwal" id="txtTglAwal" type="date" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="txtTglAkhir">Tanggal Akhir</label>
                            <input name="txtTglAkhir" id="txtTglAkhir" type="date" class="form-control" required />
                        </div>
                    </div>
                    <div class="col-lg-3 d-flex align-items-end">
                        <div class="form-group">
                            <label>&nbsp;</label> <!-- Adding a label to align the button correctly -->
                            <div>
                                <button type="button" class="btn btn-primary" id="btnView">View</button>
                                <button type="button" class="btn btn-success ml-2" id="btnPrint"><i class="fas fa-print"></i> Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-sm-12" id="printarea">
                <div id="laporanTitle" style="text-align: center;">
                    <p style="margin-top: 50px;">
                    <h3><b>LAPORAN KEUANGAN <?= strtoupper($masjid['nama_masjid']) ?></b><br></h3>
                    <?= $masjid['alamat'] ?></p><br>
                </div>

                <div class="Tabel">
                    <!-- Tabel data laporan akan diisi di sini melalui AJAX -->
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btnView').addEventListener('click', function() {
            ViewLaporan();
        });

        document.getElementById('btnPrint').addEventListener('click', function() {
            SaveAndPrintLaporan();
        });
    });

    function ViewLaporan() {
        let tglAwal = document.getElementById('txtTglAwal').value;
        let tglAkhir = document.getElementById('txtTglAkhir').value;

        if (!tglAwal) {
            alert('Tanggal awal belum dipilih!');
        } else if (!tglAkhir) {
            alert('Tanggal akhir belum dipilih!');
        } else if (tglAwal > tglAkhir) {
            alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir!');
        } else {
            // Sembunyikan judul laporan
            document.getElementById('laporanTitle').style.display = 'none';

            $.ajax({
                type: "POST",
                url: "<?= base_url('KasMasjid/ViewLaporan') ?>",
                data: {
                    txtTglAwal: tglAwal,
                    txtTglAkhir: tglAkhir,
                },
                dataType: "JSON",
                beforeSend: function() {
                    // Tampilkan pesan loading atau indikator lainnya
                },
                success: function(response) {
                    if (response.data) {
                        document.querySelector('.Tabel').innerHTML = response.data;
                    } else {
                        alert('Tidak ada data ditemukan!');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memproses data.');
                }
            });
        }
    }

    function SaveAndPrintLaporan() {
        let tglAwal = document.getElementById('txtTglAwal').value;
        let tglAkhir = document.getElementById('txtTglAkhir').value;

        // Validasi tanggal
        if (!tglAwal || !tglAkhir || tglAwal > tglAkhir) {
            alert('Tanggal tidak valid!');
            return;
        }

        // Ambil nilai Saldo Akhir, Total Pemasukan, dan Total Pengeluaran dari input form
        let saldo = document.getElementById('saldoAkhir').value;
        let totalPemasukan = document.getElementById('totalPemasukan').value;
        let totalPengeluaran = document.getElementById('totalPengeluaran').value;
        let saldoSebelumnya = document.getElementById('saldoSebelumnya').value;
        let saldoSetelahnya = document.getElementById('saldoSetelahnya').value;
        let namaKetua = document.getElementById('namaKetua').value;
        let namaBendahara = document.getElementById('namaBendahara').value;

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            type: "POST",
            url: "<?= base_url('KasMasjid/SavePrintLaporan') ?>",
            data: {
                txtTglAwal: tglAwal,
                txtTglAkhir: tglAkhir,
                totalPemasukan: totalPemasukan,
                totalPengeluaran: totalPengeluaran,
                saldo: saldo,
                saldoSebelumnya: saldoSebelumnya,
                saldoSetelahnya: saldoSetelahnya,
                namaKetua: namaKetua,
                namaBendahara: namaBendahara
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status === 'success') {
                    // Setelah menyimpan, cetak laporan
                    PrintLaporan();
                } else {
                    alert('Gagal menyimpan data sebelum mencetak laporan.');
                }
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data.');
            }
        });
    }

    function PrintLaporan() {
        var print = document.getElementById('printarea');
        var newWin = window.open('', 'newWin', 'toolbar=no, width=1500, height=800, scrollbars=yes');
        newWin.document.write(print.innerHTML);
        newWin.document.close();
        newWin.focus();
        newWin.print();
        setTimeout(function() {
            newWin.close();
        }, 1000); // Sesuaikan waktu penundaan sesuai kebutuhan
    }
</script>