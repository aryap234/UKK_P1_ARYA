<?php 
session_start();
include '../../model/m_koneksi.php';

if(!isset($_SESSION['role'])){
    header("location:../auth/login.php");
    exit();
}
$role = strtolower($_SESSION['role']);

// PROSES SIMPAN
if(isset($_POST['simpan'])){
    $nama_alat = $_POST['nama_alat'];
    $stok      = $_POST['stok'];

    $query = mysqli_query($conn, "INSERT INTO alat (nama_alat, stok) VALUES ('$nama_alat', '$stok')");

    if($query){
        $id_u = $_SESSION['id_user'];
        $ket  = "Menambah alat baru: $nama_alat ($stok Unit)";
        mysqli_query($conn, "INSERT INTO log_aktivitas (id_user, aktivitas) VALUES ('$id_u', '$ket')");
        
        echo "<script>alert('Berhasil! Alat sudah ditambah.'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alat | E-TOOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8f9fa; display: flex; margin: 0; }
        
        /* SIDEBAR TETAP KONSISTEN */
        .sidebar { width: 280px; background: #111; color: white; padding: 40px 24px; position: fixed; height: 100vh; z-index: 1000; box-sizing: border-box; }
        .sidebar h2 { font-size: 22px; font-weight: 800; text-align: center; margin-bottom: 40px; text-transform: uppercase; line-height: 1.2; color: white; }
        .nav-link { color: #8e8e8e !important; padding: 14px 20px; border-radius: 16px; margin-bottom: 8px; text-decoration: none !important; display: flex; align-items: center; }
        .nav-link.active { background: #fff !important; color: #111 !important; font-weight: 600; }
        
        /* BIAR GAK TERLALU BAWAH */
        .main-content { 
            margin-left: 280px; 
            padding: 60px 50px; /* Padding atas ditambah biar gak mepet plafon */
            width: calc(100% - 280px); 
            box-sizing: border-box; 
            display: flex; 
            flex-direction: column; /* Ubah ke column */
            align-items: center; 
        }
        
        .form-container { 
            background: white; 
            border-radius: 24px; 
            padding: 40px; 
            width: 100%; 
            max-width: 500px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
            margin-top: 20px; /* Jarak dari judul atas */
        }
        
        .form-control { border-radius: 12px; padding: 12px; border: 1px solid #eee; margin-bottom: 20px; }
        .btn-simpan { background: #111; color: white; border-radius: 12px; padding: 12px; width: 100%; font-weight: 600; border: none; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>PEMINJAMAN<br>ALAT</h2>
     <div class="nav flex-column">
    <a href="../admin/index.php" class="nav-link">
        <i class="fas fa-th-large"></i> Dashboard
    </a>
    
    <?php if ($role == 'admin') : ?>
        <a href="../admin/data_user.php" class="nav-link">
            <i class="fas fa-user-shield"></i> Data User
        </a>
        <a href="../admin/log_aktivitas.php" class="nav-link">
            <i class="fas fa-list-ul"></i> Log Aktivitas
        </a>
    <?php endif; ?>

    <a href="index.php" class="nav-link active">
        <i class="fas fa-boxes-stacked"></i> Stok Alat
    </a>

    <a href="../peminjaman/Datapeminjaman.php" class="nav-link">
        <i class="fas fa-history"></i> Peminjaman
    </a>
    
    <a href="../auth/logout.php" class="nav-link text-danger" style="margin-top: 100px;" onclick="return confirm('Keluar?')">
        <i class="fas fa-power-off"></i> Logout
    </a>
</div>
</div>

<div class="main-content">
    <div style="width: 100%; max-width: 500px;">
        <h1 class="fw-bold mb-2">Tambah Alat</h1>
        <p class="text-muted mb-4">Input data stok alat baru ke sistem.</p>
    </div>

    <div class="form-container">
        <form method="POST">
            <label class="small fw-bold text-muted mb-2 text-uppercase">Nama Alat</label>
            <input type="text" name="nama_alat" class="form-control" placeholderrequired>

            <label class="small fw-bold text-muted mb-2 text-uppercase">Jumlah Stok</label>
            <input type="number" name="stok" class="form-control" placeholder="0" required>

            <button type="submit" name="simpan" class="btn-simpan">Simpan Data Alat</button>
            <a href="index.php" class="btn btn-light w-100 mt-2" style="border-radius: 12px; padding: 12px;">Batal & Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
