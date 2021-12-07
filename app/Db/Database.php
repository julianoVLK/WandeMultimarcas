<?php

namespace App\Db;

use \PDO;
use \PDOExcpetion;

class Database {

    static $host = '';
    static $name = '';
    static $user = '';
    static $pass = '';
    static $port = '';

    private $table;
    private $connection;

    /**
     * Instância a conexão e define a tabela
     */
    public function __construct($table = NULL){
        $this->table = $table;
        $this->setConnection();
    }

    public static function config($dbHost, $dbName, $dbUser, $dbPass, $dbPort){
        self::$host = $dbHost;
        self::$name = $dbName;
        self::$user = $dbUser;
        self::$pass = $dbPass;
        self::$port = $dbPort;
    }

    /**
     * Método responsável por criar uma conexão com o banco de dados
     */
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::$host.';port='.self::$port.';dbname='.self::$name,self::$user,self::$pass);
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

    /**
     * Método responsável por executar uma consulta no banco
     */
    public function select($where = null, $order = null, $limit =  null, $fields = '*'){
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : ''; 

        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        return $this->execute($query);
    }

    /**
     * Método responsável por executar atualizações no banco de dados
     */

     public function update($where, $values){
        $fields = array_keys($values);
        $query = 'UPDATE '.$this->table.' SET '.implode('=?,',$fields).'=? WHERE '.$where;

        $this->execute($query, array_values($values));

        return true;
     }

    /**
     * Método responsável por excluir registros do banco de dados
     */
    public function delete($where){
        $query = 'DELTE FROM '.$this->table.' WHERE '.$where;

        $this->execute($query);

        return true;
    }
}