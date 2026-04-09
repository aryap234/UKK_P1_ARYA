<?php 
session_start();
include '../../model/m_koneksi.php';

// 1. Cek apakah data dikirim (biar gak Notice Undefined Index)
if (isset($_POST['username']) && isset($_POST['password'])) {

    // 2. Ambil input dan bersihkan (Security)
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // 3. Cek user di database
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $cek   = mysqli_num_rows($query);

    if($cek > 0){
        $data = mysqli_fetch_assoc($query);
        
        // 4. Simpan Session
        $_SESSION['id_user']  = $data['id_user']; // Pastikan nama kolom di DB 'id_user'
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = strtolower(trim($data['role'])); 
        
        header("location: ../admin/index.php"); 
        exit();
    } else {
        // Gagal login (username/password salah)
        header("location: login.php?pesan=gagal");
        exit();
    }

} else {
    // Kalau akses file ini tanpa mencet tombol login
    header("location: login.php");
    exit();
}
?>