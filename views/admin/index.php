<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Proteksi Halaman
if(!isset($_SESSION['id_user'])){
    header("location:../auth/login.php");
    exit();
}

// 2. Ambil data session
$user_now  = $_SESSION['username'];
$role_user = strtolower(trim($_SESSION['role'])); 

// 3. Query Statistik
$total_alat   = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM alat"));
// Query total pinjam disesuain biar akurat (biasanya status 'DIPINJAM')
$total_pinjam = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM peminjaman WHERE status='DIPINJAM'"));
$total_user   = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | E-TOOL</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fa; display: flex; margin: 0; min-height: 100vh; }
        .sidebar { width: 280px; background: #111; color: white; padding: 40px 24px; position: fixed; height: 100vh; z-index: 1000; box-sizing: border-box; }
        .sidebar h2 { font-size: 22px; font-weight: 800; text-align: center; margin-bottom: 40px; text-transform: uppercase; line-height: 1.2; color: white; }
        .nav-link { color: #8e8e8e !important; padding: 14px 20px; border-radius: 16px; margin-bottom: 8px; text-decoration: none !important; display: flex; align-items: center; transition: 0.3s; font-size: 15px; }
        .nav-link:hover { color: white !important; background: rgba(255,255,255,0.05); }
        .nav-link.active { background: #fff !important; color: #111 !important; font-weight: 600; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        
        .main-content { margin-left: 280px; padding: 50px; width: calc(100% - 280px); box-sizing: border-box; }
        .card-stat { background: white; border-radius: 24px; padding: 30px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.3s; }
        .card-stat:hover { transform: translateY(-5px); }
        .icon-box { width: 55px; height: 55px; border-radius: 15px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link active"><i class="fas fa-house me-3"></i> Dashboard</a>
        
        <?php if ($role_user == 'admin') : ?>
            <a href="data_user.php" class="nav-link"><i class="fas fa-user-shield me-3"></i> Data User</a>
            <a href="log_aktivitas.php" class="nav-link"><i class="fas fa-clipboard-list me-3"></i> Log Aktivitas</a>
        <?php endif; ?>

        <a href="../alat/index.php" class="nav-link">
            <i class="fas fa-boxes-stacked me-3"></i> 
            <?= ($role_user == 'peminjam') ? 'Pinjam Alat' : 'Stok Alat'; ?>
        </a>
        
        <a href="../peminjaman/Datapeminjaman.php" class="nav-link">
            <i class="fas fa-clock-rotate-left me-3"></i> 
            <?= ($role_user == 'peminjam') ? 'Riwayat Pinjam Saya' : 'Verifikasi & Riwayat'; ?>
        </a>

        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fas fa-power-off me-3"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="mb-5">
        <h1 class="fw-800" style="letter-spacing: -1px;">Selamat Datang, <?= htmlspecialchars($user_now); ?>!</h1>
        <p class="text-muted">Status Login: <span class="badge bg-dark" style="padding: 6px 12px; border-radius: 8px;"><?= strtoupper($role_user); ?></span></p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-stat">
                <div class="icon-box" style="background: #eef2ff; color: #4f46e5;"><i class="fas fa-box-archive"></i></div>
                <p class="text-muted small fw-bold mb-1">TOTAL STOK ALAT</p>
                <h2 class="fw-bold m-0"><?= $total_alat; ?> <span style="font-size: 14px; opacity: 0.5;">Unit</span></h2>
            </div>
        </div>

        <?php if ($role_user != 'peminjam') : ?>
        <div class="col-md-4">
            <div class="card-stat">
                <div class="icon-box" style="background: #fff7ed; color: #ea580c;"><i class="fas fa-handshake"></i></div>
                <p class="text-muted small fw-bold mb-1">SEDANG DIPINJAM</p>
                <h2 class="fw-bold m-0"><?= $total_pinjam; ?> <span style="font-size: 14px; opacity: 0.5;">Transaksi</span></h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-stat">
                <div class="icon-box" style="background: #f0fdf4; color: #16a34a;"><i class="fas fa-users-gear"></i></div>
                <p class="text-muted small fw-bold mb-1">TOTAL PENGGUNA</p>
                <h2 class="fw-bold m-0"><?= $total_user; ?> <span style="font-size: 14px; opacity: 0.5;">Orang</span></h2>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>