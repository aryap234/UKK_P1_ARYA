<?php
session_start();
include '../../model/m_koneksi.php';

$username = $_POST['username'];
$password = $_POST['password']; // Kalau mau aman pake password_hash
$role     = $_POST['role'];

// 1. Simpan User Baru
$query = mysqli_query($conn, "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')");

if($query){
    // 2. CATAT KE LOG AKTIVITAS
    $id_pelaku = $_SESSION['id_user']; 
    $pesan_log = "Menambahkan user baru: " . $username . " sebagai " . $role;
    
    mysqli_query($conn, "INSERT INTO log_aktivitas (id_user, aktivitas) VALUES ('$id_pelaku', '$pesan_log')");

    echo "<script>alert('User Berhasil Ditambahkan!'); window.location='data_user.php';</script>";
} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>
