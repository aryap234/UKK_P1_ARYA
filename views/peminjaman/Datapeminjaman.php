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
    <title>Riwayat Peminjaman | E-TOOL</title>
    
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
        .badge-status { border-radius: 8px; font-size: 10px; padding: 7px 12px; font-weight: 700; text-transform: uppercase; }
        .btn-action { border-radius: 8px; font-size: 11px; font-weight: 600; padding: 8px 15px; transition: 0.3s; border: none; }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        <a href="../admin/index.php" class="nav-link"><i class="fas fa-house me-3"></i> Dashboard</a>
        
        <?php if ($role_user == 'admin') : ?>
            <a href="../admin/data_user.php" class="nav-link"><i class="fas fa-user-shield me-3"></i> Data User</a>
            <a href="../admin/log_aktivitas.php" class="nav-link"><i class="fas fa-clipboard-list me-3"></i> Log Aktivitas</a>
        <?php endif; ?>

        <a href="../alat/index.php" class="nav-link">
            <i class="fas fa-boxes-stacked me-3"></i> 
            <?= ($role_user == 'peminjam') ? 'Pinjam Alat' : 'Stok Alat'; ?>
        </a>
        
        <a href="Datapeminjaman.php" class="nav-link active">
            <i class="fas fa-clock-rotate-left me-3"></i> 
            <?= ($role_user == 'peminjam') ? 'Riwayat Pinjam Saya' : 'Verifikasi & Riwayat'; ?>
        </a>

        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fas fa-power-off me-3"></i> Logout
        </a>
    </div>
</div>

<div class="main-content">
    <div class="mb-4">
        <h1 class="fw-bold"><?= ($role_user == 'peminjam') ? 'Riwayat Pinjam Saya' : 'Verifikasi & Riwayat'; ?></h1>
        <p class="text-muted">Daftar transaksi peminjaman alat </p>
    </div>

    <div class="table-container text-nowrap">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="text-center" width="5%">NO</th>
                    <th width="20%">PEMINJAM</th>
                    <th width="25%">ALAT</th>
                    <th class="text-center" width="15%">STATUS</th>
                    <?php if ($role_user == 'admin' || $role_user == 'petugas') : ?>
                        <th class="text-center" width="35%">AKSI</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1; 
                $query = "SELECT peminjaman.*, alat.nama_alat FROM peminjaman 
                          JOIN alat ON peminjaman.id_alat = alat.id_alat";
                
                if ($role_user == 'peminjam') {
                    $query .= " WHERE peminjaman.nama = '$user_now'";
                }
                
                $query .= " ORDER BY id_pinjam DESC";
                $result = mysqli_query($conn, $query); 
                
                while($d = mysqli_fetch_array($result)){ 
                    $st = strtoupper($d['status']);
                ?>
                <tr>
                    <td class="text-center text-muted"><?= $no++; ?></td>
                    <td class="fw-bold"><?= htmlspecialchars($d['nama']); ?></td>
                    <td><?= htmlspecialchars($d['nama_alat']); ?></td>
                    <td class="text-center">
                        <?php if($st == 'DIPINJAM') : ?>
                            <span class="badge bg-primary badge-status">DIPINJAM</span>
                        <?php elseif($st == 'KEMBALI' || $st == 'DIKEMBALIKAN') : ?>
                            <span class="badge bg-success badge-status">KEMBALI</span>
                        <?php elseif($st == 'DITOLAK') : ?>
                            <span class="badge bg-secondary badge-status">DITOLAK</span>
                        <?php else : ?>
                            <span class="badge bg-warning text-dark badge-status">PENDING</span>
                        <?php endif; ?>
                    </td>
                    
                    <?php if ($role_user == 'admin' || $role_user == 'petugas') : ?>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <?php if($st == 'PENDING') : ?>
                                <a href="proses_status.php?id=<?= $d['id_pinjam']; ?>&aksi=setujui" class="btn btn-dark btn-action">SETUJUI</a>
                                <a href="proses_status.php?id=<?= $d['id_pinjam']; ?>&aksi=hapus" class="btn btn-danger btn-action" onclick="return confirm('Hapus?')">HAPUS</a>
                            <?php elseif($st == 'DIPINJAM') : ?>
                                <a href="proses_status.php?id=<?= $d['id_pinjam']; ?>&aksi=kembali" class="btn btn-success btn-action">KEMBALIKAN</a>
                            <?php else : ?>
                                <a href="proses_status.php?id=<?= $d['id_pinjam']; ?>&aksi=hapus" class="btn btn-danger btn-action" onclick="return confirm('Hapus?')">HAPUS</a>
                            <?php endif; ?>
                        </div>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>