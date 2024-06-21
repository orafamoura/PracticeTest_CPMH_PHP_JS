<?php

//Criando minha conexao com o banco
class DatabaseConnection {

    private $username = "root";
    private $password = "123456";
    private $connection;

    public function __construct(){
        $dsn = "mysql:host=localhost;dbname=teste_vita_med_tech;charset=utf8mb4";

        try {
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        die("Conexao falhou". $e->getMessage());
        }
    }

    public function getConnection(){
        return $this->connection;
    }
}
?>