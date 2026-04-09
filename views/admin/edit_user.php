<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Cek Login & ID
$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id == "") { header("location:data_user.php"); exit(); }

// 2. Tarik data user sesuai ID (Gunakan variabel $conn dari m_koneksi)
$query = mysqli_query($conn, "SELECT * FROM user WHERE id = '$id'"); 
$d = mysqli_fetch_array($query);

// --- LOGIKA A: SIMPAN PERUBAHAN (Username & Role) ---
if (isset($_POST['update_data'])) {
    $user_input = mysqli_real_escape_string($conn, $_POST['username']);
    $role_input = $_POST['role'];
    
    $sql = "UPDATE user SET username='$user_input', role='$role_input' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='data_user.php';</script>";
    }
}

// --- LOGIKA B: RESET PASSWORD (OPSI 1 yang kamu mau) ---
if (isset($_POST['reset_pw'])) {
    // Reset ke 123456 TANPA MD5 (Sesuai database kamu)
    $pw_baru = "123456"; 
    $sql_pw = "UPDATE user SET password='$pw_baru' WHERE id='$id'";
    
    if (mysqli_query($conn, $sql_pw)) {
        echo "<script>alert('Password Berhasil di-reset ke: 123456'); window.location='data_user.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit & Reset User | E-TOOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f2f5; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card-edit { background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); width: 100%; max-width: 400px; }
        .btn-dark { background: #111 !important; border: none; border-radius: 12px; padding: 12px; font-weight: 600; width: 100%; color: white; }
        .btn-reset { background: #fff; color: #dc3545; border: 1px solid #dc3545; border-radius: 12px; padding: 10px; width: 100%; font-weight: 600; transition: 0.3s; }
        .btn-reset:hover { background: #dc3545; color: #fff; }
        .form-control, .form-select { border-radius: 10px; padding: 12px; margin-bottom: 15px; background: #f9f9f9; }
    </style>
</head>
<body>

<div class="card-edit">
    <h4 class="fw-800 text-center mb-4">Edit User</h4>
    
    <form method="POST">
        <label class="form-label small fw-bold">Username</label>
        <input type="text" name="username" class="form-control" value="<?= $d['username']; ?>" required>

        <label class="form-label small fw-bold">Role</label>
        <select name="role" class="form-select">
            <option value="admin" <?= ($d['role']=='admin'?'selected':''); ?>>ADMIN</option>
            <option value="petugas" <?= ($d['role']=='petugas'?'selected':''); ?>>PETUGAS</option>
            <option value="peminjam" <?= ($d['role']=='peminjam'?'selected':''); ?>>PEMINJAM</option>
        </select>

        <button type="submit" name="update_data" class="btn btn-dark mt-2 mb-3">
            <i class="fas fa-save me-2"></i> Simpan Perubahan
        </button>
    </form>

    <hr class="my-4">

    <div class="text-center">
        <p class="text-muted small mb-2">Peminjam lupa password?</p>
        <form method="POST">
            <button type="submit" name="reset_pw" class="btn btn-reset" onclick="return confirm('Yakin reset password user ini ke 123456?')">
                <i class="fas fa-key me-2"></i> Reset ke 123456
            </button>
        </form>
    </div>

    <div class="mt-4 text-center">
        <a href="data_user.php" class="text-muted small text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Data User
        </a>
    </div>
</div>

</body>
</html>