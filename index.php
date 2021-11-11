<?php

require __DIR__.'/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;
use \App\Common\Environment;

Environment::load(__DIR__);

$env = getenv();
echo'<pre>';print_r($env);
define('URL', 'http://localhost/wande');

//DEFINE O VALOR PADRÃO DAS VARIÁVEIS
View::init([
    'URL' => URL
]);

//INICIA O ROUTER
$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINAS
include __DIR__.'/routes/pages.php';

//IMPRIME A RESPOSTA DA ROTA
$obRouter->run()->sendResponse();