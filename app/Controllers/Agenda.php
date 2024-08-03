<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAgenda;
use App\Models\ModelPenilaian;

class Agenda extends BaseController
{
    // Deklarasi properti model
    protected $ModelAgenda;
    protected $ModelPenilaian;
    public function __construct()
    {
        $this->ModelAgenda = new ModelAgenda();
        $this->ModelPenilaian = new ModelPenilaian();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kegiatan',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'agenda-berjalan',
            'page' => 'agenda/v_agenda',
            'user' => $this->ModelAgenda->AllDataUser(),
            'agenda' => $this->ModelAgenda->KegiatanBerjalan(),
        ];
        return view('v_template_admin', $data);
    }
    public function DetailAgenda($id_agenda)
    {
        $detail = $this->ModelAgenda->DetailData($id_agenda);
        $data = [
            'judul' => 'Dana Kegiatan ',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'kegiatan-ditanggung',
            'page' => 'agenda/v_detail_agenda',
            'detail' => $detail,
            'detail_data' => $this->ModelAgenda->AllDataKeuangan($id_agenda),
        ];
        return view('v_template_admin', $data);
    }
    public function InsertData()
    {
        $data = [
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'ketua' => $this->request->getPost('ketua'),
            'sekertaris' => $this->request->getPost('sekertaris'),
            'bendahara' => $this->request->getPost('bendahara'),
            'status' => 'berjalan',
        ];
        $this->ModelAgenda->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
        return redirect()->to(base_url('Agenda'));
    }
    public function UpdateData($id_agenda)
    {
        $data = [
            'id_agenda' => $id_agenda,
            'nama_kegiatan' => $this->request->getPost('nama_kegiatan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam'),
            'tempat' => $this->request->getPost('tempat'),
            'ketua' => $this->request->getPost('ketua'),
            'sekertaris' => $this->request->getPost('sekertaris'),
            'bendahara' => $this->request->getPost('bendahara'),
        ];
        $this->ModelAgenda->UpdateData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah !!');
        return redirect()->to(base_url('Agenda'));
    }
    public function DeleteData($id_agenda)
    {
        $data = [
            'id_agenda' => $id_agenda,
        ];
        $this->ModelAgenda->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to(base_url('Agenda'));
    }
    public function SelesaiData($id_agenda)
    {
        $data = [
            'status' => 'selesai'
        ];
        $this->ModelAgenda->UpdateStatus($id_agenda, $data);
        session()->setFlashdata('pesan', 'Status berhasil diperbarui menjadi selesai !!');
        return redirect()->to(base_url('Agenda/KegiatanDitanggung'));
    }
    public function InsertDanaMasuk()
    {
        // Validasi input
        if ($this->validate([
            'bukti' => [
                'label' => 'Bukti Transfer',
                'rules' => 'uploaded[bukti]|max_size[bukti,1500]|mime_in[bukti,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Belum Di pilih !',
                    'max_size' => '{field} Max 1500 KB !',
                    'mime_in' => 'Format {field} Harus JPG, PNG atau JPEG',
                ]
            ],
        ])) {
            $bukti = $this->request->getFile('bukti');

            // Periksa jika file valid dan belum dipindahkan
            if ($bukti->isValid() && !$bukti->hasMoved()) {
                $nama_file = $bukti->getRandomName();
                $id_agenda = $this->request->getPost('id_agenda');

                // Pindahkan file ke direktori yang ditentukan
                $bukti->move(ROOTPATH . 'public/bukti', $nama_file);

                $data = [
                    'id_agenda' => $id_agenda,
                    'nama_donatur' => $this->request->getPost('nama'),
                    'tanggal_transaksi' => $this->request->getPost('tanggal'),
                    'pemasukan' => $this->request->getPost('dana_masuk'),
                    'keterangan' => null,
                    'pengeluaran' => null,
                    'bukti' => $nama_file,
                ];

                // Simpan data ke database
                $this->ModelAgenda->InsertDataKeuangan($data);

                // Set flashdata untuk pesan sukses
                session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
                return redirect()->to(base_url('Agenda/DetailAgenda/' . $id_agenda));
            } else {
                // Menangani error jika file tidak valid atau gagal di-upload
                session()->setFlashdata('errors', ['bukti' => 'File gagal di-upload.']);
                return redirect()->to(base_url('Agenda/DetailAgenda/' . $this->request->getPost('id_agenda')));
            }
        } else {
            // Menangani error validasi
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Agenda/DetailAgenda/' . $this->request->getPost('id_agenda')));
        }
    }
    public function InsertDanaKeluar()
    {
        // Validasi input
        if ($this->validate([
            'bukti' => [
                'label' => 'Bukti Transfer',
                'rules' => 'uploaded[bukti]|max_size[bukti,1500]|mime_in[bukti,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => '{field} Belum Di pilih !',
                    'max_size' => '{field} Max 1500 KB !',
                    'mime_in' => 'Format {field} Harus JPG, PNG atau JPEG',
                ]
            ],
        ])) {
            $bukti = $this->request->getFile('bukti');

            // Periksa jika file valid dan belum dipindahkan
            if ($bukti->isValid() && !$bukti->hasMoved()) {
                $nama_file = $bukti->getRandomName();
                $id_agenda = $this->request->getPost('id_agenda');

                // Pindahkan file ke direktori yang ditentukan
                $bukti->move(ROOTPATH . 'public/bukti', $nama_file);

                $data = [
                    'id_agenda' => $id_agenda,
                    'nama_donatur' => null,
                    'tanggal_transaksi' => $this->request->getPost('tanggal'),
                    'pemasukan' => null,
                    'keterangan' => $this->request->getPost('ket'),
                    'pengeluaran' => $this->request->getPost('dana_keluar'),
                    'bukti' => $nama_file,
                ];

                // Simpan data ke database
                $this->ModelAgenda->InsertDataKeuangan($data);

                // Set flashdata untuk pesan sukses
                session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
                return redirect()->to(base_url('Agenda/DetailAgenda/' . $id_agenda));
            } else {
                // Menangani error jika file tidak valid atau gagal di-upload
                session()->setFlashdata('errors', ['bukti' => 'File gagal di-upload.']);
                return redirect()->to(base_url('Agenda/DetailAgenda/' . $this->request->getPost('id_agenda')));
            }
        } else {
            // Menangani error validasi
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Agenda/DetailAgenda/' . $this->request->getPost('id_agenda')));
        }
    }

    public function DeleteDataKeuangan($id_keuangan, $id_agenda)
    {
        $data = [
            'id_keuangan' => $id_keuangan,
        ];
        $this->ModelAgenda->DeleteDataKeuangan($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to(base_url('Agenda/DetailAgenda/' . $id_agenda));
    }
    public function EditDataKeuangan($id_keuangan, $id_agenda)
    {
        // Ambil data dari form
        $pemasukan = $this->request->getPost('dana_masuk');
        $pengeluaran = $this->request->getPost('dana_keluar');

        // Ambil file bukti jika ada
        $buktiFile = $this->request->getFile('bukti');

        // Data untuk diupdate
        $data = [
            'id_keuangan' => $id_keuangan,
            'id_agenda' => $id_agenda,
            'nama_donatur' => $this->request->getPost('nama'),
            'tanggal_transaksi' => $this->request->getPost('tanggal'),
            'pemasukan' => $pemasukan !== null ? $this->request->getPost('dana_masuk') : null,
            'keterangan' => $pengeluaran !== null ? $this->request->getPost('ket') : null,
            'pengeluaran' => $pengeluaran !== null ? $this->request->getPost('dana_keluar') : null
        ];

        // Validasi file bukti jika ada
        if ($buktiFile->isValid() && !$buktiFile->hasMoved()) {
            if (!$this->validate([
                'bukti' => [
                    'label' => 'Bukti Transfer',
                    'rules' => 'uploaded[bukti]|max_size[bukti,1500]|mime_in[bukti,image/png,image/jpg,image/jpeg]',
                    'errors' => [
                        'uploaded' => '{field} Belum Di pilih !',
                        'max_size' => '{field} Max 1500 KB !',
                        'mime_in' => 'Format {field} Harus JPG, PNG atau JPEG',
                    ]
                ],
            ])) {
                // Jika validasi gagal, simpan pesan kesalahan dan kembalikan ke halaman detail
                session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
                return redirect()->to(base_url('Agenda/DetailAgenda/' . $id_agenda))->withInput();
            }

            // Proses upload file
            $nama_file = $buktiFile->getRandomName();
            $buktiFile->move(ROOTPATH . 'public/bukti/', $nama_file);
            $data['bukti'] = $nama_file;
        } else {
            // Jika tidak ada file yang diupload, pastikan kolom 'bukti' tetap dengan nilai lama
            $existingData = $this->ModelAgenda->getKeuanganById($id_keuangan);
            $data['bukti'] = $existingData['bukti'];
        }

        // Perbarui data ke database
        $this->ModelAgenda->UpdateDataKeuangan($data);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to(base_url('Agenda/DetailAgenda/' . $id_agenda));
    }
    public function Anggaran($id_agenda)
    {
        $detail = $this->ModelAgenda->DetailData($id_agenda);
        $data = [
            'judul' => 'Anggaran ',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'kegiatan-ditanggung',
            'page' => 'agenda/v_anggaran',
            'detail' => $detail,
            'anggaran' => $this->ModelAgenda->AllAnggaran($id_agenda),
        ];
        return view('v_template_admin', $data);
    }
    public function InsertAnggaran()
    {
        $id_agenda = $this->request->getPost('id_agenda');
        $data = [
            'id_agenda' => $id_agenda,
            'uraian' => $this->request->getPost('uraian'),
            'biaya' => $this->request->getPost('biaya'),
        ];
        $this->ModelAgenda->InsertAnggaran($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        return redirect()->to(base_url('Agenda/Anggaran/' . $id_agenda));
    }
    public function DeleteAnggaran($id_anggaran, $id_agenda)
    {
        $data = [
            'id_anggaran' => $id_anggaran,
        ];
        $this->ModelAgenda->DeleteAnggaran($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to(base_url('Agenda/Anggaran/' . $id_agenda));
    }
    public function EditAnggaran($id_anggaran, $id_agenda)
    {
        $data = [
            'id_anggaran' => $id_anggaran,
            'id_agenda' => $id_agenda,
            'uraian' => $this->request->getPost('uraian'),
            'biaya' => $this->request->getPost('biaya')
        ];

        // Update data anggaran di database
        $this->ModelAgenda->UpdateAnggaran($data);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to(base_url('Agenda/Anggaran/' . $id_agenda));
    }
    //Penanggung Jawab
    public function KegiatanBerjalan()
    {
        $data = [
            'judul' => 'Kegiatan',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'agenda-berjalan',
            'page' => 'jamaah/v_agenda',
            'user' => $this->ModelAgenda->AllDataUser(),
            'agenda1' => $this->ModelAgenda->getAgendaWithRatings(),
            'agenda' => $this->ModelAgenda->KegiatanBerjalan(),
        ];
        return view('v_template_admin', $data);
    }
    public function KegiatanDitanggung()
    {
        $id_user = session()->get('id_user');  // Pastikan id_user sudah diambil dari session atau sumber lain
        $agenda = $this->ModelAgenda->KegiatanDitangggung($id_user);

        $data = [
            'judul' => 'Kegiatan Ditanggung',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'kegiatan-ditanggung',
            'page' => 'agenda/v_agenda',
            'user' => $this->ModelAgenda->AllDataUser(),
            'agenda' => $agenda ? $agenda : [], // Jika tidak ada data, set $agenda sebagai array kosong
        ];

        return view('v_template_admin', $data);
    }
    public function KegiatanSelesai()
    {

        $data = [
            'judul' => 'Kegiatan Selesai',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'kegiatan-selesai',
            'page' => 'jamaah/v_agenda',
            'agenda1' => $this->ModelAgenda->getAgendaWithRatings(),            
            'agenda' => $this->ModelAgenda->KegiatanSelesai(),
        ];

        return view('v_template_admin', $data);
    }

    public function LihatAnggaranBerjalan($id_agenda)
    {
        $detail = $this->ModelAgenda->DetailData($id_agenda);
        $data = [
            'judul' => 'Anggaran',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'agenda-berjalan',
            'page' => 'jamaah/v_anggaran',
            'detail' => $detail,
            'anggaran' => $this->ModelAgenda->AllAnggaran($id_agenda),
        ];
        return view('v_template_admin', $data);
    }
    public function LihatAnggaranSelesai($id_agenda)
    {
        $detail = $this->ModelAgenda->DetailData($id_agenda);
        $data = [
            'judul' => 'Anggaran',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'kegiatan-selesai',
            'page' => 'jamaah/v_anggaran',
            'detail' => $detail,
            'anggaran' => $this->ModelAgenda->AllAnggaran($id_agenda),
        ];
        return view('v_template_admin', $data);
    }
    public function LihatDanaKegiatanBerjalan($id_agenda)
    {
        $detail = $this->ModelAgenda->DetailData($id_agenda);
        $data = [
            'judul' => 'Dana Kegiatan ',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'agenda-berjalan',
            'page' => 'jamaah/v_detail_agenda',
            'detail' => $detail,
            'detail_data' => $this->ModelAgenda->AllDataKeuangan($id_agenda),
        ];
        return view('v_template_admin', $data);
    }
    public function LihatDanaKegiatanSelesai($id_agenda)
    {
        $detail = $this->ModelAgenda->DetailData($id_agenda);
        $data = [
            'judul' => 'Dana Kegiatan ',
            'subjudul' => '',
            'menu' => 'agenda',
            'submenu' => 'kegiatan-selesai',
            'page' => 'jamaah/v_detail_agenda',
            'detail' => $detail,
            'detail_data' => $this->ModelAgenda->AllDataKeuangan($id_agenda),
        ];
        return view('v_template_admin', $data);
    }
    public function CetakDanaKegiatan($id_agenda)
    {
        $detail_data = $this->ModelAgenda->getDataByAgenda($id_agenda); // Mengambil data berdasarkan id_agenda
        $detail = $this->ModelAgenda->getDataByNamaAgenda($id_agenda); // Mengambil data berdasarkan id_agenda

        // Pastikan ada data nama kegiatan yang ditemukan
        if ($detail) {
            $judul = 'Cetak Dana Kegiatan: ' . $detail['nama_kegiatan']; // Judul sesuai dengan nama kegiatan
        } else {
            $judul = 'Cetak Dana Kegiatan'; // Judul default jika data nama kegiatan tidak ditemukan
        }

        // Data yang akan dikirim ke view
        $data = [
            'judul' => $judul,
            'detail' => $detail,
            'detail_data' => $detail_data,
        ];

        return view('agenda/v_data_cetak', $data); // Menampilkan view dengan data yang sudah disiapkan
    }
    public function saveRating()
    {
        $id_agenda = $this->request->getPost('id_agenda');
        $rating = $this->request->getPost('rating');
        $komentar = $this->request->getPost('komentar');
        $id_user = session()->get('id_user');

        if ($this->ModelPenilaian->hasUserRated($id_agenda, $id_user)) {
            session()->setFlashdata('pesan', 'Anda sudah memberikan penilaian untuk kegiatan ini!');
        } else {
            $data = [
                'id_agenda' => $id_agenda,
                'id_user' => $id_user,
                'rating' => $rating,
                'komentar' => $komentar
            ];

            $this->ModelPenilaian->InsertPenilaian($data);
            session()->setFlashdata('pesan', 'Rating Berhasil Ditambahkan!');
        }
        return redirect()->to(base_url('Agenda/KegiatanSelesai'));
    }
}
