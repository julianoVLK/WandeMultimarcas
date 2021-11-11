<?php

namespace App\Utils;

class View {

    private static $vars = [];

    /**
     * Método responsável por definir os dados inicias da classe
     * @param array $vars
     */
    public static function init ($vars = []){
        self::$vars = $vars;
    }
    /**
     * Método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string
     */
    private static function getContentView($view) {
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retorar o conteúdo renderizado de uma view
     * @param string $view
     * @param array $vars
     * @return string
     */
    public static function render ($view, $vars = []) {
        $contentView = self::getContentView($view);

        //Merge de variáveis da view
        $vars = array_merge(self::$vars,$vars);
        //Chave dos array de variáveis
        $keys = array_keys($vars);
        $keys = array_map(function($item) {
            return '{{'.$item.'}}';
        },$keys);

        return str_replace($keys, array_values($vars), $contentView);
    }
}