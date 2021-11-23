<?php

namespace App\Common;

/**
 * Método responsável por carregar as variáveis de ambiente do projeto
 * @param string $dir Caminho absoluto da pasta onde econtra-se o arquivo .env
 */
class Ambiente {
    public static function load($dir) {
        if(!file_exists($dir.'/.env')) {
            return false;
        }

        $lines = file($dir.'/.env');
        foreach($lines as $line){
            putenv(trim($line));
        }
    }
}