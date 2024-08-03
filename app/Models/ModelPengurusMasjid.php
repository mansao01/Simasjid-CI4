<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengurusMasjid extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'nama_user', 'email', 'no_hp', 'id_jabatan', 'password', 'role_id', 'is_verified', 'verification_token', 'reset_token'
    ];
    public function AllData()
    {
        return $this->db->table($this->table)
            ->select('tbl_user.*, tbl_jabatan.Nama_jabatan')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan = tbl_user.id_jabatan', 'left')
            ->where('role_id', 'pengurus')
            ->orderBy('tbl_jabatan.id_jabatan', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function Jabatan()
    {
        return $this->db->query("
                SELECT *
                FROM tbl_jabatan
                ORDER BY CAST(SUBSTRING(id_jabatan, 4) AS UNSIGNED) ASC
                ")->getResultArray();
    }
    public function InsertData($data)
    {
        $lastIdResult = $this->db->query("
                        SELECT id_user
                        FROM tbl_user
                        ORDER BY CAST(SUBSTRING(id_user, 3) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_user'];
            $lastIdNumber = intval(substr($lastId, 2)); // Mengambil angka setelah 'pim-'
            $newId = 'u-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'u-1';
        }
        // Tambahkan ID baru ke data
        $data['id_user'] = $newId;

        $this->db->table('tbl_user')->insert($data);
    }
    public function UpdateData($id_user, $data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $id_user)
            ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->delete($data);
    }
}
