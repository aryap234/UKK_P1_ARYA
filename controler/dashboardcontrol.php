<?php
include_once 'models/Alat.php';
include_once 'models/Peminjaman.php';

class DashboardController {
    public function index() {
        $alat = new Alat();
        $peminjaman = new Peminjaman();

        $totalAlat = mysqli_num_rows($alat->getAll());
        $totalPinjam = mysqli_num_rows($peminjaman->getAll());

        include 'views/dashboard/index.php';
    }
}