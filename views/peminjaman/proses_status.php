<?php
session_start();
include '../../model/m_koneksi.php';

// Ambil data dari URL & Session
$id      = $_GET['id'];
$aksi    = $_GET['aksi'];
$id_user = $_SESSION['id_user']; // ID ini yang bakal masuk ke log

if ($aksi == 'setujui') {
    $query = mysqli_query($conn, "UPDATE peminjaman SET status = 'DIPINJAM' WHERE id_pinjam = '$id'");
    simpan_log($conn, $id_user, "Menyetujui peminjaman transaksi ID: $id");
    $pesan = "disetujui";

} elseif ($aksi == 'tolak') {
    $query = mysqli_query($conn, "UPDATE peminjaman SET status = 'DITOLAK' WHERE id_pinjam = '$id'");
    simpan_log($conn, $id_user, "Menolak peminjaman transaksi ID: $id");
    $pesan = "ditolak";

} elseif ($aksi == 'kembali') {
    $query = mysqli_query($conn, "UPDATE peminjaman SET status = 'KEMBALI' WHERE id_pinjam = '$id'");
    
    // Update Stok Alat
    $ambil_data = mysqli_query($conn, "SELECT id_alat FROM peminjaman WHERE id_pinjam = '$id'");
    $data = mysqli_fetch_array($ambil_data);
    $id_alat = $data['id_alat'];
    mysqli_query($conn, "UPDATE alat SET stok = stok + 1 WHERE id_alat = '$id_alat'");
    
    simpan_log($conn, $id_user, "Memproses pengembalian alat (ID Pinjam: $id)");
    $pesan = "dikembalikan";

} elseif ($aksi == 'hapus') {
    $query = mysqli_query($conn, "DELETE FROM peminjaman WHERE id_pinjam = '$id'");
    simpan_log($conn, $id_user, "Menghapus data transaksi ID: $id");
    $pesan = "dihapus";
}

if ($query) {
    header("location:Datapeminjaman.php?status=$pesan");
} else {
    echo "Gagal: " . mysqli_error($conn);
}
?>