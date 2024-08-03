<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProfile extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'email', 'no_hp', 'password', 'role_id', 'id_jabatan', 'is_verified', 'verification_token', 'reset_token'];
    public function AllDataUser($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }

    public function getUsersByJabatan(array $jabatan)
    {
        return $this->whereIn('id_jabatan', $jabatan)->findAll();
    }
    public function EditProfile($data)
    {
        return $this->db->table('tbl_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }
}
