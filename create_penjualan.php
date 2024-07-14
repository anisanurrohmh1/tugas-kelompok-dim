<?php
require 'database.php';
require 'penjualan.php';

$db = new Database();
$penjualan = new Penjualan($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $harga_jual = $_POST['harga_jual'];
    $tanggal = $_POST['tanggal'];
    $penjualan->create($id_barang, $jumlah, $harga_jual, $tanggal);
    header('Location: index.php');
    exit();
}
?>
