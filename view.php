<!DOCTYPE html>
<html>
<head>
    <title>Barang</title>
</head>
<body>
    <h1>Daftar Barang</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barangList as $barang): ?>
        <tr>
            <td><?php echo $barang['id']; ?></td>
            <td><?php echo $barang['nama']; ?></td>
            <td><?php echo $barang['harga']; ?></td>
            <td><?php echo $barang['stok']; ?></td>
            <td>
                <a href="update.php?id=<?php echo $barang['id']; ?>">Update</a>
                <a href="delete.php?id=<?php echo $barang['id']; ?>">Delete</a>
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
</body>
</html>
