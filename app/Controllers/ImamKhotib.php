<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelImamKhotib;
use App\Models\ModelAdmin;

class ImamKhotib extends BaseController
{
    // Deklarasi properti model
    protected $ModelImamKhotib;
    protected $ModelAdmin;
    public function __construct()
    {
        $this->ModelImamKhotib = new ModelImamKhotib();
        $this->ModelAdmin = new ModelAdmin();
    }
    public function index()
    {
        $data = [
            'judul' => 'Data Petugas',
            'subjudul' => '',
            'menu' => 'imam-khotib',
            'submenu' => 'data-imam-khotib',
            'page' => 'Imam-Khotib/v_imam_khotib',
            'anggaran' => $this->ModelImamKhotib->AllData(),
        ];
        return view('v_template_admin', $data);
    }
    public function JadwalImamKhotib()
    {
        $data = [
            'judul' => 'Jadwal Imam dan Khotib',
            'subjudul' => '',
            'menu' => 'imam-khotib',
            'submenu' => 'jadwal-imam-khotib',
            'page' => 'Imam-Khotib/v_jadwal_imam_khotib',
            'datajadwal' => $this->ModelImamKhotib->AllDataJadwal(),
            'petugas' => $this->ModelImamKhotib->select(),
        ];
        // Debugging untuk memastikan data petugas tidak null
        if (empty($data['petugas'])) {
            $data['petugas'] = [];
        }
        return view('v_template_admin', $data);
    }

    public function InsertDataPetugas()
    {
        $data = [
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'no_petugas' => $this->request->getPost('no_petugas'),
            'alamat_petugas' => $this->request->getPost('alamat_petugas'),
        ];
        $this->ModelImamKhotib->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        return redirect()->to(base_url('ImamKhotib'));
    }
    public function UpdateDataPetugas($id_petugas)
    {
        $data = [
            'id_petugas' => $id_petugas,
            'nama_petugas' => $this->request->getPost('nama_petugas'),
            'no_petugas' => $this->request->getPost('no_petugas'),
            'alamat_petugas' => $this->request->getPost('alamat_petugas'),
        ];
        $this->ModelImamKhotib->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to(base_url('ImamKhotib'));
    }
    public function DeleteDataPetugas($id_petugas)
    {
        $data = [
            'id_petugas' => $id_petugas,
        ];
        $this->ModelImamKhotib->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Hapus!!');
        return redirect()->to(base_url('ImamKhotib'));
    }
    // Fungsi untuk mengupdate data jadwal
    public function UpdateSetting()
    {
        $id_jadwal = $this->request->getPost('id_jadwal'); // Pastikan id_jadwal disertakan dalam form
        $data = [
            'pon' => $this->request->getPost('pon'),
            'wage' => $this->request->getPost('wage'),
            'kliwon' => $this->request->getPost('kliwon'),
            'legi' => $this->request->getPost('legi'),
            'pahing' => $this->request->getPost('pahing'),
            'imam_dzuhur' => $this->request->getPost('imam_dzuhur'),
            'muadzin_dzuhur' => $this->request->getPost('muadzin_dzuhur'),
            'imam_asar' => $this->request->getPost('imam_asar'),
            'muadzin_asar' => $this->request->getPost('muadzin_asar'),
            'imam_maghrib' => $this->request->getPost('imam_maghrib'),
            'muadzin_maghrib' => $this->request->getPost('muadzin_maghrib'),
            'imam_isya' => $this->request->getPost('imam_isya'),
            'muadzin_isya' => $this->request->getPost('muadzin_isya'),
            'imam_subuh' => $this->request->getPost('imam_subuh'),
            'muadzin_subuh' => $this->request->getPost('muadzin_subuh'),
            
        ];

        $this->ModelImamKhotib->updateJadwal($id_jadwal, $data);
        session()->setFlashdata('pesan', 'Jadwal Imam dan Khotib Berhasil Disimpan!!');
        return redirect()->to(base_url('ImamKhotib/JadwalImamKhotib'));
    }

    public function UpdateJadwal()
{
    $db = \Config\Database::connect();
    $builder = $db->table('tbl_jadwal_imam_khotib');

    // Ambil data dari form
    $id_jadwal = $this->request->getPost('id_jadwal');
    $pon = $this->request->getPost('pon');
    $imam_dzuhur = $this->request->getPost('imam_dzuhur');
    $muadzin_dzuhur = $this->request->getPost('muadzin_dzuhur');
    $wage = $this->request->getPost('wage');
    $imam_asar = $this->request->getPost('imam_asar');
    $muadzin_asar = $this->request->getPost('muadzin_asar');
    $kliwon = $this->request->getPost('kliwon');
    $imam_maghrib = $this->request->getPost('imam_maghrib');
    $muadzin_maghrib = $this->request->getPost('muadzin_maghrib');
    $legi = $this->request->getPost('legi');
    $imam_isya = $this->request->getPost('imam_isya');
    $muadzin_isya = $this->request->getPost('muadzin_isya');
    $pahing = $this->request->getPost('pahing');
    $imam_subuh = $this->request->getPost('imam_subuh');
    $muadzin_subuh = $this->request->getPost('muadzin_subuh');

    // Update data pada tabel
    $data = [
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $pon, 'tugas' => 'pon'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $imam_dzuhur, 'tugas' => 'imam_dzuhur'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $muadzin_dzuhur, 'tugas' => 'muadzin_dzuhur'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $wage, 'tugas' => 'wage'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $imam_asar, 'tugas' => 'imam_asar'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $muadzin_asar, 'tugas' => 'muadzin_asar'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $kliwon, 'tugas' => 'kliwon'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $imam_maghrib, 'tugas' => 'imam_maghrib'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $muadzin_maghrib, 'tugas' => 'muadzin_maghrib'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $legi, 'tugas' => 'legi'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $imam_isya, 'tugas' => 'imam_isya'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $muadzin_isya, 'tugas' => 'muadzin_isya'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $pahing, 'tugas' => 'pahing'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $imam_subuh, 'tugas' => 'imam_subuh'],
        ['id_jadwal' => $id_jadwal, 'id_petugas' => $muadzin_subuh, 'tugas' => 'muadzin_subuh'],
    ];

    foreach ($data as $row) {
        $builder->where('id_jadwal', $row['id_jadwal'])
                ->where('tugas', $row['tugas'])
                ->update(['id_petugas' => $row['id_petugas']]);
    }

    session()->setFlashdata('pesan', 'Data berhasil diperbarui.');
    return redirect()->back();
}

}
