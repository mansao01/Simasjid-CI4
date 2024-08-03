<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengurusMasjid;

class PengurusMasjid extends BaseController
{
    // Deklarasi properti model
    protected $ModelPengurusMasjid;
    public function __construct()
    {
        $this->ModelPengurusMasjid = new ModelPengurusMasjid();
    }
    public function index()
    {
        $data = [
            'judul' => 'Pengurus Masjid',
            'subjudul' => '',
            'menu' => 'pengurus-masjid',
            'submenu' => '',
            'page' => 'v_pengurus_masjid',
            'anggaran' => $this->ModelPengurusMasjid->AllData(),
            'jabatan' => $this->ModelPengurusMasjid->Jabatan(),
        ];
        return view('v_template_admin', $data);
    }
    public function InsertDataPengurus()
    {
        $password = $this->request->getVar('password');
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'id_jabatan' => $this->request->getPost('jabatan'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => 'pengurus',  // Set role_id as 'petugas', you can change it as needed
            'is_verified' => 1,  // Set default verified status
            'verification_token' => null,  // No verification token needed for this example
            'reset_token' => null,  // No reset token needed for this example
        ];
        $this->ModelPengurusMasjid->InsertData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!!');
        return redirect()->to(base_url('PengurusMasjid'));
    }
    public function UpdateDataPengurus($id_user)
    {
        $password = $this->request->getVar('password');
        $data = [
            'nama_user' => $this->request->getPost('nama_user'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
            'id_jabatan' => $this->request->getPost('jabatan'),
        ];

        // Hanya mengupdate password jika field password tidak kosong
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->ModelPengurusMasjid->update($id_user, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah!!');
        return redirect()->to(base_url('PengurusMasjid'));
    }
    public function DeleteDataPengurus($id_user)
    {
        $data = [
            'id_user' => $id_user,
        ];
        $this->ModelPengurusMasjid->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!!');
        return redirect()->to(base_url('PengurusMasjid'));
    }
}
