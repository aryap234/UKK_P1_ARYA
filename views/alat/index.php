<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Proteksi Halaman
if(!isset($_SESSION['role'])){
    header("location:../auth/login.php");
    exit();
}

// 2. Ambil data session
$role_user = strtolower(trim($_SESSION['role']));
$user_now  = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Alat | E-TOOL</title>
    
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
        .table-container { background: white; border-radius: 24px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .table thead th { background: #111 !important; color: white; padding: 15px; border: none; font-size: 13px; text-transform: uppercase; }
        .btn-action { border-radius: 8px; font-size: 11px; font-weight: 600; padding: 8px 15px; transition: 0.3s; border: none; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        <a href="../dashboard/index.php" class="nav-link"><i class="fas fa-house me-3"></i> Dashboard</a>
        
        <?php if ($role_user == 'admin') : ?>
            <a href="../dashboard/data_user.php" class="nav-link"><i class="fas fa-user-shield me-3"></i> Data User</a>
            <a href="../dashboard/log_aktivitas.php" class="nav-link"><i class="fas fa-clipboard-list me-3"></i> Log Aktivitas</a>
        <?php endif; ?>

        <a href="index.php" class="nav-link active">
            <i class="fas fa-boxes-stacked me-3"></i> 
            <?= ($role_user == 'peminjam') ? 'Pinjam Alat' : 'Stok Alat'; ?>
        </a>
        
        <a href="../peminjaman/Datapeminjaman.php" class="nav-link">
            <i class="fas fa-clock-rotate-left me-3"></i> 
            <?= ($role_user == 'peminjam') ? 'Riwayat Pinjam' : 'Verifikasi & Riwayat'; ?>
        </a>

        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fas fa-power-off me-3"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold"><?= ($role_user == 'peminjam') ? 'Pinjam Alat' : 'Stok Alat'; ?></h1>
            <p class="text-muted"><?= ($role_user == 'peminjam') ? 'Pilih alat yang ingin kamu pinjam' : 'Kelola ketersediaan alat multimedia'; ?></p>
        </div>
        
        <?php if ($role_user != 'peminjam') : ?>
        <a href="tambah_alat.php" class="btn btn-dark btn-action px-4 py-2">
            <i class="fas fa-plus me-2"></i> TAMBAH ALAT
        </a>
        <?php endif; ?>
    </div>

    <div class="table-container text-nowrap">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="text-center" width="5%">NO</th>
                    <th width="40%">NAMA ALAT</th>
                    <th width="15%">STOK</th>
                    <th class="text-center" width="20%">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                $result = mysqli_query($conn, "SELECT * FROM alat ORDER BY id_alat DESC"); 
                while($d = mysqli_fetch_array($result)){ 
                ?>
                <tr>
                    <td class="text-center text-muted"><?= $no++; ?></td>
                    <td class="fw-bold"><?= htmlspecialchars($d['nama_alat']); ?></td>
                    <td><span class="badge bg-light text-dark p-2" style="border-radius: 8px; border: 1px solid #ddd;"><?= $d['stok']; ?> Unit</span></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            
                            <?php if ($role_user != 'peminjam') : ?>
                                <a href="edit_alat.php?id=<?= $d['id_alat']; ?>" class="btn btn-dark btn-action">
                                    <i class="fas fa-edit me-1"></i> EDIT
                                </a>
                                <a href="hapus_alat.php?id=<?= $d['id_alat']; ?>" class="btn btn-danger btn-action" onclick="return confirm('Hapus alat ini?')">
                                    <i class="fas fa-trash-can me-1"></i> HAPUS
                                </a>
                            <?php else : ?>
                                <a href="../peminjaman/pinjam_alat.php?id=<?= $d['id_alat']; ?>" class="btn btn-primary btn-action" style="background: #007bff !important;">
                                    <i class="fas fa-hand-holding-box me-1"></i> PINJAM SEKARANG
                                </a>
                            <?php endif; ?>

                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
