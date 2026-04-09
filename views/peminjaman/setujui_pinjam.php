<?php
session_start();
include '../../model/m_koneksi.php';

// Pastikan yang akses cuma Admin atau Petugas
if(!isset($_SESSION['role']) || strtolower($_SESSION['role']) == 'peminjam'){
    echo "<script>alert('Anda tidak punya akses!'); window.location='Datapeminjaman.php';</script>";
    exit();
}

// Ambil ID dari URL (Pastikan ini sesuai dengan link di Datapeminjaman.php)
if(isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    header("location:Datapeminjaman.php");
    exit();
}

// 1. Ambil data peminjaman
$query_peminjaman = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_pinjam = '$id'");
$data = mysqli_fetch_assoc($query_peminjaman);

if ($data) {
    $id_alat = $data['id_alat'];
    // Pastikan nama kolom di DB kamu emang 'jumlah', kalau 'qty' ganti jadi $data['qty']
    $jumlah  = $data['jumlah']; 

    // 2. Cek stok terakhir di tabel alat
    $cek_stok = mysqli_query($conn, "SELECT stok FROM alat WHERE id_alat = '$id_alat'");
    $row_stok = mysqli_fetch_assoc($cek_stok);
    $stok_sekarang = $row_stok['stok'];

    if ($stok_sekarang >= $jumlah) {
        // 3. Update status peminjaman jadi DIPINJAM secara resmi
        $update_status = mysqli_query($conn, "UPDATE peminjaman SET status = 'DIPINJAM' WHERE id_pinjam = '$id'");

        // 4. POTONG STOK ALAT
        $update_stok = mysqli_query($conn, "UPDATE alat SET stok = stok - $jumlah WHERE id_alat = '$id_alat'");

        if($update_status && $update_stok){
            echo "<script>alert('Peminjaman disetujui & Stok dipotong!'); window.location='Datapeminjaman.php';</script>";
        } else {
            echo "<script>alert('Gagal update database!'); window.location='Datapeminjaman.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal! Stok alat (Hanya sisa $stok_sekarang) tidak mencukupi untuk meminjam $jumlah.'); window.location='Datapeminjaman.php';</script>";
    }
} else {
    echo "<script>alert('Data peminjaman tidak ditemukan!'); window.location='Datapeminjaman.php';</script>";
}
?>
