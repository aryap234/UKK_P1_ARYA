<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Ambil ID Alat dari URL
$id_url = isset($_GET['id']) ? $_GET['id'] : '';

// 2. Jika Tombol Diklik
if(isset($_POST['btn_simpan'])){
    $nama    = mysqli_real_escape_string($conn, $_POST['nama_peminjam']);
    $id_alat = $_POST['id_alat_hidden'];
    $jumlah  = (int)$_POST['jumlah_pinjam'];
    $tanggal = $_POST['tgl_pinjam'];
    $status  = "Pending"; // Otomatis Pending

    if(!empty($id_alat)){
        // Query Simpan (Hanya INSERT, belum UPDATE stok)
        $sql = "INSERT INTO peminjaman (nama, id_alat, jumlah, tgl_pinjam, status) 
                VALUES ('$nama', '$id_alat', '$jumlah', '$tanggal', '$status')";
        
        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Berhasil diajukan! Menunggu persetujuan petugas.'); window.location='Datapeminjaman.php';</script>";
        } else {
            echo "Gagal: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error: ID Alat Kosong!'); window.history.back();</script>";
    }
    exit();
}

$q_alat = mysqli_query($conn, "SELECT * FROM alat WHERE id_alat = '$id_url'");
$alat = mysqli_fetch_array($q_alat);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; padding: 20px; }
        .card { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
<div class="card p-4 mx-auto" style="max-width: 400px;">
    <h4 class="fw-bold mb-4">Form Pengajuan</h4>
    <form action="" method="POST">
        <input type="hidden" name="id_alat_hidden" value="<?= $id_url; ?>">
        <div class="mb-3">
            <label class="small fw-bold text-muted">ALAT</label>
            <input type="text" class="form-control bg-light" value="<?= $alat['nama_alat'] ?? 'Tidak Ditemukan'; ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="small fw-bold">NAMA PEMINJAM</label>
            <input type="text" name="nama_peminjam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="small fw-bold">JUMLAH (Stok: <?= $alat['stok'] ?? 0; ?>)</label>
            <input type="number" name="jumlah_pinjam" class="form-control" min="1" max="<?= $alat['stok']; ?>" value="1" required>
        </div>
        <div class="mb-4">
            <label class="small fw-bold">TANGGAL PINJAM</label>
            <input type="date" name="tgl_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
        </div>
        <button type="submit" name="btn_simpan" class="btn btn-dark w-100 fw-bold py-2">AJUKAN SEKARANG</button>
    </form>
</div>
</body>
</html>