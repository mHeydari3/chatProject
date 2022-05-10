<?php

class DB
{
    protected $pdo;
    protected $table;
    protected $fetchMode = \PDO::FETCH_ASSOC;

    public function __construct()
    {
        $config = require __DIR__ . '/../config.php';
        try {
            $this->pdo = new \PDO("mysql:host=127.0.0.1:3307;dbname={$config['db']['database']}",$config['db']['username'] , $config['db']['password']);
            
        } catch (\Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function selectAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table}");
        $stmt->setFetchMode($this->fetchMode);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function selectQuery($sql){
        $stmt = $this->pdo->prepare($sql);
        $stmt->setFetchMode($this->fetchMode);
        $stmt->execute();
        return $stmt->fetchAll();

    }
    public function insertInto($sql){
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }
    public function executeQuery($sql){
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); // affected rows
    }
}