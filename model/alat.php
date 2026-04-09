<?php
include_once 'config/koneksi.php';

class Alat {
    public function getAll() {
        global $koneksi;
        return mysqli_query($koneksi, "SELECT * FROM alat");
    }
}