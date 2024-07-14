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
            background-color: #f4f4f4;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Laporan Rugi Laba</h1>
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
