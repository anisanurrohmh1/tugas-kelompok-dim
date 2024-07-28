<?php
require 'database.php';
require 'barang.php';
require 'penjualan.php';

$db = new Database();
$barang = new Barang($db);
$penjualan = new Penjualan($db);

$barangList = $barang->read();
$penjualanList = $penjualan->read();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang dan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: orange;
            padding: 10px 20px;
            color: #fff;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
        }
        .navbar a:hover {
            background-color: #575757;
            border-radius: 4px;
        }
        .navbar .logo {
            font-size: 1.5em;
            font-weight: bold;
        }
        .navbar .nav-links {
            display: flex;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        form input[type="text"], form input[type="number"], form input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .half-page-image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh; /* Setengah tinggi halaman */
        }
        .half-page-image {
            width: 50vw; /* Setengah lebar halaman */
            height: 100%;
            background-image: url('penjualan.jpg'); 
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                MyWebsite
            </div>
            <div class="nav-links">
                <a href="index.php">Barang</a>
                <a href="page_penjualan.php">Penjualan</a>
                <a href="laporan.php">Laporan</a> 
            </div>
        </nav>
    </header>
    <div class="container">
    <div class="half-page-image-container">
            <div class="half-page-image"></div>
        </div>
        <h1>Daftar Penjualan</h1><br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>ID Barang</th>
                <th>Jumlah</th>
                <th>Harga Jual</th>
                <th>Tanggal</th>
 
            </tr>
            <?php foreach ($penjualanList as $penjualan): ?>
            <tr>
                <td><?php echo htmlspecialchars($penjualan['id']); ?></td>
                <td><?php echo htmlspecialchars($penjualan['id_barang'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($penjualan['jumlah'] ?? ''); ?></td>
                <td><?php echo number_format($penjualan['harga_jual'], 2); ?></td>
                <td><?php echo htmlspecialchars($penjualan['tanggal'] ?? ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>


        <br><br><br><h2>Form Tambah Penjualan</h2>
        <form action="create_penjualan.php" method="POST">
            <label>ID Barang:</label>
            <input type="number" name="id_barang" required>
            <label>Jumlah:</label>
            <input type="number" name="jumlah" required>
            <label>Harga Jual:</label>
            <input type="number" name="harga_jual" required>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required>
            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
