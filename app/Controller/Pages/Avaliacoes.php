<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Avaliacao;
use \App\Db\Pagination;

class Avaliacoes extends Page {

	/**
	* Método responsável por obter a renderização dos itens de avaliacoes da página
	*/
	private static function getAvaliacoesItems($request, &$obPagination){
		$itens = '';

		//QUANTIDADE DE REGISTROS PARA PÁGINAÇÃO
		$obQtdAvaliacoes = Avaliacao::getAvaliacoes(null, null, null, 'COUNT(*) as qtd');
		$quantidadeTotal = $obQtdAvaliacoes[0]->qtd;

		//PÁGINA ATUAL
		$queryParams = $request->getQueryParams();
		$paginaAtual = $queryParams['page'] ?? 1;

		//INSTANCIA DE PAGINAÇÃO
		$obPagination = new Pagination($quantidadeTotal,$paginaAtual,5);

		//RESULTADOS DA PÁGINA
		$results = Avaliacao::getAvaliacoes(null, 'id DESC', $obPagination->getLimit());
		
		foreach($results as $result){
			$itens .= View::render('pages/avaliacoes/item', [
				'nome' => $result->nome,
				'mensagem' => $result->mensagem,
				'data' => date('d/m/Y H:i:s', strtotime($result->data))
			]);
		}

		return $itens;
	}

	/*Método responsável por retornar o conteúdo (view) de avaliações
	@return string	
	*/

	public static function getAvaliacoes($request) {

		$content = View::render('pages/avaliacoes', [
			'itens' => self::getAvaliacoesItems($request, $obPagination),
			'pagination' => parent::getPagination($request, $obPagination)
		]);

		return parent::getPage('Avalições - Wande Multimarcas', $content);
	}

	/**
	 * Método responsável por cadastrar uma avaliação
	 */
	public static function insertAvaliacao($request){

		$postVars = $request->getPostVars();
		$obAvaliacao = new Avaliacao;
		$obAvaliacao->nome = $postVars['nome'];
		$obAvaliacao->mensagem = $postVars['msg'];
		$obAvaliacao->cadastrar();

		return self::getAvaliacoes($request);
	}
}