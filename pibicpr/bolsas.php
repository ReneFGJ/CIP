<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

array_push($menu,array(msg('gestao_de_bolsas'),'Bolsas implementadas',''));
array_push($menu,array(msg('gestao_de_bolsas'),'Resumo','bolsas_01.php'));
array_push($menu,array(msg('gestao_de_bolsas'),'__Bolsas implementadas','pibic_implementacao_bolsas_relatorio.php'));
array_push($menu,array(msg('gestao_de_bolsas'),'__Bolsas suspensas','bolsas_indicacao_status.php'));

array_push($menu,array(msg('indicacao_bolsas'),'Indicar Bolsas para Implementação','bolsas_indicacao.php'));
array_push($menu,array(msg('indicacao_bolsas'),'Status das Bolsas Indicadas','bolsas_indicacao_status.php'));



if ($perfil->valid('#ADM'))
	{
		array_push($menu,array(msg('ativar_bolsas'),'Ativar um protocolo de pesquisa com ICV','bolsas_indicacao_status.php'));		
	}


echo '<TABLE width="710" align="center" border="0">
		<TR>';
		$tela = menus($menu,"3");
echo '</table>';
require("../foot.php");	
?>