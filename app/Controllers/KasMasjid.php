<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKasMasjid;
use App\Models\ModelAdmin;
use App\Models\ModelLaporan;
use App\Models\ModelProfile;

class KasMasjid extends BaseController
{
    protected $ModelKasMasjid;
    protected $ModelAdmin;
    protected $db;

    public function __construct()
    {
        $this->ModelKasMasjid = new ModelKasMasjid();
        $this->ModelAdmin = new ModelAdmin();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data = [
            'judul' => 'Rekap Kas Masjid',
            'subjudul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'rekap-kas',
            'page' => 'kas-masjid/v_rekap_kas_masjid',
            'kas' => $this->ModelKasMasjid->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function KasMasuk()
    {
        $data = [
            'judul' => 'Kas Masjid Masuk',
            'subjudul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'kas-masuk',
            'page' => 'kas-masjid/v_kas_masjid_masuk',
            'kas' => $this->ModelKasMasjid->AllDataKasMasuk(),
        ];
        return view('v_template_admin', $data);
    }
    public function KasKeluar()
    {
        $data = [
            'judul' => 'Kas Masjid Keluar',
            'subjudul' => '',
            'menu' => 'kas-masjid',
            'submenu' => 'kas-keluar',
            'page' => 'kas-masjid/v_kas_masjid_keluar',
            'kas' => $this->ModelKasMasjid->AllDataKasKeluar(),
        ];
        return view('v_template_admin', $data);
    }

    public function InsertKasMasuk()
    {
        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => $this->request->getPost('kas_masuk'),
            'kas_keluar' => 0,
            'status' => 'Masuk',
        ];
        $this->ModelKasMasjid->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        return redirect()->to(base_url('KasMasjid/KasMasuk'));
    }

    public function InsertKasKeluar()
    {
        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => 0,
            'kas_keluar' => $this->request->getPost('kas_keluar'),
            'status' => 'Keluar',
        ];
        $this->ModelKasMasjid->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        return redirect()->to(base_url('KasMasjid/KasKeluar'));
    }

