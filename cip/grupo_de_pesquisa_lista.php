<?
require("cab_cip.php");
require('../_class/_class_grupo_de_pesquisa.php');

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

	$clx = new grupo_de_pesquisa;
	//$cp = $clx->cp();

	echo '<h3> Grupos, pesquisadores, estudantes, t�cnicos e linhas de pesquisa</h3>';
	echo $clx->grupos_resumo();
	echo '<h3>Distribui��o e caracter�sticas dos grupos de pesquisa - grande �rea do conhecimento</h3>';
	echo $clx->grupos_areas_resumo();
	echo $clx->grupos_de_pesquisa_relacao();

require("../foot.php");		
?> 