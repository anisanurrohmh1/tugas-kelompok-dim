<?php
require 'database.php';
require 'barang.php';

$db = new Database();
$barang = new Barang($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $barang->update($id, $nama, $harga, $stok);
    header('Location: index.php');
    exit();
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $barangData = $barang->read($id);
        if (!$barangData) {
            echo "Data tidak ditemukan.";
            exit();
        }
    } else {
        echo "ID tidak diberikan.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
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
        form input[type="text"], form input[type="number"] {
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
        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Barang</h1>
        <form action="update_barang.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($barangData['id']); ?>">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($barangData['nama']); ?>" required>
            <label>Harga:</label>
            <input type="number" name="harga" value="<?php echo htmlspecialchars($barangData['harga']); ?>" required>
            <label>Stok:</label>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($barangData['stok']); ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