    public function UpdateKasMasuk($id_kas_masjid)
    {
        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'id_kas_masjid' => $id_kas_masjid,
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => $this->request->getPost('kas_masuk'),
        ];
        $this->ModelKasMasjid->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to(base_url('KasMasjid/KasMasuk'));
    }
    public function UpdateKasKeluar($id_kas_masjid)
    {
        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'id_kas_masjid' => $id_kas_masjid,
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_keluar' => $this->request->getPost('kas_keluar'),
        ];
        $this->ModelKasMasjid->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to(base_url('KasMasjid/KasKeluar'));
    }

    public function DeleteKasMasuk($id_kas_masjid)
    {
        $data = [
            'id_kas_masjid' => $id_kas_masjid,
        ];
        $this->ModelKasMasjid->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to(base_url('KasMasjid/KasMasuk'));
    }
    public function DeleteKasKeluar($id_kas_masjid)
    {
        $data = [
            'id_kas_masjid' => $id_kas_masjid,
        ];
        $this->ModelKasMasjid->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to(base_url('KasMasjid/KasKeluar'));
    }
    public function Laporan()
    {
        $data = [
            'judul' => 'Laporan Kas Masjid',
            'menu' => 'laporan-kas',
            'submenu' => 'laporan-kas-masjid',
            'page' => 'kas-masjid/v_laporan_kas_masjid',
            'masjid' => $this->ModelAdmin->ViewSetting(),
        ];
        return view('v_template_admin', $data);
    }
    public function ViewLaporan()
    {
        $tglAwal = $this->request->getPost('txtTglAwal');
        $tglAkhir = $this->request->getPost('txtTglAkhir');

        // Pastikan input tidak null dan adalah string
        if (is_array($tglAwal) || is_array($tglAkhir) || $tglAwal === null || $tglAkhir === null) {
            return $this->response->setJSON(['error' => 'Tanggal tidak valid. Pastikan input adalah string dan tidak kosong.']);
        }

        // Log untuk memeriksa tanggal awal dan akhir
        log_message('info', 'Tanggal Awal: ' . $tglAwal);
        log_message('info', 'Tanggal Akhir: ' . $tglAkhir);

        $userModel = new ModelProfile();

        // Ambil nama pengguna dengan jabatan Ketua Umum dan Bendahara
        $users = $userModel->getUsersByJabatan(['lv-3', 'lv-11']);

        // Inisialisasi nama pengguna
        $namaKetua = '';
        $namaBendahara = '';

        // Mendapatkan nama berdasarkan jabatan
        foreach ($users as $user) {
            if ($user['id_jabatan'] == 'lv-3') {
                $namaKetua = $user['nama_user'];
            } elseif ($user['id_jabatan'] == 'lv-11') {
                $namaBendahara = $user['nama_user'];
            }
        }

        $model = new ModelKasMasjid();

        // Ambil data kas dari database berdasarkan tanggal
        $kas = $model->getDataByDateRange($tglAwal, $tglAkhir);

        // Ambil total pemasukan dan pengeluaran sebelum tanggal awal
        $totalsBeforeDate = $model->getTotalBeforeDate($tglAwal);
        $totalPemasukanBefore = $totalsBeforeDate['total_masuk'];
        $totalPengeluaranBefore = $totalsBeforeDate['total_keluar'];

        // Hitung saldo sebelum tanggal awal
        $saldoSebelumTglAwal = $totalPemasukanBefore - $totalPengeluaranBefore;

        // Hitung total pemasukan, pengeluaran, dan saldo
        $totalPemasukan = array_sum(array_column($kas, 'kas_masuk'));
        $totalPengeluaran = array_sum(array_column($kas, 'kas_keluar'));
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        // Saldo setelahnya
        $totalpemasukansetelah = $totalPemasukanBefore + $totalPemasukan;
        $totalpengeluaransetelah = $totalPengeluaranBefore + $totalPengeluaran;
        $totalsaldosetelah = $totalpemasukansetelah - $totalpengeluaransetelah;

        // Set timezone
        date_default_timezone_set('Asia/Jakarta');

        // Daftar nama bulan dalam bahasa Indonesia
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        try {
            // Membuat objek DateTime dari string tanggal
            $dateAwal = new \DateTime($tglAwal);
            $dateAkhir = new \DateTime($tglAkhir);

            // Mendapatkan bagian dari tanggal
            $dayAwal = $dateAwal->format('d');
            $monthAwal = (int)$dateAwal->format('n'); // Mengubah bulan menjadi integer
            $yearAwal = $dateAwal->format('Y');

            $dayAkhir = $dateAkhir->format('d');
            $monthAkhir = (int)$dateAkhir->format('n'); // Mengubah bulan menjadi integer
            $yearAkhir = $dateAkhir->format('Y');

            // Membuat judul tanggal dengan nama bulan dalam bahasa Indonesia
            $judultglawal = $dayAwal . ' ' . $bulan[$monthAwal] . ' ' . $yearAwal;
            $judultglakhir = $dayAkhir . ' ' . $bulan[$monthAkhir] . ' ' . $yearAkhir;

            // Mendapatkan informasi tanggal sekarang
            $tanggalSekarang = date('d ') . $bulan[date('n')] . date(' Y'); // Misalnya: "15 Juli 2024"

            // Data untuk dikirim ke view
            $data = [
                'judultglawal' => $judultglawal,
                'judultglakhir' => $judultglakhir,
                'tglAwal' => $tglAwal,
                'tglAkhir' => $tglAkhir,
                'kas' => $kas,
                'totalPemasukanBefore' => $totalPemasukanBefore,
                'totalPengeluaranBefore' => $totalPengeluaranBefore,
                'saldoSebelumTglAwal' => $saldoSebelumTglAwal,
                'totalPemasukan' => $totalPemasukan,
                'totalPengeluaran' => $totalPengeluaran,
                'saldoAkhir' => $saldoAkhir,
                'totalpemasukansetelah' => $totalpemasukansetelah,
                'totalpengeluaransetelah' => $totalpengeluaransetelah,
                'totalsaldosetelah' => $totalsaldosetelah,
                'tanggalSekarang' => $tanggalSekarang,
                'namaKetua' => $namaKetua,
                'namaBendahara' => $namaBendahara,
                'masjid' => $this->ModelAdmin->ViewSetting(),
            ];

            // Log untuk memeriksa data yang dikirim ke view
            log_message('info', 'Data untuk view: ' . print_r($data, true));

            // Membuat respon JSON
            $response = [
                'data' => view('kas-masjid/v_data_laporan', $data),
            ];

            // Mengembalikan respon JSON
            return $this->response->setJSON($response);
        } catch (\Exception $e) {
            // Menangani kesalahan format tanggal
            return $this->response->setJSON(['error' => 'Format tanggal tidak valid: ' . $e->getMessage()]);
        }
    }

    public function SavePrintLaporan()
    {
        $tglAwal = $this->request->getPost('txtTglAwal');
        $tglAkhir = $this->request->getPost('txtTglAkhir');
        $totalPemasukan = $this->request->getPost('totalPemasukan');
        $totalPengeluaran = $this->request->getPost('totalPengeluaran');
        $saldo = $this->request->getPost('saldo');
        $saldoSebelumnya = $this->request->getPost('saldoSebelumnya');
        $saldoSetelahnya = $this->request->getPost('saldoSetelahnya');
        $namaKetua = $this->request->getPost('namaKetua');
        $namaBendahara = $this->request->getPost('namaBendahara');
        $idUser = session()->get('id_user'); // Ambil id_user dari session

        // Logging data yang diterima
        log_message('info', 'Data yang diterima: ' . json_encode([
            'tgl_cetak' => date('Y-m-d H:i:s'),
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'saldo_sebelumnya' => $saldoSebelumnya,
            'saldo_setelahnya' => $saldoSetelahnya,
            'tgl_awal' => $tglAwal,
            'tgl_akhir' => $tglAkhir,
            'ketua_umum' => $namaKetua,
            'bendahara' => $namaBendahara,
            'id_user' => $idUser,
        ]));
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_riwayat_cetak_laporan');

        $lastIdResult = $this->db->query("
        SELECT id_laporan
        FROM tbl_riwayat_cetak_laporan
        ORDER BY CAST(SUBSTRING(id_laporan, 4) AS UNSIGNED) DESC
        LIMIT 1
        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_laporan'];
            $lastIdNumber = intval(substr($lastId, 3)); // Mengambil angka setelah 'pim-'
            $newId = 'lp-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'lp-1';
        }

        $data = [
            'id_laporan' => $newId,
            'tgl_cetak' => date('Y-m-d H:i:s'),
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'saldo_sebelumnya' => $saldoSebelumnya,
            'saldo_setelahnya' => $saldoSetelahnya,
            'tgl_awal' => $tglAwal,
            'tgl_akhir' => $tglAkhir,
            'ketua_umum' => $namaKetua,
            'bendahara' => $namaBendahara,
            'id_user' => $idUser
        ];
        if ($builder->insert($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }
    public function RiwayatCetakLaporan()
    {
        $data = [
            'judul' => 'Riwayat Cetak Laporan',
            'subjudul' => '',
            'menu' => 'laporan-kas',
            'submenu' => 'laporan-kas-riwayat',
            'page' => 'pengurus/v_riwayat_cetak_laporan',
            'riwayat' => $this->ModelKasMasjid->AllDataRiwayatCetak(),
        ];
        return view('v_template_admin', $data);
    }
}
