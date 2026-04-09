<?php
require_once 'models/Alat.php';

class AlatController {
    public function index() {
        $alat = new Alat();
        $dataAlat = $alat->getAll();

        require_once 'views/alat/index.php';
    }
}