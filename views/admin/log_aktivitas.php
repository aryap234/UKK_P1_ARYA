<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Proteksi Halaman (Hanya Admin)
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("location:../admin/index.php");
    exit();
}

$role_user = strtolower(trim($_SESSION['role']));
$user_now  = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas | E-TOOL</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fa; display: flex; margin: 0; min-height: 100vh; }
        .sidebar { width: 280px; background: #111; color: white; padding: 40px 24px; position: fixed; height: 100vh; z-index: 1000; box-sizing: border-box; }
        .sidebar h2 { font-size: 22px; font-weight: 800; text-align: center; margin-bottom: 40px; text-transform: uppercase; line-height: 1.2; color: white; }
        .nav-link { color: #8e8e8e !important; padding: 14px 20px; border-radius: 16px; margin-bottom: 8px; display: flex; align-items: center; text-decoration: none !important; transition: 0.3s; font-size: 15px; }
        .nav-link:hover { color: white !important; background: rgba(255,255,255,0.05); }
        .nav-link.active { background: #fff !important; color: #111 !important; font-weight: 600; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        
        .main-content { margin-left: 280px; padding: 50px; width: calc(100% - 280px); box-sizing: border-box; }
        .page-title { font-weight: 800; font-size: 34px; letter-spacing: -1.8px; color: #111; }
        .table-container { background: white; border-radius: 24px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        
        .table thead th { 
            background: #111 !important; 
            color: #fff !important; 
            font-size: 12px; 
            text-transform: uppercase; 
            font-weight: 700;
            padding: 20px 20px;
            border: none !important;
        }

        .table tbody td { padding: 20px 20px; border-color: #f8f9fa; vertical-align: middle; }
        .badge-aktivitas { 
            background: #f1f3f5; 
            color: #111; 
            font-size: 13px !important; 
            font-weight: 600; 
            padding: 8px 16px; 
            border-radius: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        <a href="index.php" class="nav-link"><i class="fas fa-house me-3"></i> Dashboard</a>
        <a href="data_user.php" class="nav-link"><i class="fas fa-user-shield me-3"></i> Data User</a>
        <a href="log_aktivitas.php" class="nav-link active"><i class="fas fa-clipboard-list me-3"></i> Log Aktivitas</a>
        <a href="../alat/index.php" class="nav-link"><i class="fas fa-boxes-stacked me-3"></i> Stok Alat</a>
        <a href="../peminjaman/Datapeminjaman.php" class="nav-link"><i class="fas fa-clock-rotate-left me-3"></i> Verifikasi & Riwayat</a>
        
        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fas fa-power-off me-3"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title mb-1">Log Aktivitas</h1>
            <p class="text-muted small">Jejak digital seluruh kegiatan di sistem Peminjaman Alat</p>
        </div>
        <button class="btn btn-dark px-4 py-2" style="border-radius: 12px; font-weight: 600;" onclick="window.open('cetak_log.php', '_blank')">
            <i class="fas fa-print me-2"></i> CETAK LAPORAN
        </button>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">NO</th>
                        <th width="20%">USER</th>
                        <th width="45%">AKTIVITAS</th>
                        <th width="30%">WAKTU</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    // Coba query pertama (id_user JOIN user.id)
                    $query = mysqli_query($conn, "SELECT log_aktivitas.*, user.username 
                                                  FROM log_aktivitas 
                                                  JOIN user ON log_aktivitas.id_user = user.id 
                                                  ORDER BY log_aktivitas.id DESC");

                    // Jika gagal, coba query kedua (id_user JOIN user.id_user)
                    if (!$query) {
                        $query = mysqli_query($conn, "SELECT log_aktivitas.*, user.username 
                                                      FROM log_aktivitas 
                                                      JOIN user ON log_aktivitas.id_user = user.id_user 
                                                      ORDER BY log_aktivitas.id DESC");
                    }

                    if($query && mysqli_num_rows($query) > 0) :
                        while($row = mysqli_fetch_assoc($query)) : 
                    ?>
                    <tr>
                        <td class="text-muted fw-bold text-center"><?= $no++; ?></td>
                        <td>
                            <span class="fw-bold" style="color: #111; font-size: 15px;">
                                <i class="fas fa-user-circle me-2 text-muted"></i><?= htmlspecialchars($row['username']); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge-aktivitas">
                                <?= htmlspecialchars($row['aktivitas']); ?>
                            </span>
                        </td>
                        <td class="text-muted small">
                            <i class="far fa-calendar-alt me-1"></i> <?= date('d/m/Y', strtotime($row['waktu'])); ?> 
                            <span class="mx-1">•</span>
                            <i class="far fa-clock me-1"></i> <?= date('H:i', strtotime($row['waktu'])); ?>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    else : 
                    ?>
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-info-circle me-2"></i> Belum ada rekaman aktivitas atau terjadi kesalahan query.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>