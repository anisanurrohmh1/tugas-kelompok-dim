<?php

class Barang {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($nama, $harga, $stok) {
        $sql = "INSERT INTO barang (nama, harga, stok) VALUES (:nama, :harga, :stok)";
        $this->db->query($sql, ['nama' => $nama, 'harga' => $harga, 'stok' => $stok]);
    }
 
    public function read($id = null) {
        if ($id) {
            $sql = "SELECT * FROM barang WHERE id = :id";
            return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT * FROM barang";
            return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function update($id, $nama, $harga, $stok) {
        $sql = "UPDATE barang SET nama = :nama, harga = :harga, stok = :stok WHERE id = :id";
        $this->db->query($sql, ['id' => $id, 'nama' => $nama, 'harga' => $harga, 'stok' => $stok]);
    }

 
    public function delete($id) {
        $sql = "DELETE FROM pembelian WHERE id_barang = :id";
        $this->db->query($sql, ['id' => $id]);

        $sql = "DELETE FROM penjualan WHERE id_barang = :id";
        $this->db->query($sql, ['id' => $id]);

        $sql = "DELETE FROM barang WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
    }
}
?>
