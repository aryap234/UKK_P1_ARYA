<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$role_saat_ini = isset($_SESSION['role']) ? strtolower(trim($_SESSION['role'])) : '';
$current_page = basename($_SERVER['PHP_SELF']); 
$uri = $_SERVER['REQUEST_URI'];
?>

<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
    <div class="nav flex-column">
        
        <a href="../admin/index.php" class="nav-link <?= ($current_page == 'index.php' && strpos($uri, '/admin/') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-house me-3"></i> Dashboard
        </a>
        
        <?php if ($role_saat_ini == 'admin') : ?>
            <a href="../admin/data_user.php" class="nav-link <?= ($current_page == 'data_user.php') ? 'active' : ''; ?>">
                <i class="fas fa-user-shield me-3"></i> Data User
            </a>
            <a href="../admin/log_aktivitas.php" class="nav-link <?= ($current_page == 'log_aktivitas.php') ? 'active' : ''; ?>">
                <i class="fas fa-clipboard-list me-3"></i> Log Aktivitas
            </a>
        <?php endif; ?>

        <a href="../alat/index.php" class="nav-link <?= (strpos($uri, '/alat/') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-boxes-stacked me-3"></i> 
            <?= ($role_saat_ini == 'peminjam') ? 'Pinjam Alat' : 'Stok Alat'; ?>
        </a>

        <a href="../peminjaman/Datapeminjaman.php" class="nav-link <?= (strpos($uri, '/peminjaman/') !== false) ? 'active' : ''; ?>">
            <i class="fas fa-clock-rotate-left me-3"></i> 
            <?= ($role_saat_ini == 'peminjam') ? 'Riwayat Pinjam Saya' : 'Verifikasi & Riwayat'; ?>
        </a>

        <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;" onclick="return confirm('Yakin ingin keluar?')">
            <i class="fas fa-power-off me-3"></i> Logout
        </a>
    </div>
</div>