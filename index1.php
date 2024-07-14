<?php
class database
{
    private $server ="127.0.0.1";  // Ganti 'localhost' dengan '127.0.0.1'
    private $username = "root";
    private $password = "Rahasia";
    private $database = "finance_db";

    function koneksidatabase()
    {
        try {
            // Buat koneksi dengan database
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
            ];

            $dbh = new PDO(
                'mysql:host=' . $this->server . ';dbname=' . $this->database,
                $this->username,
                $this->password,
                $options
            );

            echo "konek!";
            return $dbh;
        } catch (PDOException $e) {
            // Tampilkan pesan kesalahan jika koneksi gagal
            print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

$d1 = new database();
$database = $d1->koneksidatabase();
?>
