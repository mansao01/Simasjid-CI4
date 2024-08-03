<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAdmin;
use App\Models\ModelKasMasjid;
use App\Models\ModelKasSosial;
use App\Models\ModelAgenda;
use App\Models\ModelSetting;

class Admin extends BaseController
{
    protected $ModelAdmin;
    protected $ModelKasMasjid;
    protected $ModelKasSosial;
    protected $ModelAgenda;
    protected $ModelSetting;
    public function __construct()
    {
        $this->ModelAdmin = new ModelAdmin();
        $this->ModelKasMasjid = new ModelKasMasjid();
        $this->ModelKasSosial = new ModelKasSosial();
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelSetting = new ModelSetting();
    }
    public function index()
    {
        // Mendapatkan total kas masuk bulan ini dan bulan lalu
        $total_kas_masuk_bulan_ini = $this->ModelKasMasjid->getTotalPemasukanBulanIni();
        $total_kas_masuk_bulan_lalu = $this->ModelKasMasjid->getTotalPemasukanBulanLalu();

        // Hitung persentase perubahan
        if ($total_kas_masuk_bulan_lalu != 0) {
            $persentase_perubahan_kas_masuk = (($total_kas_masuk_bulan_ini - $total_kas_masuk_bulan_lalu) / $total_kas_masuk_bulan_lalu) * 100;
        } else {
            $persentase_perubahan_kas_masuk = 0;
        }

        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'v_dashboard',
            'kas_m' => $this->ModelKasMasjid->AllData(),
            'sales_data' => $this->ModelKasMasjid->getBulanTahunIniDanEnamBulanSebelumnya(),
            'total_kas' => $this->ModelKasMasjid->getTotalKasMasukBulanIni(),
            'dana_kegiatan' => $this->ModelAgenda->getTotalPemasukanDanPengeluaranPerEnamKegiatan(),
            'kasmasjid' => $this->ModelAdmin->AllDataKasMasjid(),
            'persentase_perubahan_kas_masuk' => $persentase_perubahan_kas_masuk,
        ];
        return view('v_template_admin', $data);
    }
    public function Setting()
    {
        $url = 'https://api.myquran.com/v2/sholat/kota/semua';
        $kota = json_decode(file_get_contents($url), true);
        $data = [
            'judul' => 'Profil Masjid',
            'subjudul' => '',
            'menu' => 'profil-masjid',
            'submenu' => '',
            'page' => 'v_setting',
            'setting' => $this->ModelSetting->ViewSetting(),
            'kota' => $kota['data'],
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateSetting()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules(
            [
                'nama_masjid' => 'required',
                'id_kota' => 'required',
                'alamat' => 'required',
                'gambar1' => 'mime_in[gambar1,image/jpg,image/jpeg,image/png]',
                'gambar2' => 'mime_in[gambar2,image/jpg,image/jpeg,image/png]',
                'gambar3' => 'mime_in[gambar3,image/jpg,image/jpeg,image/png]',
            ],
            [
                'gambar1' => [
                    'mime_in' => 'Format Gambar 1 harus JPG, JPEG, atau PNG.'
                ],
                'gambar2' => [
                    'mime_in' => 'Format Gambar 2 harus JPG, JPEG, atau PNG.'
                ],
                'gambar3' => [
                    'mime_in' => 'Format Gambar 3 harus JPG, JPEG, atau PNG.'
                ]
            ]
        );

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        // Ambil data lama
        $existingData = $this->ModelSetting->ViewSetting();

        // Ambil file gambar jika ada
        $gambar1 = $this->request->getFile('gambar1');
        $gambar2 = $this->request->getFile('gambar2');
        $gambar3 = $this->request->getFile('gambar3');

        // Inisialisasi nama gambar
        $gambar1Name = $existingData['gambar1'];
        $gambar2Name = $existingData['gambar2'];
        $gambar3Name = $existingData['gambar3'];

        // Proses file upload jika ada
        if ($gambar1->isValid() && !$gambar1->hasMoved()) {
            $gambar1Name = $gambar1->getRandomName();
            $gambar1->move(ROOTPATH . 'public/uploads', $gambar1Name);
        }

        if ($gambar2->isValid() && !$gambar2->hasMoved()) {
            $gambar2Name = $gambar2->getRandomName();
            $gambar2->move(ROOTPATH . 'public/uploads', $gambar2Name);
        }

        if ($gambar3->isValid() && !$gambar3->hasMoved()) {
            $gambar3Name = $gambar3->getRandomName();
            $gambar3->move(ROOTPATH . 'public/uploads', $gambar3Name);
        }

        // Data untuk diperbarui
        $data = [
            'nama_masjid' => $this->request->getPost('nama_masjid'),
            'id_kota' => $this->request->getPost('id_kota'),
            'alamat' => $this->request->getPost('alamat'),
            'gambar1' => $gambar1Name,
            'gambar2' => $gambar2Name,
            'gambar3' => $gambar3Name,
        ];

        // Log data yang akan diperbarui
        log_message('info', 'Data yang akan diperbarui: ' . json_encode($data));

        // Perbarui data pengaturan
        if ($this->ModelSetting->UpdateSetting($data)) {
            session()->setFlashdata('pesan', 'Profil Masjid Berhasil Disimpan !!');
        } else {
            session()->setFlashdata('pesan', 'Gagal menyimpan profil masjid.');
        }

        return redirect()->to(base_url('Admin/Setting'));
    }

    public function DonasiMasuk()
    {
        $data = [
            'judul' => 'Donasi Masuk',
            'subjudul' => '',
            'menu' => 'donasi',
            'submenu' => '',
            'page' => 'v_donasi_masuk',
            'donasi' => $this->ModelAdmin->AllDonasi(),
        ];
        return view('v_template_admin', $data);
    }

    public function GrafikKas()
    {
        $data = [
            'judul' => 'Grafik Kas',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'grafik/grafik_kas',
            'sales_data' => $this->ModelKasMasjid->getgrafikKeuanganKeseluruhan(),
        ];
        return view('v_template_admin', $data);
    }
    public function GrafikDanaKegiatan()
    {
        $data = [
            'judul' => 'Grafik Dana Kegiatan',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' => 'grafik/grafik_dana_kegiatan',
            'dana_kegiatan' => $this->ModelAgenda->getTotalPemasukanDanPengeluaranPerBulan(),
        ];
        return view('v_template_admin', $data);
    }
}
