<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProfile;

class Profile extends BaseController
{
    protected $ModelProfile;
    public function __construct()
    {
        $this->ModelProfile = new ModelProfile();
    }
    public function index()
    {
        $data = [
            'judul' => 'Profile User',
            'subjudul' => '',
            'menu' => 'profile',
            'submenu' => '',
            'page' => 'jamaah/v_profile',
        ];
        return view('v_template_admin', $data);
    }
    public function ProfileJamaah($id_user)
    {
        $profilejamaah = $this->ModelProfile->AllDataUser($id_user);
        $data = [
            'judul' => 'Profile',
            'subjudul' => '',
            'menu' => 'profile',
            'submenu' => '',
            'page' => 'jamaah/v_profile',
            'profilejamaah' => $profilejamaah,
        ];
        return view('v_template_admin', $data);
    }
    public function UpdateProfile($profilejamaah)
    {
        $data = [
            'id_user' => $profilejamaah,
            'nama_user' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];
        $this->ModelProfile->EditProfile($data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!');
        return redirect()->to(base_url('Profile/ProfileJamaah/' . $profilejamaah) );
    }
}
