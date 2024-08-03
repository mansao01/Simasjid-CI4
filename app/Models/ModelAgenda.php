<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAgenda extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_agenda')
            ->where('status', 'berjalan')
            ->orderBy('id_agenda', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function AllDataUser()
    {
        return $this->db->table('tbl_user')
            ->where('role_id', 'pengurus')
            ->get()
            ->getResultArray();
    }
    public function KegiatanBerjalan()
    {
        $builder = $this->db->table('tbl_agenda AS agenda');
        $builder->select('agenda.id_agenda, agenda.nama_kegiatan, agenda.tanggal, agenda.jam, agenda.Tempat, agenda.status, 
                      ketua.nama_user AS ketua, sekertaris.nama_user AS sekertaris, bendahara.nama_user AS bendahara, 
                      AVG(penilaian.rating) as rating, GROUP_CONCAT(penilaian.komentar SEPARATOR "; ") as komentar');
        $builder->join('tbl_user AS ketua', 'agenda.ketua = ketua.id_user', 'left');
        $builder->join('tbl_user AS sekertaris', 'agenda.sekertaris = sekertaris.id_user', 'left');
        $builder->join('tbl_user AS bendahara', 'agenda.bendahara = bendahara.id_user', 'left');
        $builder->join('tbl_penilaian AS penilaian', 'penilaian.id_agenda = agenda.id_agenda', 'left');
        $builder->where('agenda.status', 'berjalan');
        $builder->groupBy('agenda.id_agenda');
        $builder->orderBy('agenda.id_agenda', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // AgendaModel.php
    public function getAgendaWithRatings()
    {
        $builder = $this->db->table('tbl_agenda');
        $builder->select('tbl_agenda.*, tbl_penilaian.rating, tbl_penilaian.komentar, tbl_user.nama_user');
        $builder->join('tbl_penilaian', 'tbl_penilaian.id_agenda = tbl_agenda.id_agenda', 'left');
        $builder->join('tbl_user', 'tbl_user.id_user = tbl_penilaian.id_user', 'left');
        $builder->orderBy('tbl_agenda.id_agenda');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function DetailData($id_agenda)
    {
        return $this->db->table('tbl_agenda')
            ->where('id_agenda', $id_agenda)
            ->get()->getRowArray();
    }
    public function InsertData($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
        $lastIdResult = $this->db->query("
                        SELECT id_agenda
                        FROM tbl_agenda
                        ORDER BY CAST(SUBSTRING(id_agenda, 4) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_agenda'];
            $lastIdNumber = intval(substr($lastId, 3)); // Mengambil angka setelah 'pim-'
            $newId = 'ik-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'ik-1';
        }
        // Tambahkan ID baru ke data
        $data['id_agenda'] = $newId;

        $this->db->table('tbl_agenda')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('tbl_agenda')
            ->where('id_agenda', $data['id_agenda'])
            ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_agenda')
            ->where('id_agenda', $data['id_agenda'])
            ->delete($data);
    }
    public function UpdateStatus($id_agenda, $data)
    {
        $this->db->table('tbl_agenda')
            ->where('id_agenda', $id_agenda)
            ->update($data);
    }

    public function AllDataKeuangan($id_agenda)
    {
        return $this->db->table('tbl_dana_kegiatan')
            ->where('id_agenda', $id_agenda)
            ->get()->getResultArray();
    }
    public function InsertDataKeuangan($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
        $lastIdResult = $this->db->query("
                        SELECT id_keuangan
                        FROM tbl_dana_kegiatan
                        ORDER BY CAST(SUBSTRING(id_keuangan, 4) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_keuangan'];
            $lastIdNumber = intval(substr($lastId, 3)); // Mengambil angka setelah 'pim-'
            $newId = 'dk-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'dk-1';
        }
        // Tambahkan ID baru ke data
        $data['id_keuangan'] = $newId;

        $this->db->table('tbl_dana_kegiatan')->insert($data);
    }
    public function DeleteDataKeuangan($data)
    {
        $this->db->table('tbl_dana_kegiatan')
            ->where('id_keuangan', $data['id_keuangan'])
            ->delete($data);
    }
    public function UpdateDataKeuangan($data)
    {
        $this->db->table('tbl_dana_kegiatan')
            ->where('id_keuangan', $data['id_keuangan'])
            ->update($data);
    }
    public function getKeuanganById($id_keuangan)
    {
        return $this->db->table('tbl_dana_kegiatan')
            ->where('id_keuangan', $id_keuangan)
            ->get()
            ->getFirstRow('array');
    }
    public function getTotalPemasukanDanPengeluaranPerBulan()
    {
        return $this->db->table('tbl_dana_kegiatan D')
            ->select('A.nama_kegiatan AS kegiatan, A.id_agenda, SUM(D.pemasukan) AS total_pemasukan, SUM(D.pengeluaran) AS total_pengeluaran')
            ->join('tbl_agenda A', 'D.id_agenda = A.id_agenda')
            ->groupBy('A.id_agenda, A.nama_kegiatan')
            ->orderBy('A.id_agenda', 'DESC') // Menambahkan pengurutan berdasarkan id_agenda secara menurun
            ->get()
            ->getResultArray();
    }
    public function getTotalPemasukanDanPengeluaranPerEnamKegiatan()
    {
        return $this->db->table('tbl_dana_kegiatan D')
            ->select('A.nama_kegiatan AS kegiatan, A.id_agenda, SUM(D.pemasukan) AS total_pemasukan, SUM(D.pengeluaran) AS total_pengeluaran')
            ->join('tbl_agenda A', 'D.id_agenda = A.id_agenda')
            ->groupBy('A.id_agenda, A.nama_kegiatan')
            ->orderBy('A.id_agenda', 'DESC') // Menambahkan pengurutan berdasarkan id_agenda secara menurun
            ->limit(6) // Menambahkan batasan hanya 6 agenda yang ditampilkan
            ->get()
            ->getResultArray();
    }

    public function AllAnggaran($id_agenda)
    {
        return $this->db->table('tbl_anggaran')
            ->where('id_agenda', $id_agenda)
            ->get()->getResultArray();
    }
    public function InsertAnggaran($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
        $lastIdResult = $this->db->query("
                        SELECT id_anggaran
                        FROM tbl_anggaran
                        ORDER BY CAST(SUBSTRING(id_anggaran, 4) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_anggaran'];
            $lastIdNumber = intval(substr($lastId, 3)); // Mengambil angka setelah 'pim-'
            $newId = 'ak-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'ak-1';
        }
        // Tambahkan ID baru ke data
        $data['id_anggaran'] = $newId;

        $this->db->table('tbl_anggaran')->insert($data);
    }
    public function DeleteAnggaran($data)
    {
        $this->db->table('tbl_anggaran')
            ->where('id_anggaran', $data['id_anggaran'])
            ->delete($data);
    }
    public function UpdateAnggaran($data)
    {
        $this->db->table('tbl_anggaran')
            ->where('id_anggaran', $data['id_anggaran'])
            ->update($data);
    }

    public function KegiatanDitangggung($id_user)
    {
        $builder = $this->db->table('tbl_agenda AS agenda');
        $builder->select('agenda.id_agenda, agenda.nama_kegiatan, agenda.tanggal, agenda.jam, agenda.Tempat, agenda.status, 
                          ketua.nama_user AS ketua, sekertaris.nama_user AS sekertaris, bendahara.nama_user AS bendahara, 
                          AVG(penilaian.rating) as rating, GROUP_CONCAT(penilaian.komentar SEPARATOR "; ") as komentar');
        $builder->join('tbl_user AS ketua', 'agenda.ketua = ketua.id_user', 'left');
        $builder->join('tbl_user AS sekertaris', 'agenda.sekertaris = sekertaris.id_user', 'left');
        $builder->join('tbl_user AS bendahara', 'agenda.bendahara = bendahara.id_user', 'left');
        $builder->join('tbl_penilaian AS penilaian', 'penilaian.id_agenda = agenda.id_agenda', 'left');
        $builder->where('agenda.status', 'berjalan');
        $builder->groupStart()
            ->where('ketua.id_user', $id_user)
            ->orWhere('sekertaris.id_user', $id_user)
            ->orWhere('bendahara.id_user', $id_user)
            ->groupEnd();
        $builder->groupBy('agenda.id_agenda');
        $builder->orderBy('agenda.id_agenda', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function KegiatanSelesai()
    {
        $builder = $this->db->table('tbl_agenda AS agenda');
        $builder->select('agenda.id_agenda, agenda.nama_kegiatan, agenda.tanggal, agenda.jam, agenda.Tempat, agenda.status, 
                      ketua.nama_user AS ketua, sekertaris.nama_user AS sekertaris, bendahara.nama_user AS bendahara, 
                      AVG(penilaian.rating) as rating, GROUP_CONCAT(penilaian.komentar SEPARATOR "; ") as komentar');
        $builder->join('tbl_user AS ketua', 'agenda.ketua = ketua.id_user', 'left');
        $builder->join('tbl_user AS sekertaris', 'agenda.sekertaris = sekertaris.id_user', 'left');
        $builder->join('tbl_user AS bendahara', 'agenda.bendahara = bendahara.id_user', 'left');
        $builder->join('tbl_penilaian AS penilaian', 'penilaian.id_agenda = agenda.id_agenda', 'left');
        $builder->where('agenda.status', 'selesai');
        $builder->groupBy('agenda.id_agenda');
        $builder->orderBy('agenda.id_agenda', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDataByAgenda($id_agenda)
    {
        return $this->db->table('tbl_dana_kegiatan')
            ->where('id_agenda', $id_agenda)
            ->get()
            ->getResultArray();
    }
    public function getDataByNamaAgenda($id_agenda)
    {
        return $this->db->table('tbl_agenda')
            ->select('nama_kegiatan') // Hanya pilih kolom 'nama_kegiatan'
            ->where('id_agenda', $id_agenda)
            ->get()
            ->getRowArray(); // Menggunakan getRowArray() karena hanya mengambil satu baris
    }

    // Method untuk mendapatkan data kegiatan dengan status berjalan
    public function getKegiatanBerjalan()
    {
        return $this->where('status', 'berjalan')->findAll();
    }
}
