<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'email', 'no_hp', 'password', 'role_id', 'id_jabatan', 'is_verified', 'verification_token', 'reset_token'];

    protected $validationRules = [
        'nama_user' => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[tbl_user.email]',
        'password' => 'required|min_length[6]',
    ];
    
    public function CekUser($email)
    {
        return $this->where('email', $email)->first();
    }
    public function InsertData($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
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

        // Simpan data ke database
        return $this->db->table('tbl_user')->insert($data);
    }

}

