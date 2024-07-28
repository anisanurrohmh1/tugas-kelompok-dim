<?php
require_once 'Penjualan.php';

class PenjualanController {
    private $penjualan;

    public function __construct() {
        $database = new Database();
        $db = $database->koneksidatabase();
        $this->penjualan = new Penjualan($db);
    }

    public function read() {
        return $this->penjualan->read();
    }
}
?>
