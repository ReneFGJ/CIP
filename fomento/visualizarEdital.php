<?php
require "cab_fomento.php";
renderiza_cabecalho_autentica();

require "../_class/_class_fomento.php";
$essaPagina = pathinfo_filename(__FILE__).'.php';
$fom_view = new fomento_view($essaPagina, $nw);

$acaoPagina = $fom_view->acaoPagina;

$indIdEdital = 0;
$indIdProfessor = 1;
list($idEditalUnsafe, $idProfessorUnsafe) = array($dd[$indIdEdital], $dd[$indIdProfessor]);

if($acaoPagina !== 'verEditalInterno'){
	die("");
}

//Redireciona para editor se logado e se o edital ainda não tenha sido enviado
if(!$fom_view->edital_foi_enviado($idEditalUnsafe)){
	$fom_view->redireciona('editorEdital.php', 'editarNovo', intval($idEditalUnsafe));
}

$html_edital = $fom_view->html_visualizacao_edital($idEditalUnsafe);

$html_informacoes = '';

if(!$fom_view->usuario_autorizado()){ die("ERRO: Usuário sem permissão para visualizar essa página."); }

$url_novo_a_partir_deste = $fom_view->constroi_url('editorEdital.php', 'novoBaseadoEmAnterior', intval($idEditalUnsafe));

$botoes = array(
	array($url_novo_a_partir_deste, 'Criar novo edital a partir deste'),
);
$html_edital_visualizacao = $fom_view->html_cria_iframe_visualizador($html_edital, 'frameEdital', $botoes);

$html_informacoes = $fom_view->html_metadados_edital($idEditalUnsafe);

/**
 * Início da renderização do conteúdo *
 */

echo "
	<h1> Edital enviado </h1>
	<i><a href=\"#info\">Pular para</a> visualizações do edital e outras informações.</i>

	<table width=\"100%\"> 
		<tr align=\"center\"><td>
			$html_edital_visualizacao
		</td></tr>
	</table>

	<a name=\"info\">
	$html_informacoes


";

require("../foot.php");
?>