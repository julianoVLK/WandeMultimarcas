<?php

namespace App\Db;

class Pagination{

    private $limit;
    private $results;
    private $pages;
    private $currentPage;

    public function __construct($results, $currentPage = 1, $limit = 10){
        $this->results = $results;
        $this->limit = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }

    /**
     * Método responsável por calcular a paginação
     */
    private function calculate(){
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    /**
     * Método responsável por retornar a cláusula da sql
     */
    public function getLimit(){
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Método responsável por retornar as opções de páginas disponíveis
     */
    public function getPages(){

        if($this->pages == 1) return [];

        $paginas = [];
        for($i = 1; $i <= $this->pages; $i++){
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPage
            ];
        }

        return $paginas;
    }
}

?>