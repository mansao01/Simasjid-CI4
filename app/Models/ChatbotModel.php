<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatbotModel extends Model
{
 protected $tableAgenda = 'tbl_agenda';
    protected $tableAnggaran = 'tbl_anggaran';
    protected $primaryKeyAgenda = 'id_agenda';
    protected $primaryKeyAnggaran = 'id_anggaran';

    // Method untuk mendapatkan kegiatan bulan ini
    public function getKegiatanBulanIni()
    {
        return $this->db->table($this->tableAgenda)
            ->where('MONTH(tanggal)', date('m'))
            ->where('YEAR(tanggal)', date('Y'))
            ->get()->getResultArray();
    }

    // Method untuk mendapatkan kegiatan yang sedang berjalan
    public function getKegiatanBerjalan()
    {
        return $this->db->table($this->tableAgenda)
            ->where('status', 'berjalan')
            ->get()->getResultArray();
    }

    // Method untuk mendapatkan ID agenda berdasarkan nama kegiatan
    public function getAgendaIdByName($namaKegiatan)
    {
        return $this->db->table($this->tableAgenda)
            ->where('nama_kegiatan', $namaKegiatan)
            ->get()->getRowArray();
    }

    // Method untuk mendapatkan anggaran berdasarkan ID agenda
    public function getAnggaranByAgenda($idAgenda)
    {
        return $this->db->table($this->tableAnggaran)
            ->where('id_agenda', $idAgenda)
            ->get()->getResultArray();
    }
}
