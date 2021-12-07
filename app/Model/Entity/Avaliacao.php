<?php

namespace App\Model\Entity;

use \App\Db\Database;
use \PDO;

class Avaliacao{
    public $id;
    public $name = '';
    public $mensagem = '';
    public $data;

    public function cadastrar() {
        $this->data = date('Y-m-d H:i:s');

        $obDatabase = new Database('Avaliacao');

        $this->id = $obDatabase->insert([
            'nome'=>$this->nome,
            'mensagem'=>$this->mensagem,
            'data'=>$this->data
        ]);

        return true;
    }

    /**
     * Método responsável por retornar Avaliacões
     */
    public static function getAvaliacoes($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('avaliacao'))->select($where,$order,$limit,$fields)
                                          ->fetchAll(PDO::FETCH_CLASS,self::class);
    }
}