<?php
session_start();
include '../../model/m_koneksi.php';

// 1. CEK SESSION (Biar gak usah login ulang kalau sudah masuk)
if (isset($_SESSION['role'])) {
    // SEMUA DILEMPAR KE SINI (Satu pintu biar gak pusing path-nya)
    header("location: ../../admin/index.php");
    exit();
}

$error = "";

// 2. PROSES LOGIN
if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    // Query ke database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        // Simpan data ke Session
        $_SESSION['id_user']  = $data['id']; 
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = strtolower(trim($data['role']));

        // Panggil Log Otomatis (Opsional, pastikan fungsi ada di m_koneksi)
        if (function_exists('simpan_log')) {
            simpan_log($conn, $data['id'], "Login ke sistem");
        }

        // 3. LOGIKA REDIRECT (JALAN BALIK KE ADMIN INDEX)
        // Dari folder 'auth', mundur 1x (../) terus masuk ke 'views/admin'
        header("location:/views/admin/index.php");
        exit();

    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Peminjaman Alat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); width: 100%; max-width: 400px; border: 1px solid #f1f1f1; }
        .btn-dark { background: #1a1a1a !important; border: none; border-radius: 12px; padding: 12px; font-weight: 600; transition: 0.3s; }
        .btn-dark:hover { background: #000 !important; transform: scale(1.02); }
        .form-control { border-radius: 10px; padding: 12px; background: #fdfdfd; }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <h2 class="fw-800 text-dark">PEMINJAMAN ALAT</h2>
        <p class="text-muted small">Silahkan masuk ke akun anda</p>
    </div>

    <?php if($error != ""): ?>
        <div class="alert alert-danger py-2 small text-center">
            <i class="fas fa-exclamation-circle me-2"></i> <?= $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label small fw-bold">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold">Password</label>
            <input type="password" name="password" class="form-control" placeholder="password" required>
        </div>

        <button type="submit" name="login" class="btn btn-dark w-100">
            Masuk <i class="fas fa-sign-in-alt ms-2"></i>
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="https://wa.me/6283130151817" target="_blank" class="text-muted small text-decoration-none">
            Lupa password?<span class="text-primary fw-bold">Hubungi Admin ya🤗</span>
        </a>
    </div>
</div>

</body>
</html>