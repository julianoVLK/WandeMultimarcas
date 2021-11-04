<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

/*Método responsável por retornar o conteúdo (view)
 @return string	
*/

class Home extends Page {

	public static function getHome() {

		$obOrganization = new Organization;
		//View da Home
		$content = View::render('pages/home', [
			'name' => $obOrganization->name
		]);

		return parent::getPage('Wande Multimarcas', $content);
	}
}