<?php
session_start();
include '../../model/m_koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // 1. Ambil nama peminjam dulu buat dicatat di log
    $data = mysqli_query($conn, "SELECT nama FROM peminjaman WHERE id_pinjam = '$id'");
    $row = mysqli_fetch_array($data);
    $nama_peminjam = $row['nama'];

    // 2. Hapus datanya
    $query = mysqli_query($conn, "DELETE FROM peminjaman WHERE id_pinjam = '$id'");
    
    if($query){
        // 3. TULIS KE LOG (PENTING!)
        $user_id = $_SESSION['id_user']; 
        $act = "Menghapus riwayat peminjaman: " . $nama_peminjam;
        mysqli_query($conn, "INSERT INTO log_aktivitas (id_user, aktivitas) VALUES ('$user_id', '$act')");

        echo "<script>alert('Berhasil dihapus!'); window.location='Datapeminjaman.php';</script>";
    }
}
?>
