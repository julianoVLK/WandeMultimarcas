<?php

use \App\Http\Response;
use \App\Controller\Pages;

//ROTA HOME
$obRouter->get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

//ROTA CONTATO
$obRouter->get('/sobre', [
    function(){
        return new Response(200, Pages\Sobre::getSobre());
    }
]);

//ROTA AVALIAÇÃO
$obRouter->get('/avaliacoes', [
    function($request){
        return new Response(200, Pages\Avaliacoes::getAvaliacoes($request));
    }
]);

//ROTA AVALIAÇÃO (INSERT)
$obRouter->post('/avaliacoes', [
    function($request){
        return new Response(200, Pages\Avaliacoes::insertAvaliacao($request));
    }
]);

//ROTA DINÂMICA
$obRouter->get('/pagina/{idPagina}/{acao}', [
    function($idPagina, $acao){
        return new Response(200,'Página '.$idPagina.' - '.$acao);
    }
]);