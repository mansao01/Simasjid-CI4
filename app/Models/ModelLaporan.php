<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporan extends Model
{
    protected $table = 'tbl_riwayat_cetak_laporan';
    protected $primaryKey = 'id_laporan';
    protected $allowedFields = [
        'tgl_cetak', 
        'total_pemasukan', 
        'total_pengeluaran', 
        'saldo', 
        'tgl_awal', 
        'tgl_akhir', 
        'id_user'
    ];
}
