php
<?php

class Database {
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            // Em um ambiente de produção, você deve logar o erro em vez de exibi-lo
            error_log("Erro de conexão com o banco de dados: " . $exception->getMessage());
            die("Erro de conexão com o banco de dados.");
        }

        return $this->conn;
    }
}

?>