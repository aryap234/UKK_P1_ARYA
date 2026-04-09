<?php
require_once 'models/Peminjaman.php';

class PeminjamanController {
    public function index() {
        $pinjam = new Peminjaman();
        $dataPinjam = $pinjam->getAll();

        require_once 'views/peminjaman/index.php';
    }
}