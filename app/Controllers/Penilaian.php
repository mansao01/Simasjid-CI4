<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPenilaian;

class Penilaian extends BaseController
{
    protected $ModelPenilaian;

    public function __construct()
    {
        $this->ModelPenilaian = new ModelPenilaian();
    }

    public function saveRating()
    {
        $id_agenda = $this->request->getPost('id_agenda');
        $rating = $this->request->getPost('rating');
        $komentar = $this->request->getPost('komentar');
        $id_user = session()->get('id_user'); // Assuming user ID is stored in session

        $data = [
            'id_agenda' => $id_agenda,
            'id_user' => $id_user,
            'rating' => $rating,
            'komentar' => $komentar
        ];

        $this->ModelPenilaian->insert($data);

        session()->setFlashdata('pesan', 'Rating Berhasil Disimpan!');
        return redirect()->to(base_url('Agenda'));
    }
}
