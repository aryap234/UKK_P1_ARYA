<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Proteksi Halaman (Admin Only)
if(!isset($_SESSION['role']) || strtolower($_SESSION['role']) != 'admin'){
    header("location:index.php");
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
    <title>Data user</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fa; display: flex; margin: 0; min-height: 100vh; }
        
        /* SIDEBAR STYLE */
        .sidebar { width: 280px; background: #111; color: white; padding: 40px 24px; position: fixed; height: 100vh; z-index: 1000; box-sizing: border-box; }
        .sidebar h2 { font-size: 22px; font-weight: 800; text-align: center; margin-bottom: 40px; text-transform: uppercase; line-height: 1.2; color: white; }
        .nav-link { color: #8e8e8e !important; padding: 14px 20px; border-radius: 16px; margin-bottom: 8px; text-decoration: none !important; display: flex; align-items: center; transition: 0.3s; font-size: 15px; }
        .nav-link:hover { color: white !important; background: rgba(255,255,255,0.05); }
        .nav-link.active { background: #fff !important; color: #111 !important; font-weight: 600; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        
        /* MAIN CONTENT */
        .main-content { margin-left: 280px; padding: 50px; width: calc(100% - 280px); box-sizing: border-box; }
        .table-container { background: white; border-radius: 24px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        .table thead th { background: #113 !important; color: white; padding: 15px; border: none; font-size: 13px; text-transform: uppercase; }
        
        /* BADGE ROLE - SEMUA HITAM */
        .badge-role { border-radius: 8px; font-size: 10px; padding: 7px 12px; font-weight: 700; text-transform: uppercase; background: #111 !important; color: white; }
        
        /* BUTTON CUSTOM */
        .btn-action { border-radius: 8px; font-size: 11px; font-weight: 600; padding: 8px 15px; transition: 0.3s; border: none; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link"><i class="fas fa-house me-3"></i> Dashboard</a>
        <a href="data_user.php" class="nav-link active"><i class="fas fa-user-shield me-3"></i> Data User</a>
        <a href="log_aktivitas.php" class="nav-link"><i class="fas fa-clipboard-list me-3"></i> Log Aktivitas</a>
        <a href="../alat/index.php" class="nav-link"><i class="fas fa-boxes-stacked me-3"></i> Stok Alat</a>
        <a href="../peminjaman/Datapeminjaman.php" class="nav-link"><i class="fas fa-history me-3"></i> Verifikasi & Riwayat</a>
        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;" onclick="return confirm('Keluar?')">
            <i class="fas fa-power-off me-3"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Data User</h1>
            <p class="text-muted">Manajemen akun sistem peminjaman alat</p>
        </div>
        <a href="form_user.php" class="btn btn-dark btn-action px-4 py-2 text-decoration-none">
            <i class="fas fa-plus me-2"></i> TAMBAH USER
        </a>
    </div>

    <div class="table-container text-nowrap">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="text-center" width="5%">NO</th>
                    <th width="35%">USERNAME</th>
                    <th class="text-center" width="20%">ROLE</th>
                    <th class="text-center" width="40%">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                $result = mysqli_query($conn, "SELECT * FROM user ORDER BY id DESC"); 
                while($d = mysqli_fetch_array($result)){ 
                ?>
                <tr>
                    <td class="text-center text-muted"><?= $no++; ?></td>
                    <td class="fw-bold"><?= htmlspecialchars($d['username']); ?></td>
                    <td class="text-center">
                        <span class="badge badge-role"><?= strtoupper($d['role']); ?></span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="edit_user.php?id=<?= $d['id']; ?>" class="btn btn-dark btn-action">
                                <i class="fas fa-edit me-1"></i> EDIT
                            </a>
                            <a href="hapus_user.php?id=<?= $d['id']; ?>" class="btn btn-danger btn-action" onclick="return confirm('Hapus?')">
                                <i class="fas fa-trash-can me-1"></i> HAPUS
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>