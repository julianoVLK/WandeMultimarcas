<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page {

    /**
     * Método responsável por renderizar o cabeçalho
     */
    private static function getHeader(){
        return View::render('pages/header');
    }


    /**
     * Método responsável por renderizar o rodapé
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Método responsável por renderizar o layout de paginação
     */
    public static function getPagination($request, $obPagination){
        $pages = $obPagination->getPages();
        
        //VERIFICA QUANTIDADE DE PÁGINAS
        if(count($pages) <= 1) return '';

        //LINKS
        $links = '';

        //URL ATUAL (SEM GET)
        $url = $request->getRouter()->getCurrentUrl();
        
        //GET
        $queryParams = $request->getQueryParams();

        //RENDERIZA LINKS
        foreach($pages as $page){
            //ALTERA A PÁGINA
            $queryParams['page'] = $page['pagina'];

            $link = $url.'?'.http_build_query($queryParams);

            //VIEW
            $links .= View::render('pages/pagination/link', [
                'page' => $page['pagina'],
                'link' => $link,
                'active' => $page['atual'] ? 'active' : ''
            ]);
        }

        //RENDERIZA BOX DE PAGINAÇÃO
        return View::render('pages/pagination/box', [
            'links' => $links
        ]);
    }

    /**
     * Método responsável por retornar o conteúdo (view) da página genérica
     */
	public static function getPage($title, $content) {
		return View::render('pages/page', [
			'title' => $title,
            'header' => self::getHeader(),
			'content' => $content,
            'footer' => self::getFooter()
		]);
	}
}