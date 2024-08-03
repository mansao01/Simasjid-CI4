<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama_user', 'email', 'no_hp', 'password', 'role_id', 'id_jabatan', 'is_verified', 'verification_token', 'reset_token'];

    // Optionally you can add validation rules here
    protected $validationRules = [
        'nama_user' => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[tbl_user.email]',
        'password' => 'required|min_length[6]',
    ];
    
}
