<?
require("cab_cip.php");

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_data.php');

require('../_class/_class_grupo_de_pesquisa.php');
$clx = new grupo_de_pesquisa;

echo '<h1>Grupos de Pesquisa</h1>';

$clx->le($dd[0]);
echo $clx->mostra_dados();
echo $clx->mostra_lider();

echo $clx->actions_show();
echo '</fieldset>';
//echo $clx->mostra_pesquisadores();
//echo $clx->mostra_estudantes();

require("../foot.php");		
?> 