<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSetting extends Model
{
    protected $table = 'tbl_profil_masjid';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_masjid', 'id_kota', 'alamat', 'gambar1', 'gambar2', 'gambar3'];

    public function ViewSetting()
    {
        return $this->where('id', 'pm-1')->first();
    }

    public function UpdateSetting($data)
    {
        try {
            // Misalnya, menggunakan query builder
            $builder = $this->db->table('tbl_profil_masjid');
            $builder->where('id', 'pm-1'); // Sesuaikan ID sesuai kebutuhan
            return $builder->update($data);
        } catch (\Exception $e) {
            log_message('error', 'Error updating setting: ' . $e->getMessage());
            return false;
        }
    }
}
