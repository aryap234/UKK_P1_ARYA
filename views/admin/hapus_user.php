<?php
include '../../model/m_koneksi.php';

$id = $_GET['id'];

// Cek apakah ID-nya masuk ke sini
if(empty($id)) {
    die("Error: ID tidak ditemukan/kosong!");
}

$query = mysqli_query($conn, "DELETE FROM user WHERE id = '$id'");

if ($query) {
    if(mysqli_affected_rows($conn) > 0) {
        header("location:data_user.php?pesan=berhasil");
    } else {
        echo "Query jalan, tapi tidak ada data yang terhapus. Cek apakah ID $id benar ada di database?";
    }
} else {
    // Kalau error database, bakal muncul di sini
    echo "Gagal total: " . mysqli_error($conn);
}
?>