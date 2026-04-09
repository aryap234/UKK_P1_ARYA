<?php 
session_start();
include '../../model/m_koneksi.php';

$id = $_GET['id'];
$role = strtolower($_SESSION['role']);

// Ambil data peminjaman yang mau diedit
$query_data = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_pinjam = '$id'");
$d = mysqli_fetch_array($query_data);

// Proses Update
if(isset($_POST['update'])){
    $status = $_POST['status'];
    $update = mysqli_query($conn, "UPDATE peminjaman SET status='$status' WHERE id_pinjam='$id'");
    
    if($update){
        echo "<script>alert('Status Berhasil Diperbarui!'); window.location='Datapeminjaman.php';</script>";
    } else {
        echo "<script>alert('Gagal Update!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Riwayat | E-TOOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fa; display: flex; margin: 0; }
        .sidebar { width: 280px; background: #111; color: white; padding: 40px 24px; position: fixed; height: 100vh; }
        .sidebar h2 { font-size: 22px; font-weight: 800; text-align: center; margin-bottom: 40px; text-transform: uppercase; color: white; }
        .nav-link { color: #8e8e8e !important; padding: 14px 20px; border-radius: 16px; margin-bottom: 8px; text-decoration: none !important; display: flex; align-items: center; }
        .nav-link.active { background: #fff !important; color: #111 !important; font-weight: 600; }
        .main-content { margin-left: 280px; padding: 60px 50px; width: calc(100% - 280px); display: flex; flex-direction: column; align-items: center; }
        .form-card { background: white; border-radius: 24px; padding: 40px; width: 100%; max-width: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>PEMINJAMAN<br>ALAT</h2>
        <div class="nav flex-column">
            <a href="../admin/index.php" class="nav-link"><i class="fas fa-chart-pie me-3"></i> Dashboard</a>
            <a href="../alat/index.php" class="nav-link"><i class="fas fa-box-open me-3"></i> Stok Alat</a>
            <a href="Datapeminjaman.php" class="nav-link active"><i class="fas fa-history me-3"></i> Riwayat</a>
            <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 50px;"><i class="fas fa-power-off me-3"></i> Logout</a>
        </div>
    </div>

    <div class="main-content">
        <h1 class="fw-bold mb-4">Edit Status Pinjam</h1>
        <div class="form-card">
            <form method="POST">
                <div class="mb-4">
                    <label class="small fw-bold text-muted mb-2">NAMA PEMINJAM</label>
                    <input type="text" class="form-control bg-light" value="<?= $d['nama']; ?>" readonly style="border-radius: 12px; padding: 12px;">
                </div>
                <div class="mb-4">
                    <label class="small fw-bold text-muted mb-2">STATUS</label>
                    <select name="status" class="form-select" style="border-radius: 12px; padding: 12px;">
                        <option value="Dipinjam" <?= ($d['status'] == 'Dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                        <option value="Dikembalikan" <?= ($d['status'] == 'Dikembalikan') ? 'selected' : ''; ?>>Dikembalikan</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-dark w-100 py-3 fw-bold mb-3" style="border-radius: 12px;">Simpan Perubahan</button>
                <a href="Datapeminjaman.php" class="btn btn-light w-100 py-3 fw-bold" style="border-radius: 12px;">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>
