<?php
require "cab_fomento.php";
require "../_class/_class_fomento.php";
// Cabeçalho externo
renderiza_cabecalho_autentica('externo');

$essaPagina = pathinfo_filename(__FILE__).'.php';
$fom_view = new fomento_view($essaPagina, $nw);

$acaoPagina = $fom_view->acaoPagina;

$indIdEdital = 0;
$indIdProfessor = 1;
list($idEditalUnsafe, $idProfessorUnsafe) = array($dd[$indIdEdital], $dd[$indIdProfessor]);



if(!$fom_view->edital_foi_enviado($idEditalUnsafe)){
	die("ERRO: O edital é inválido.");
}
if(is_numeric($idEditalUnsafe) && is_numeric($idProfessorUnsafe)){
	$fom_view->edital_registrar_visualizacao($idEditalUnsafe, $idProfessorUnsafe);
}

if($acaoPagina === 'redireciona'){
	$fom_view->redireciona_url_externa($idEditalUnsafe);
}

$html_edital = $fom_view->html_visualizacao_edital($idEditalUnsafe);

$html_informacoes = '';

$html_edital_visualizacao = $html_edital;

/**
 * Início da renderização do conteúdo *
 */

echo "
	<table width=\"100%\"> 
		<tr align=\"center\"><td>
			<img src=\"http://www2.pucpr.br/reol/mailing/cip/cab.png\" width=\"640\" height=\"149\" alt=\"CIP: Centro Integrado de Pesquisa: Diretoria de Pesquisa. PUCPR, Grupo Marista\">
        </td></tr>
    </table>
	<div style='width:".$fom_view->larguraEditalPx."px; margin:0px auto;'>
		$html_edital_visualizacao
	</div>

	$html_informacoes
";

echo "<br><br>";
require("../foot.php");
?>