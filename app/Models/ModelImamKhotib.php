<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelImamKhotib extends Model
{
    public function AllData()
    {
        // Mengambil semua data dan mengurutkan berdasarkan bagian numerik dari id_petugas
        return $this->db->query("
                        SELECT *
                        FROM tbl_imam_khotib
                        ORDER BY CAST(SUBSTRING(id_petugas, 5) AS UNSIGNED) ASC
                        ")->getResultArray();
    }
    public function InsertData($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
        $lastIdResult = $this->db->query("
                        SELECT id_petugas
                        FROM tbl_imam_khotib
                        ORDER BY CAST(SUBSTRING(id_petugas, 5) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_petugas'];
            $lastIdNumber = intval(substr($lastId, 4)); // Mengambil angka setelah 'pim-'
            $newId = 'pim-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'pim-1';
        }
        // Tambahkan ID baru ke data
        $data['id_petugas'] = $newId;

        // Simpan data ke database
        return $this->db->table('tbl_imam_khotib')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('tbl_imam_khotib')
            ->where('id_petugas', $data['id_petugas'])
            ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_imam_khotib')
            ->where('id_petugas', $data['id_petugas'])
            ->delete($data);
    }

    public function AllDataJadwal()
    {
        return $this->db->table('tbl_jadwal_imam')
            ->get()
            ->getResultArray();
    }

    public function select()
    {
        return $this->db->table('tbl_imam_khotib')
            ->select('id_petugas, nama_petugas, no_petugas')
            ->get()
            ->getResultArray();
    }
    public function getJadwalWithPetugas()
    {
        return $this->db->table('tbl_jadwal_imam')
            ->select('
                tbl_jadwal_imam.id_jadwal, 
                p.nama_petugas AS pon_name,
                w.nama_petugas AS wage_name,
                k.nama_petugas AS kliwon_name,
                l.nama_petugas AS legi_name,
                h.nama_petugas AS pahing_name,
                dzuhur_i.nama_petugas AS imam_dzuhur_name,
                dzuhur_m.nama_petugas AS muadzin_dzuhur_name,
                asar_i.nama_petugas AS imam_asar_name,
                asar_m.nama_petugas AS muadzin_asar_name,
                maghrib_i.nama_petugas AS imam_maghrib_name,
                maghrib_m.nama_petugas AS muadzin_maghrib_name,
                isya_i.nama_petugas AS imam_isya_name,
                isya_m.nama_petugas AS muadzin_isya_name,
                subuh_i.nama_petugas AS imam_subuh_name,
                subuh_m.nama_petugas AS muadzin_subuh_name
            ')
            ->join('tbl_imam_khotib p', 'tbl_jadwal_imam.pon = p.id_petugas', 'left')
            ->join('tbl_imam_khotib w', 'tbl_jadwal_imam.wage = w.id_petugas', 'left')
            ->join('tbl_imam_khotib k', 'tbl_jadwal_imam.kliwon = k.id_petugas', 'left')
            ->join('tbl_imam_khotib l', 'tbl_jadwal_imam.legi = l.id_petugas', 'left')
            ->join('tbl_imam_khotib h', 'tbl_jadwal_imam.pahing = h.id_petugas', 'left')
            ->join('tbl_imam_khotib dzuhur_i', 'tbl_jadwal_imam.imam_dzuhur = dzuhur_i.id_petugas', 'left')
            ->join('tbl_imam_khotib dzuhur_m', 'tbl_jadwal_imam.muadzin_dzuhur = dzuhur_m.id_petugas', 'left')
            ->join('tbl_imam_khotib asar_i', 'tbl_jadwal_imam.imam_asar = asar_i.id_petugas', 'left')
            ->join('tbl_imam_khotib asar_m', 'tbl_jadwal_imam.muadzin_asar = asar_m.id_petugas', 'left')
            ->join('tbl_imam_khotib maghrib_i', 'tbl_jadwal_imam.imam_maghrib = maghrib_i.id_petugas', 'left')
            ->join('tbl_imam_khotib maghrib_m', 'tbl_jadwal_imam.muadzin_maghrib = maghrib_m.id_petugas', 'left')
            ->join('tbl_imam_khotib isya_i', 'tbl_jadwal_imam.imam_isya = isya_i.id_petugas', 'left')
            ->join('tbl_imam_khotib isya_m', 'tbl_jadwal_imam.muadzin_isya = isya_m.id_petugas', 'left')
            ->join('tbl_imam_khotib subuh_i', 'tbl_jadwal_imam.imam_subuh = subuh_i.id_petugas', 'left')
            ->join('tbl_imam_khotib subuh_m', 'tbl_jadwal_imam.muadzin_subuh = subuh_m.id_petugas', 'left')
            ->get()
            ->getResultArray();
    }
    public function getJadwalWithPetugasa()
    {
        $builder = $this->db->table('tbl_jadwal_imam_khotib');
        $builder->select('tbl_jadwal_imam_khotib.*, tbl_imam_khotib.nama_petugas');
        $builder->join('tbl_imam_khotib', 'tbl_jadwal_imam_khotib.id_petugas = tbl_imam_khotib.id_petugas', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function updateJadwal($id_jadwal, $data)
    {
        return $this->db->table('tbl_jadwal_imam')
            ->where('id_jadwal', $id_jadwal)
            ->update($data);
    }
}
