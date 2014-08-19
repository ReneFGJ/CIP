<?
require("cab.php");

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_data.php');

require('../_class/_class_grupo_de_pesquisa.php');
$clx = new grupo_de_pesquisa;

echo '<h1>Grupos de Pesquisa</h1>';
echo $clx->grupos_validados_por_area();

$link = ' onclick="location.href=\'gp_cadastro.php\'" ';
echo '<input name="button" value=" novo grupo >>" '.$link.'>';

require("../foot.php");		
?>