<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMASJID |
        <?= $judul ?>
    </title>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/login.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="<?= base_url('login/register') ?>" method="post">
                <h1>Buat</h1>
                <h1>Akun Baru</h1>
                <span>gunakan email yang masih aktif</span>
                <input type="text" name="nama_user" placeholder="Name" value="<?= old('nama_user') ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
                <input type="text" name="no_hp" placeholder="Phone Number" value="<?= old('no_hp') ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <a id="loginText" class="register-text" href="#">Masuk</a>
                <button type="submit">Daftar</button>
            </form>
        </div>
        <div class="card-body">
            <div class="container" id="container">
                <!-- ... Isi konten login seperti yang Anda inginkan ... -->
                <div class="form-container sign-in">
                    <form action="<?= base_url('login/CekLogin') ?>" method="post">
                        <h1 style="text-align: center;">
                        <img src="<?= base_url('uploads/masjid komplit.png') ?>" alt="" style="max-height: 110px; /* adjust as needed */"><br>
                            Masuk</h1>
                        <?php if (session()->has('errors')): ?>
                            <div class="text-warning">
                                <?= implode('<br>', session('errors')) ?>
                            </div>
                        <?php elseif (session()->has('gagal')): ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('gagal'); ?>
                            </div>
                        <?php elseif (session()->has('pesan')): ?>
                            <div class="text-success">
                                <?= session()->getFlashdata('pesan'); ?>
                            </div>
                        <?php endif; ?>
                        <span>gunakan alamat email yang terdaftar</span>
                        <input name="email" type="email" class="form-control" placeholder="Email"
                            value="<?= old('email') ?>">
                        <input name="password" type="password" class="form-control" placeholder="Password">
                        <a href="<?= base_url('Login/forgetPassword') ?>" class="reset-password-link">Lupa Kata Sandi?</a>
                        <button type="submit">Masuk</button>
                        <a id="registerText" class="register-text" href="#">Daftar</a>
                    </form>
                </div>
                <!-- ... -->
            </div>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang</h1>
                    <p>Silahkan masukkan data diri anda untuk pembuatan akun.</p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Assalamualaikum</h1>
                    <p>Daftarkan diri anda untuk mengetahui informasi yang lebih lengkap.</p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom script -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/script.js"></script>
</body>

</html>