<?php
include '../../model/m_koneksi.php';

$id    = $_POST['id'];
$nama  = $_POST['nama'];
$role  = $_POST['role'];

// Query update pakai 'id'
$q = mysqli_query($conn, "UPDATE user SET nama='$nama', role='$role' WHERE id='$id'");

if($q){
    echo "<script>alert('Data Berhasil Diubah!'); window.location='data_user.php';</script>";
} else {
    echo "Gagal Edit! Error: " . mysqli_error($conn);
}
?>
