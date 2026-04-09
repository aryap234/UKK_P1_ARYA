<?php 
session_start();
include '../../model/m_koneksi.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // 1. Ambil nama alat dulu buat dicatet di log
    $cek = mysqli_query($conn, "SELECT nama_alat FROM alat WHERE id_alat='$id'");
    $data = mysqli_fetch_array($cek);
    $nama_alat = $data['nama_alat'];

    // 2. Hapus alatnya
    $query = mysqli_query($conn, "DELETE FROM alat WHERE id_alat='$id'");

    if($query){
        // 3. --- OTOMATIS CATAT LOG ---
        $id_u = $_SESSION['id_user'];
        $ket  = "Menghapus alat: $nama_alat";
        mysqli_query($conn, "INSERT INTO log_aktivitas (id_user, aktivitas) VALUES ('$id_u', '$ket')");

        echo "<script>alert('Alat berhasil dihapus!'); window.location='index.php';</script>";
    }
}
?>
