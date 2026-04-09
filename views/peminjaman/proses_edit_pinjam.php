<?php
include '../../model/m_koneksi.php';

$id = $_POST['id_pinjam']; // Sesuaikan dengan nama input di form
$status_baru = $_POST['status']; // Ini harus dapet "DIKEMBALIKAN" dari <select>

// QUERY UPDATE
$query = mysqli_query($conn, "UPDATE peminjaman SET status = '$status_baru' WHERE id_pinjam = '$id'");

if($query) {
    echo "<script>alert('Data Berhasil Diperbarui!'); window.location='Datapeminjaman.php';</script>";
} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>