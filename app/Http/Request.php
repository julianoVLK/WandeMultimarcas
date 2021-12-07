<?php

namespace App\Http;

class Request {

    private $httpMethod;
    private $uri;
    private $queryParams = [];
    private $postVars = [];
    private $headers = [];
    private $router;

    public function __construct($router) {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();
    }

    /**
     * Método responsável por definir a URI
     */
    private function setUri(){
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';

        //REMOVE OS GETS DA URI
        $xUri = explode('?', $this->uri);
        $this->uri = $xUri[0];
    }

    /**
     * Método responsável por retornar a instancia de Router
     */
    public function getRouter(){
        return $this->router;
    }

    public function getHttpMethod() {
        return $this->httpMethod;
    }

    public function getUri() {
        return $this->uri;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function getQueryParams() {
        return $this->queryParams;
    }

    public function getPostVars() {
        return $this->postVars;
    }
}