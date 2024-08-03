<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLogin;
use App\Models\UserModel;

class Login extends BaseController
{
  // Deklarasi properti model
  protected $ModelLogin;

  public function __construct()
  {
    $this->ModelLogin = new ModelLogin();
  }

  public function index()
  {
    $data = [
      'judul' => 'Login',
      'validation' => \Config\Services::validation(),
    ];
    return view('v_login', $data);
  }
  public function register()
  {
    $password = $this->request->getVar('password');
    $validation = \Config\Services::validation();

    $validation->setRules([
      'nama_user' => 'required|min_length[3]',
      'email' => 'required|valid_email|is_unique[tbl_user.email]',
      'no_hp' => 'required|min_length[10]|max_length[15]',
      'password' => 'required|min_length[6]',
      'confirm_password' => 'required|matches[password]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
      return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $token = bin2hex(random_bytes(16));

    $data = [
      'nama_user' => $this->request->getPost('nama_user'),
      'email' => $this->request->getPost('email'),
      'no_hp' => $this->request->getPost('no_hp'),
      'password' => password_hash($password, PASSWORD_DEFAULT),
      'role_id' => 'jamaah',
      'is_verified' => 0,
      'verification_token' => $token,
    ];
    $this->ModelLogin->InsertData($data);

    $this->sendVerificationEmail($this->request->getPost('email'), $token);

    return redirect()->to(base_url('Login'))->with('pesan', 'Akun berhasil dibuat. Silakan cek email Anda untuk verifikasi.');
  }
  private function sendVerificationEmail($email, $token)
  {
    $emailService = \Config\Services::email();

    $emailService->setTo($email);
    $emailService->setSubject('Verifikasi Email Anda');
    $emailService->setMessage('Klik tautan berikut untuk verifikasi email Anda: ' . base_url('verify/' . $token));

    if ($emailService->send()) {
      return true;
    } else {
      log_message('error', $emailService->printDebugger(['headers']));
      return false;
    }
  }
  public function verify($token)
  {
    $model = new ModelLogin();
    $user = $model->where('verification_token', $token)->first();

    if ($user) {
      // Update is_verified menjadi 1 dan hapus verification_token
      $model->update($user['id_user'], [
        'is_verified' => 1,
        'verification_token' => null
      ]);

      return redirect()->to(base_url('Login'))->with('pesan', 'Email berhasil diverifikasi. Silakan login.');
    } else {
      return redirect()->to(base_url('Login'))->with('gagal', 'Token verifikasi tidak valid.');
    }
  }

  public function CekLogin()
  {
    $validation = \Config\Services::validation(); // Memanggil validation service

    // Validasi input
    if (
      $this->validate([
        'email' => [
          'label' => 'E-Mail',
          'rules' => 'required|valid_email',
          'errors' => [
            'required' => '{field} Belum Diisi',
            'valid_email' => 'Format {field} tidak valid',
          ]
        ],
        'password' => [
          'label' => 'Password',
          'rules' => 'required',
          'errors' => [
            'required' => '{field} Belum Diisi',
          ]
        ]
      ])
    ) {
      $email = $this->request->getPost('email');
      $password = $this->request->getPost('password');

      $user = $this->ModelLogin->CekUser($email);

      if ($user && is_string($password) && password_verify($password, $user['password'])) {
        // Periksa apakah akun sudah diverifikasi
        if ($user['is_verified']) {
          // Password benar dan akun sudah diverifikasi, lakukan sesuatu seperti mengatur session atau mengarahkan pengguna ke halaman lain
          session()->set('nama_user', $user['nama_user']);
          session()->set('role_id', $user['role_id']);
          session()->set('id_user', $user['id_user']);
          session()->set('id_jabatan', $user['id_jabatan']);
          return redirect()->to(base_url('Admin'));
        } else {
          // Akun belum diverifikasi
          session()->setFlashdata('gagal', 'Akun belum diverifikasi. Silakan cek email Anda untuk verifikasi.');
          return redirect()->to(base_url('Login'));
        }
      } else {
        // Password salah atau email tidak ditemukan
        session()->setFlashdata('gagal', 'Email atau Password Salah !!!');
        return redirect()->to(base_url('Login'));
      }
    } else {
      session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
      return redirect()->to(base_url('Login'));
    }
  }
  public function LogOut()
  {
    session()->remove('id_jabatan');
    session()->remove('id_user');
    session()->remove('nama_user');
    session()->remove('role_id');
    session()->setFlashdata('pesan', 'Anda berhasil Logout !!!');
    return redirect()->to(base_url('Login'));
  }

  public function forgetPassword()
  {
    $data = [
      'judul' => 'LupaSandi',
    ];
    return view('forget_password', $data); // Buat view untuk form input email untuk reset password
  }

  public function sendResetLink()
  {
    $email = $this->request->getPost('email');
    $model = new ModelLogin();
    $user = $model->where('email', $email)->first();

    if ($user) {
      // Generate reset token
      $resetToken = bin2hex(random_bytes(50));

      // Simpan token di dalam record pengguna menggunakan metode set()
      $model->set('reset_token', $resetToken);
      $model->where('email', $email)->update();

      // Kirim email dengan link reset password
      $resetLink = base_url('login/resetPassword?token=' . $resetToken);
      $message = "Klik disini untuk mereset password Anda: " . $resetLink;

      $emailService = \Config\Services::email();
      $emailService->setFrom('your-email@example.com', 'Your Name');
      $emailService->setTo($email); // Menggunakan variabel $email dari input form
      $emailService->setSubject('Reset Password');
      $emailService->setMessage($message);

      if ($emailService->send()) {
        session()->setFlashdata('pesan', 'Link reset password telah dikirimkan ke email Anda.');
      } else {
        session()->setFlashdata('gagal', 'Gagal mengirimkan link reset password.');
      }

      return redirect()->to(base_url('login/forgetPassword'));
    } else {
      session()->setFlashdata('gagal', 'Email tidak ditemukan.');
      return redirect()->to(base_url('login/forgetPassword'));
    }
  }

  public function resetPassword()
  {
    $token = $this->request->getGet('token');
    return view('reset_password', ['token' => $token]);
  }

  public function processResetPassword()
  {
    $token = $this->request->getPost('token');
    $newPassword = $this->request->getPost('password');
    $confirmPassword = $this->request->getPost('confirm_password');

    // Validasi bahwa password dan konfirmasi password sama
    if ($newPassword !== $confirmPassword) {
      session()->setFlashdata('gagal', 'Password dan Konfirmasi Password tidak sama.');
      return redirect()->to(base_url('login/resetPassword?token=' . $token));
    }

    // Validasi bahwa password adalah string
    if (!is_string($newPassword)) {
      session()->setFlashdata('gagal', 'Format password tidak valid.');
      return redirect()->to(base_url('login/resetPassword?token=' . $token));
    }

    // Debugging: Cetak token yang diterima dari form
    log_message('debug', 'Token from form: ' . $token);

    // Cari user berdasarkan token
    $model = new ModelLogin();
    $user = $model->where('reset_token', $token)->first();

    // Debugging: Cetak token yang disimpan di database
    log_message('debug', 'Token from database: ' . ($user ? $user['reset_token'] : 'null'));

    if ($user) {
      // Update password user
      $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
      $model->update($user['id_user'], [
        'password' => $hashedPassword,
        'reset_token' => null // Reset token setelah digunakan
      ]);

      // Debugging: Pastikan password baru di-hash dan disimpan
      $updatedUser = $model->find($user['id_user']);
      log_message('debug', 'New password hash: ' . $updatedUser['password']);
      log_message('debug', 'Password has been reset for user: ' . $user['email']);

      session()->setFlashdata('pesan', 'Password telah direset. Anda dapat login sekarang.');
      return redirect()->to(base_url('login'));
    } else {
      log_message('error', 'Invalid token used: ' . $token);
      session()->setFlashdata('gagal', 'Token tidak valid.');
      return redirect()->to(base_url('login/resetPassword?token=' . $token));
    }
  }
}
