<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Avaliacoes extends Page {

	/*Método responsável por retornar o conteúdo (view) de avaliações
	@return string	
	*/

	public static function getAvaliacoes() {

		$content = View::render('pages/avaliacoes', [
			
		]);

		return parent::getPage('Avalições - Wande Multimarcas', $content);
	}
}