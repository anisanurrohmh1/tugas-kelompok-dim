<?php
class Penjualan {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($id_barang, $jumlah, $harga_jual, $tanggal) {
        $sql = "INSERT INTO penjualan (id_barang, jumlah, harga_jual, tanggal) VALUES (:id_barang, :jumlah, :harga_jual, :tanggal)";
        $this->db->query($sql, ['id_barang' => $id_barang, 'jumlah' => $jumlah, 'harga_jual' => $harga_jual, 'tanggal' => $tanggal]);
    }

    public function read($id = null) {
        if ($id) {
            $sql = "SELECT * FROM penjualan WHERE id = :id";
            return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT p.id, b.nama, p.jumlah, p.harga_jual, p.tanggal FROM penjualan p JOIN barang b ON p.id_barang = b.id";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($id, $id_barang, $jumlah, $harga_jual, $tanggal) {
        $sql = "UPDATE penjualan SET id_barang = :id_barang, jumlah = :jumlah, harga_jual = :harga_jual, tanggal = :tanggal WHERE id = :id";
        $this->db->query($sql, ['id' => $id, 'id_barang' => $id_barang, 'jumlah' => $jumlah, 'harga_jual' => $harga_jual, 'tanggal' => $tanggal]);
    }

    public function delete($id) {
        $sql = "DELETE FROM penjualan WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}
?>
