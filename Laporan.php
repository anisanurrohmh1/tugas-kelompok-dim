<?php
require 'database.php';

$db = new Database();

$sql = "
SELECT 
    b.nama, 
    (b.harga * b.stok) AS nilai_barang, 
    IFNULL(SUM(p.harga_jual * p.jumlah), 0) - IFNULL(SUM(pb.harga_beli * pb.jumlah), 0) AS laba 
FROM 
    barang b
LEFT JOIN 
    penjualan p ON b.id = p.id_barang
LEFT JOIN 
    pembelian pb ON b.id = pb.id_barang
GROUP BY 
    b.id, b.nama
";
$laporan = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rugi Laba</title>
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
        h1 {
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
            background-color: bisque;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
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
            background-image: url('laporan.png'); 
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
        <h1>Laporan Rugi Laba</h1><br><br>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Nilai Barang (Rp)</th>
                <th>Laba (Rp)</th>
            </tr>
            <?php foreach ($laporan as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo number_format($row['nilai_barang'], 2); ?></td>
                <td><?php echo number_format($row['laba'], 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
