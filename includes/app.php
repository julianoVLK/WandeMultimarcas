<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Common\Ambiente;
use \App\Common\Email;
use \App\Model\Entity\Avaliacao;

$obAvaliacao = new Avaliacao;

$obAvaliacao->cadastrar();

Ambiente::load(__DIR__.'/../');

//DEFINE AS CONFIGURAÕES DE BANCO DE DADOS

//DEFINE A CONSTANTE DA URL
define('URL', getenv('URL'));

//DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);