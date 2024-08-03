<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasMasjid extends Model
{
    protected $table = 'tbl_kas_masjid';
    protected $primaryKey = 'id_kas_masjid';
    public function AllData()
    {
        return $this->db->table('tbl_kas_masjid')
            ->orderBy('tanggal', 'ASC')
            ->get()->getResultArray();
    }
    public function AllDataKasMasuk()
    {
        return $this->db->table('tbl_kas_masjid')
        ->select('tbl_kas_masjid.*, tbl_user.nama_user')
        ->join('tbl_user', 'tbl_kas_masjid.id_user = tbl_user.id_user', 'left')
        ->where('tbl_kas_masjid.status', 'masuk')
        ->orderBy('tbl_kas_masjid.tanggal', 'DESC')
        ->get()
        ->getResultArray();
    }
    public function AllDataKasKeluar()
    {
        return $this->db->table('tbl_kas_masjid')
        ->select('tbl_kas_masjid.*, tbl_user.nama_user')
        ->join('tbl_user', 'tbl_kas_masjid.id_user = tbl_user.id_user', 'left')
        ->where('tbl_kas_masjid.status', 'keluar')
        ->orderBy('tbl_kas_masjid.tanggal', 'DESC')
        ->get()
        ->getResultArray();
    }
    
    public function InsertData($data)
    {
        // Dapatkan ID terakhir dengan mengurutkan berdasarkan bagian numerik dari ID
        $lastIdResult = $this->db->query("
                        SELECT id_kas_masjid
                        FROM tbl_kas_masjid
                        ORDER BY CAST(SUBSTRING(id_kas_masjid, 4) AS UNSIGNED) DESC
                        LIMIT 1
                        ")->getRowArray();

        // Tentukan ID baru
        if ($lastIdResult) {
            $lastId = $lastIdResult['id_kas_masjid'];
            $lastIdNumber = intval(substr($lastId, 3)); // Mengambil angka setelah 'pim-'
            $newId = 'km-' . ($lastIdNumber + 1);
        } else {
            // Jika belum ada ID, mulai dari 'pim-1'
            $newId = 'km-1';
        }
        // Tambahkan ID baru ke data
        $data['id_kas_masjid'] = $newId;

       return $this->db->table('tbl_kas_masjid')->insert($data);
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_kas_masjid')
            ->where('id_kas_masjid', $data['id_kas_masjid'])
            ->update($data);
    }
    public function DeleteData($data)
    {
        $this->db->table('tbl_kas_masjid')
            ->where('id_kas_masjid', $data['id_kas_masjid'])
            ->delete($data);
    }
    public function AllDataBulanan($bulan, $tahun)
    {
        return $this->db->table('tbl_kas_masjid')
            ->where('month(tanggal)', $bulan)
            ->where('year(tanggal)', $tahun)
            ->get()->getResultArray();
    }
    //Mengambil nama tanggal untuk tampilan kas dashboard
    public function getBulanTahunIniDanEnamBulanSebelumnya()
    {
        $table = 'tbl_kas_masjid';

        // Ambil data bulan dari kolom yang bertipe date dengan tahun saat ini dan enam bulan sebelumnya
        $query = $this->db->query("
                SELECT 
                    MONTHNAME(tanggal) AS nama_bulan, 
                    YEAR(tanggal) AS tahun, 
                    SUM(kas_masuk) AS total_kas_masuk, 
                    SUM(kas_keluar) AS total_kas_keluar 
                FROM 
                    " . $table . " 
                WHERE 
                    tanggal >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
                    AND (kas_masuk IS NOT NULL OR kas_keluar IS NOT NULL) 
                GROUP BY 
                    YEAR(tanggal), MONTH(tanggal)
                ORDER BY 
                    YEAR(tanggal) ASC, MONTH(tanggal) ASC
            ");
        return $query->getResultArray();
    }
    public function getgrafikKeuanganKeseluruhan()
    {
        $table = 'tbl_kas_masjid';

        // Ambil data bulan dari kolom yang bertipe date dengan tahun saat ini dan enam bulan sebelumnya
        $query = $this->db->query("SELECT MONTHNAME(tanggal) AS nama_bulan, YEAR(tanggal) AS tahun, SUM(kas_masuk) AS total_kas_masuk, SUM(kas_keluar) AS total_kas_keluar FROM " . $table . " WHERE (kas_masuk IS NOT NULL OR kas_keluar IS NOT NULL) GROUP BY YEAR(tanggal), MONTHNAME(tanggal) ORDER BY YEAR(tanggal) ASC, MONTH(tanggal) ASC");

        return $query->getResultArray();
    }
    public function getTotalKasMasukBulanIni()
    {
        $table = 'tbl_kas_masjid';

        // Ambil total kas masuk untuk bulan ini dan tahun ini
        $query = $this->db->query("SELECT SUM(kas_masuk) AS total_kas_masuk 
                               FROM " . $table . " 
                               WHERE YEAR(tanggal) = YEAR(CURDATE()) 
                               AND MONTH(tanggal) = MONTH(CURDATE())");

        return $query->getRowArray()['total_kas_masuk']; // Mengambil nilai langsung dari baris hasil
    }

    public function getTotalPemasukanBulanIni()
    {
        return $this->db->table('tbl_kas_masjid')
            ->selectSum('kas_masuk')
            ->where('MONTH(tanggal)', date('m'))
            ->where('YEAR(tanggal)', date('Y'))
            ->get()
            ->getRowArray()['kas_masuk'];
    }

    public function getTotalPemasukanBulanLalu()
    {
        // Bulan lalu
        $bulan_lalu = date('m') - 1;
        $tahun_lalu = date('Y');
        if ($bulan_lalu == 0) {
            $bulan_lalu = 12;
            $tahun_lalu--;
        }

        return $this->db->table('tbl_kas_masjid')
            ->selectSum('kas_masuk')
            ->where('MONTH(tanggal)', $bulan_lalu)
            ->where('YEAR(tanggal)', $tahun_lalu)
            ->get()
            ->getRowArray()['kas_masuk'];
    }
    public function getDataByDateRange($tglAwal, $tglAkhir)
    {
        return $this->where('tanggal >=', $tglAwal)
            ->where('tanggal <=', $tglAkhir)
            ->orderBy('tanggal', 'ASC') // Mengurutkan berdasarkan id dari terbesar ke terkecil
            ->findAll();
    }

    public function getTotalBeforeDate($tglAwal)
    {
        $query = $this->selectSum('kas_masuk', 'total_masuk')
            ->selectSum('kas_keluar', 'total_keluar')
            ->where('tanggal <', $tglAwal)
            ->first();

        return [
            'total_masuk' => $query['total_masuk'] ?? 0,
            'total_keluar' => $query['total_keluar'] ?? 0,
        ];
    }

    public function AllDataRiwayatCetak()
    {
        return $this->db->table('tbl_riwayat_cetak_laporan')
            ->join('tbl_user', 'tbl_riwayat_cetak_laporan.id_user = tbl_user.id_user')
            ->select('tbl_riwayat_cetak_laporan.*, tbl_user.nama_user')
            ->get()
            ->getResultArray();
    }
}
