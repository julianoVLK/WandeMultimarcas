<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

/*Método responsável por retornar o conteúdo (view)
 @return string	
*/

class Sobre extends Page {

	public static function getSobre() {

		$obOrganization = new Organization;
		//View da Home
		$content = View::render('pages/home', [
			'name' => $obOrganization->name
		]);

		return parent::getPage('Sobre - Wande Multimarcas', $content);
	}
}