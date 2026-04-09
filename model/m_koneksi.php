<?php
// Pastikan session aktif agar id_user terbaca
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = "127.0.0.1";
$user = "root";
$pass = "root"; 
$db   = "peminjaman_alat";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// FUNGSI LOG OTOMATIS (SESUAI STRUKTUR FOTO KAMU)
if (!function_exists('simpan_log')) {
    function simpan_log($conn, $id_user, $pesan) {
        if (!$conn) return false;
        
        // Bersihkan data
        $u_id = !empty($id_user) ? intval($id_user) : 0;
        $p_safe = mysqli_real_escape_string($conn, $pesan);
        
        // Kolom di database kamu: id_user & aktivitas
        $sql = "INSERT INTO log_aktivitas (id_user, aktivitas) VALUES ($u_id, '$p_safe')";
        
        return mysqli_query($conn, $sql);
    }
}
?>