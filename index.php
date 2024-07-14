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
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Barang</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
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
            <label>Harga:</label>
            <input type="number" name="harga" required>
            <label>Stok:</label>
            <input type="number" name="stok" required>
            <input type="submit" value="Tambah">
        </form>

        <h1>Daftar Penjualan</h1>
        <table>
            <tr>
                <th>ID</th>
                <!-- <th>ID Barang</th> -->
                <th>Jumlah</th>
                <th>Harga Jual</th>
                <th>Tanggal</th>
                <!-- <th>Aksi</th> -->
            </tr>
            <?php foreach ($penjualanList as $penjualan): ?>
            <tr>
                <td><?php echo htmlspecialchars($penjualan['id']); ?></td>
                <!-- <td><?php echo htmlspecialchars($penjualan['id_barang'] ?? ''); ?></td> -->
                <td><?php echo htmlspecialchars($penjualan['jumlah'] ?? ''); ?></td>
                <td><?php echo number_format($penjualan['harga_jual'], 2); ?></td>
                <td><?php echo htmlspecialchars($penjualan['tanggal'] ?? ''); ?></td>
                <!-- <td>
                    <a href="update_penjualan.php?id=<?php echo $penjualan['id']; ?>">Update</a>
                    <a href="delete_penjualan.php?id=<?php echo $penjualan['id']; ?>">Delete</a>
                </td> -->
            </tr>
            <?php endforeach; ?>
        </table>


        <h2>Tambah Penjualan</h2>
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
