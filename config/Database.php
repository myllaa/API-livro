<?php

class Database {
    // Parametros
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $connection;

    // Conexão
    public function connect() {
        $this->connection = null;

        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
