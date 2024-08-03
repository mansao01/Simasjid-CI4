<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasSosial extends Model
{
    public function AllData()
    {
        return $this->db->table('tbl_kas_sosial')
            ->get()->getResultArray();
    }
    public function AllDataKasMasuk()
    {
        return $this->db->table('tbl_kas_sosial')
            ->where('status', 'masuk')
            ->get()->getResultArray();
    }
    public function AllDataKasKeluar()
    {
        return $this->db->table('tbl_kas_sosial')
            ->where('status', 'keluar')
            ->get()->getResultArray();
    }
    public function InsertData($data)
    {
        $this->db->table('tbl_kas_sosial')->insert($data);
    }
    public function UpdateData($data)
    {
        $this->db->table('tbl_kas_sosial')
        ->where('id_kas_sosial', $data['id_kas_sosial'])
        ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_kas_sosial')
        ->where('id_kas_sosial', $data['id_kas_sosial'])
        ->delete($data);
    }
    public function AllDataBulanan($bulan, $tahun)
    {
        return $this->db->table('tbl_kas_sosial')
            ->where('month(tanggal)', $bulan)
            ->where('year(tanggal)', $tahun)
            ->get()->getResultArray();
    }
}
