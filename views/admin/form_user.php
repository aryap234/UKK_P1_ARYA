<?php 
session_start();
include '../../model/m_koneksi.php'; 

if(!isset($_SESSION['role'])){
    header("location:../auth/login.php");
    exit();
}
$role = strtolower($_SESSION['role']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User | E-TOOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fa; display: flex; margin: 0; }
        .sidebar { width: 280px; background: #111; color: white; padding: 40px 24px; position: fixed; height: 100vh; z-index: 1000; box-sizing: border-box; }
        .sidebar h2 { font-size: 22px; font-weight: 800; text-align: center; margin-bottom: 40px; text-transform: uppercase; line-height: 1.2; }
        .nav-link { color: #8e8e8e !important; padding: 14px 20px; border-radius: 16px; margin-bottom: 8px; text-decoration: none !important; display: flex; align-items: center; }
        .nav-link.active { background: #fff !important; color: #111 !important; font-weight: 600; }
        .main-content { margin-left: 280px; padding: 60px 50px; width: calc(100% - 280px); display: flex; flex-direction: column; align-items: center; }
        .form-card { background: white; border-radius: 24px; padding: 40px; width: 100%; max-width: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-control, .form-select { border-radius: 12px; padding: 12px; margin-top: 8px; }
        label { font-size: 12px; font-weight: 800; color: #8e8e8e; text-transform: uppercase; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link"><i class="fas fa-chart-pie me-3"></i> Dashboard</a>
        <a href="data_user.php" class="nav-link active"><i class="fas fa-user-shield me-3"></i> Data User</a>
        <a href="log_aktivitas.php" class="nav-link"><i class="fas fa-list-check me-3"></i> Log Aktivitas</a>
        <a href="../alat/index.php" class="nav-link"><i class="fas fa-box-open me-3"></i> Stok Alat</a>
        <a href="../peminjaman/Datapeminjaman.php" class="nav-link"><i class="fas fa-history me-3"></i>Verifikasi & Riwayat</a>
        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;"><i class="fas fa-power-off me-3"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Tambah User</h1>
    </div>

    <div class="form-card">
        <form action="proses_tambah_user.php" method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" placeholder="Input username" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Input password" required>
            </div>
            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="form-select" required>
                    <option value="Petugas">Petugas</option>
                    <option value="Peminjam">Peminjam</option>
                </select>
            </div>
            <button type="submit" class="btn btn-dark w-100 py-3 fw-bold mb-3" style="border-radius: 12px;">Simpan</button>
            <a href="data_user.php" class="btn btn-light w-100 py-3 fw-bold" style="border-radius: 12px;">Batal</a>
        </form>
    </div>
</div>

</body>
</html>
