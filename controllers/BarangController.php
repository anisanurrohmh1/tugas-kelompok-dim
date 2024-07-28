<?php
require_once 'Barang.php';

class BarangController {
    private $barang;

    public function __construct() {
        $database = new Database();
        $db = $database->koneksidatabase();
        $this->barang = new Barang($db);
    }

    public function read() {
        return $this->barang->read();
    }
}
?>
