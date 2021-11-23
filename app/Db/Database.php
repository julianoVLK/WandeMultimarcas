<?php

namespace App\Db;

use \PDO;
use \PDOExcpetion;

class Database {

    const HOST = 'localhost';
    const NAME = 'wande';
    const USER = 'root';
    const PASS = '';
    const PORT = '3312';

    private $table;
    private $connection;

    /**
     * Instância a conexão e define a tabela
     */
    public function __construct($table = NULL){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';port='.self::PORT.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Método responsável por executar as queries dentro do banco de dados
     */
    public function execute($query, $params = []) {
        try {
           $statment = $this->connection->prepare($query);
           $statment->execute($params);
           return $statment;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * Método responsável por inserir dados no banco
     */
    public function insert($values){
        //DADOS DA QUERY
        $fields = array_keys($values);
        $binds = array_pad([],count($fields),'?');

        //MONTA A QUERY
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        //EXECUTA A QUERY
        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }
}