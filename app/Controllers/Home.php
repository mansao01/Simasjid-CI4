<?php

namespace App\Controllers;

use App\Models\ModelHome;
use App\Models\ModelAdmin;
use App\Models\ModelKasMasjid;
use App\Models\ModelKasSosial;
use App\Models\ModelRekening;
use App\Models\ModelImamKhotib;
use App\Models\ModelSetting;

class Home extends BaseController
{
    // Deklarasi properti model
    protected $ModelHome;
    protected $ModelAdmin;
    protected $ModelKasMasjid;
    protected $ModelKasSosial;
    protected $ModelRekening;
    protected $ModelImamKhotib;
    protected $ModelSetting;

    public function __construct()
    {
        $this->ModelHome = new ModelHome();
        $data = $this->ModelHome->Agenda();
        $this->ModelAdmin = new ModelAdmin();
        $data = $this->ModelAdmin->ViewSetting();
        $this->ModelKasMasjid = new ModelKasMasjid();
        $this->ModelKasSosial = new ModelKasSosial();
        $this->ModelRekening = new ModelRekening();
        $this->ModelImamKhotib = new ModelImamKhotib();
        $this->ModelSetting = new ModelSetting();
    }
    public function index()
    {
        $setting = $this->ModelAdmin->ViewSetting();
        $url = 'https://api.myquran.com/v2/sholat/jadwal/' . $setting['id_kota'] . '/' . date('Y') . '/' . date('m') . '/' . date('d');
        $waktu = json_decode(file_get_contents($url), true);
        $data = [
            'judul' => 'Home',
            'page' => 'v_home',
            'waktu' => $waktu['data'],
            'kas_m' => $this->ModelKasMasjid->AllData(),
            'profil_masjid' => $this->ModelSetting->ViewSetting(),
        ];
        return view('v_template', $data);
    }
    public function Agenda()
    {
        $data = [
            'judul' => 'Agenda',
            'page' => 'front-end/v_agenda',
            'agenda' => $this->ModelHome->Agenda(),
        ];
        return view('v_template', $data);
    }
    public function PesertaQurban()
    {
        $y = date('Y');
        $m = $y - 579;
        $data = [
            'judul' => 'Peserta Qurban Tahun ' . $m . 'H / ' . date('Y') . 'M',
            'page' => 'front-end/v_peserta_qurban',
            'kelompok' => $this->ModelHome->AllDataKelompok(),
        ];
        return view('v_template', $data);
    }
    public function RekapKasMasjid()
    {
        $data = [
            'judul' => 'Rekap Kas Masjid',
            'page' => 'front-end/v_rekap_kas',
            'kas' => $this->ModelHome->AllDataKasMasjid(),
        ];
        return view('v_template', $data);
    }
    public function RekapKasSosial()
    {
        $data = [
            'judul' => 'Rekap Kas Sosial',
            'page' => 'front-end/v_rekap_kas',
            'kas' => $this->ModelHome->AllDataKasSosial(),
        ];
        return view('v_template', $data);
    }
    public function Donasi()
    {
        $data = [
            'judul' => 'Donasi',
            'page' => 'front-end/v_donasi',
            'rek' => $this->ModelRekening->AllData(),
            'validation' => \Config\Services::validation(),
        ];
        return view('v_template', $data);
    }
    public function KirimDonasi()
    {
        if (
            $this->validate([
                'bukti' => [
                    'label' => 'Bukti Transfer',
                    'rules' => 'uploaded[bukti]|max_size[bukti,1500]|mime_in[bukti,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => '{field} Belum Di pilih !',
                        'max_size' => '{field} Max 1500 KB !',
                        'mime_in' => 'Format {field} Harus JPG, PNG atau JPEG',
                    ]

                ],
            ])
        ) {
            $bukti = $this->request->getFile('bukti');
            $nama_file = $bukti->getRandomName();
            $data = [
                'id_rekening' => $this->request->getPost('id_rekening'),
                'nama_bank' => $this->request->getPost('nama_bank'),
                'no_rek' => $this->request->getPost('no_rek'),
                'nama_pengirim' => $this->request->getPost('nama_pengirim'),
                'jumlah' => $this->request->getPost('jumlah'),
                'jenis_donasi' => $this->request->getPost('jenis_donasi'),
                'bukti' => $nama_file,
                'tgl' => date('Y-m-d'),
            ];
            $bukti->move('bukti', $nama_file);
            $this->ModelHome->InsertDonasi($data);
            session()->setFlashdata('pesan', 'Terima Kasih Bukti Transaksi Sudah Dikirim !!');
            return redirect()->to(base_url('Home/Donasi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Home/Donasi'));
        }
    }
    public function JadwalImam()
    {
        $modelJadwal = new ModelImamKhotib();
        $modelImam = new ModelImamKhotib();

        $dataJadwal = $modelJadwal->AllDataJadwal();
        $dataPetugas = $modelImam->AllData();

        // Convert petugas data into an associative array for easier lookup
        $petugasArray = [];
        foreach ($dataPetugas as $petugas) {
            $petugasArray[$petugas['id_petugas']] = $petugas['nama_petugas'];
        }

        // Add petugas names to jadwal data
        foreach ($dataJadwal as &$jadwal) {
            $jadwal['pon_name'] = $petugasArray[$jadwal['pon']] ?? 'Unknown';
            $jadwal['wage_name'] = $petugasArray[$jadwal['wage']] ?? 'Unknown';
            $jadwal['kliwon_name'] = $petugasArray[$jadwal['kliwon']] ?? 'Unknown';
            $jadwal['legi_name'] = $petugasArray[$jadwal['legi']] ?? 'Unknown';
            $jadwal['pahing_name'] = $petugasArray[$jadwal['pahing']] ?? 'Unknown';
            $jadwal['imam_dzuhur_name'] = $petugasArray[$jadwal['imam_dzuhur']] ?? 'Unknown';
            $jadwal['muadzin_dzuhur_name'] = $petugasArray[$jadwal['muadzin_dzuhur']] ?? 'Unknown';
            $jadwal['imam_asar_name'] = $petugasArray[$jadwal['imam_asar']] ?? 'Unknown';
            $jadwal['muadzin_asar_name'] = $petugasArray[$jadwal['muadzin_asar']] ?? 'Unknown';
            $jadwal['imam_maghrib_name'] = $petugasArray[$jadwal['imam_maghrib']] ?? 'Unknown';
            $jadwal['muadzin_maghrib_name'] = $petugasArray[$jadwal['muadzin_maghrib']] ?? 'Unknown';
            $jadwal['imam_isya_name'] = $petugasArray[$jadwal['imam_isya']] ?? 'Unknown';
            $jadwal['muadzin_isya_name'] = $petugasArray[$jadwal['muadzin_isya']] ?? 'Unknown';
            $jadwal['imam_subuh_name'] = $petugasArray[$jadwal['imam_subuh']] ?? 'Unknown';
            $jadwal['muadzin_subuh_name'] = $petugasArray[$jadwal['muadzin_subuh']] ?? 'Unknown';
        }
        $data = [
            'judul' => 'Jadwal Imam',
            'page' => 'front-end/v_jadwal_imam',
            'datajadwal' => $dataJadwal
        ];
        return view('v_template', $data);
    }
}
