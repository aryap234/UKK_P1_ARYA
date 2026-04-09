<?php 
include '../../model/m_koneksi.php';

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Log Aktivitas</title>
    <style>
        body { font-family: 'Arial', sans-serif; padding: 40px; color: #111; line-height: 1.6; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #000; padding-bottom: 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 12px; text-align: left; font-size: 13px; }
        th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; }
        .footer { margin-top: 30px; text-align: right; font-size: 11px; font-style: italic; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h1 style="margin: 0; font-size: 22px;">LAPORAN LOG AKTIVITAS PEMINJAMAN ALAT</h1>
        <p style="margin: 5px 0;">Sistem Inventaris Peminjaman Alat</p>
    </div>



    <table>
        <thead>
            <tr>
                <th width="5%" style="text-align: center;">No</th>
                <th width="20%">Nama Pengguna</th>
                <th width="50%">Aktivitas / Kegiatan</th>
                <th width="25%">Waktu Kejadian</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            // QUERY JOIN SAKTI: Ambil nama dari tabel user berdasarkan id_user di log
            $query = "SELECT log_aktivitas.*, user.username 
                      FROM log_aktivitas 
                      JOIN user ON log_aktivitas.id_user = user.id 
                      ORDER BY log_aktivitas.waktu DESC";
            
            $s = mysqli_query($conn, $query);

            // Cek apakah ada data
            if (mysqli_num_rows($s) > 0) {
                while($d = mysqli_fetch_array($s)){ 
                    // Ambil nama dari join, kalau gagal (unknown) tampilkan ID-nya saja
                    $nama = !empty($d['username']) ? $d['username'] : "User ID: " . $d['id_user'];
                    $aksi = $d['aktivitas'];
                    $jam  = date('d/m/Y H:i', strtotime($d['waktu']));
            ?>
            <tr>
                <td align="center"><?= $no++; ?></td>
                <td><strong><?= htmlspecialchars($nama); ?></strong></td>
                <td><?= htmlspecialchars($aksi); ?></td>
                <td><?= $jam; ?></td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='4' align='center'>Tidak ada data aktivitas ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak secara resmi melalui sistem pada <?= date('d/m/Y'); ?>.
    </div>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Print Lagi</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup Halaman</button>
    </div>

</body>
</html>