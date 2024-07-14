<?php
class Database {
    private $server = "127.0.0.1";
    private $username = "root";
    private $password = "Rahasia";
    private $database = "tugas_db";
    private $dbh;

    function __construct() {
        $this->dbh = $this->koneksidatabase();
    }

    function koneksidatabase() {
        try {
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
            return $dbh;
        } catch (PDOException $e) {
            print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function query($sql, $params = []) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
