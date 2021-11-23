<?php

namespace App\Model\Entity;

use \App\Db\Database;

class Avaliacao{
    public $id;
    public $name = 'Teste';
    public $mensagem = 'Teste MSG';
    public $data;

    public function cadastrar() {
        $this->data = date('Y-m-d H:i:s');

        $obDatabase = new Database('Avaliacao');

        $this->id = $obDatabase->insert([
            'nome'=>$this->name,
            'mensagem'=>$this->mensagem,
            'data'=>$this->data,
        ]);

        return true;
    }
}