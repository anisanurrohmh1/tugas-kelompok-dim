<?php
require 'database.php';
require 'barang.php';

$db = new Database();
$barang = new Barang($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barang->create($nama, $harga, $stok);
    header('Location: index.php');
}
?>
