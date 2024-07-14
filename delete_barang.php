<?php
require 'database.php';
require 'barang.php';

$db = new Database();
$barang = new Barang($db);

$id = $_GET['id'];
$barang->delete($id);

header('Location: index.php');
exit();
?>
