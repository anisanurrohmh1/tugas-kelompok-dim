<?php
require 'database.php';
require 'controllers/BarangController.php';
require 'controllers/PenjualanController.php';

$barangController = new BarangController();
$penjualanController = new PenjualanController();

$page = isset($_GET['page']) ? $_GET['page'] : 'barang';

switch($page) {
    case 'barang':
        $barangList = $barangController->read();
        break;
    case 'penjualan':
        header('Location: page_penjualan.php');
        exit;
    default:
        echo "Halaman tidak ditemukan.";
        break;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Barang</title>
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
            background-image: url('barang.png'); /* Ganti dengan path gambar Anda */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                Our Website
            </div>
            <div class="nav-links">
                <a href="index.php?page=barang">Barang</a>
                <a href="page_penjualan.php">Penjualan</a>
                <a href="laporan.php">Laporan</a> 
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="half-page-image-container">
            <div class="half-page-image"></div>
        </div>
        <h1>Daftar Barang</h1><br><br>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($barangList as $barang): ?>
            <tr>
                <td><?php echo htmlspecialchars($barang['id']); ?></td>
                <td><?php echo htmlspecialchars($barang['nama']); ?></td>
                <td><?php echo number_format($barang['harga'], 2); ?></td>
                <td><?php echo htmlspecialchars($barang['stok']); ?></td>
                <td>
                    <a href="update_barang.php?id=<?php echo $barang['id']; ?>">Update</a>
                    <a href="delete_barang.php?id=<?php echo $barang['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>Tambah Barang</h2>
        <form action="create.php" method="POST">
            <label>Nama:</label>
            <input type="text" name="nama" required>
            <label>Harga Beli:</label>
            <input type="number" name="harga" required>
            <label>Stok:</label>
            <input type="number" name="stok" required>
            <input type="submit" value="Tambah">
        </form>
    </div>
</body>
</html>
