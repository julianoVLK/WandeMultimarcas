<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Utils\View;
use \App\Common\Ambiente;
use \App\Common\Email;
use \App\Model\Entity\Avaliacao;
use \App\Db\Database;

Ambiente::load(__DIR__.'/../');

//DEFINE AS CONFIGURAÕES DE BANCO DE DADOS
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_PORT')
);

$vaga = Avaliacao::getAvaliacoes();

//DEFINE A CONSTANTE DA URL
define('URL', getenv('URL'));

//DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);