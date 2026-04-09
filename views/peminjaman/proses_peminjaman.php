<?php
include '../../model/m_koneksi.php';

// Pastikan nama di dalam ['...'] ini SAMA PERSIS dengan name=".." di form kamu
$nama       = $_POST['nama']; // Kalau di form name="nama", pake ini.
$id_alat    = $_POST['id_alat'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$jumlah     = $_POST['jumlah']; // Tambahkan ini karena di tabel ada kolom jumlah
$status     = "Dipinjam"; 

// Query INSERT disesuaikan dengan struktur tabel di gambar kamu
$query = "INSERT INTO peminjaman (nama, id_alat, jumlah, tgl_pinjam, status) 
          VALUES ('$nama', '$id_alat', '$jumlah', '$tgl_pinjam', '$status')";

if(mysqli_query($conn, $query)){
    // Update stok alat dikurangi sesuai jumlah yang dipinjam
    mysqli_query($conn, "UPDATE alat SET stok = stok - $jumlah WHERE id_alat = '$id_alat'");
    
    echo "<script>alert('Berhasil Pinjam!'); window.location='Datapeminjaman.php';</script>";
} else {
    // Menampilkan error yang lebih jelas kalau gagal
    echo "Gagal: " . mysqli_error($conn);
}
?>