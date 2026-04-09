<?php 
session_start();
include '../../model/m_koneksi.php';

// Cek apakah ada ID yang dikirim
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tgl_kembali = date('Y-m-d');

    // 1. Update status di tabel peminjaman
    // Pastikan nama kolomnya benar (id_pinjam)
    $query = mysqli_query($conn, "UPDATE peminjaman SET status='Kembali' WHERE id_pinjam='$id'");

    if($query){
        // Berhasil! Langsung balik ke tabel riwayat
        header("location:Datapeminjaman.php?pesan=kembali_sukses");
    } else {
        // Kalau gagal, kasih tau errornya biar gak blank
        echo "Gagal update: " . mysqli_error($conn);
    }
} else {
    // Kalau gak ada ID, tendang balik
    header("location:Datapeminjaman.php");
}
?>
