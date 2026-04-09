<?php 
include '../../model/m_koneksi.php';

// 1. Ambil ID dari URL (Contoh: ?id=5)
$id_url = isset($_GET['id']) ? $_GET['id'] : '';

// 2. PROSES SIMPAN (Jika tombol diklik)
if (isset($_POST['btn_gas'])) {
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $id_alat = $_POST['id_alat_form']; // ID yang dikirim dari input hidden
    $jumlah  = $_POST['jumlah'];
    $tgl     = $_POST['tgl'];

    // Validasi: Jika ID kosong, jangan lanjut ke SQL
    if (empty($id_alat)) {
        echo "<script>alert('ERROR: ID Alat tidak terbaca! Pastikan klik dari halaman stok.'); window.location='../alat/index.php';</script>";
        exit();
    }

    $sql = "INSERT INTO peminjaman (nama, id_alat, jumlah, tgl_pinjam, status) 
            VALUES ('$nama', '$id_alat', '$jumlah', '$tgl', 'Dipinjam')";

    if (mysqli_query($conn, $sql)) {
        // Kurangi stok alat
        mysqli_query($conn, "UPDATE alat SET stok = stok - $jumlah WHERE id_alat = '$id_alat'");
        echo "<script>alert('BERHASIL PINJAM!'); window.location='Datapeminjaman.php';</script>";
    } else {
        echo "Gagal Simpan: " . mysqli_error($conn);
    }
    exit();
}

// 3. Ambil data alat untuk ditampilkan di label
$query_alat = mysqli_query($conn, "SELECT * FROM alat WHERE id_alat = '$id_url'");
$alat = mysqli_fetch_array($query_alat);
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-3">
    <div class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
        <h4 class="fw-bold">Form Pinjam</h4>
        <hr>
        
        <form action="" method="POST">
            <input type="hidden" name="id_alat_form" value="<?= $id_url; ?>">

            <div class="mb-3">
                <label>Alat yang dipilih:</label>
                <input type="text" class="form-control bg-light" value="<?= $alat['nama_alat'] ?? 'ID ALAT TIDAK ADA'; ?>" readonly>
            </div>

            <div class="mb-3">
                <label>Nama Peminjam</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jumlah (Stok: <?= $alat['stok'] ?? 0; ?>)</label>
                <input type="number" name="jumlah" class="form-control" min="1" max="<?= $alat['stok']; ?>" required>
            </div>

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date" name="tgl" class="form-control" value="<?= date('Y-m-d'); ?>">
            </div>

            <button type="submit" name="btn_gas" class="btn btn-dark w-100 py-2">KONFIRMASI SEKARANG</button>
        </form>
    </div>
</body>
</html>