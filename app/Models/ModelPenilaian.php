<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenilaian extends Model
{
    protected $table = 'tbl_penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_agenda', 'id_user', 'rating', 'komentar'];

    public function InsertPenilaian($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
        $lastIdResult = $this->db->query("
                        SELECT id_penilaian
                        FROM tbl_penilaian
                        ORDER BY CAST(SUBSTRING(id_penilaian, 4) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_penilaian'];
            $lastIdNumber = intval(substr($lastId, 3)); // Mengambil angka setelah 'pim-'
            $newId = 'rk-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'rk-1';
        }
        // Tambahkan ID baru ke data
        $data['id_penilaian'] = $newId;
        
        $this->db->table('tbl_penilaian')->insert($data);
    }

    public function getPenilaianByAgenda($id_agenda)
    {
        return $this->where('id_agenda', $id_agenda)->findAll();
    }
    public function hasUserRated($id_agenda, $id_user)
    {
        return $this->where(['id_agenda' => $id_agenda, 'id_user' => $id_user])->first();
    }
}
