<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMASJID | Reset Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/forgetpassword.css">
</head>

<body>

    <div class="container">
        <div class="form-container sign-up">
            <!-- app/Views/reset_password.php -->
            <form action="<?= base_url('login/processResetPassword') ?>" method="post">
            <h1 style="text-align: center;">
                        <img src="<?= base_url('uploads/masjid komplit.png') ?>" alt="" style="max-height: 110px; /* adjust as needed */"><br> Reset Password</h1>
                <?php if (session()->has('pesan')): ?>
                    <p style="color: green;"><?= session('pesan') ?></p>
                <?php elseif (session()->has('gagal')): ?>
                    <p style="color: red;"><?= session('gagal') ?></p>
                <?php endif; ?>
                <span>masukkan password baru</span>
                <input type="hidden" name="token" value="<?= esc($token) ?>">
                <input type="password" id="password" name="password" placeholder="New Password" required>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
                <button type="submit">Reset Password</button>
            </form>
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