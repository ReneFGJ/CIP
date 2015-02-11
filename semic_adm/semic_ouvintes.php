<?
require("cab_semic.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

	require("../_class/_class_semic_ouvinte.php");
	$clx = new ouvinte;
	$tabela = $clx->tabela;
	
	$label = msg('tit_'.$tabela);
	$http_edit = 'semic_ouvinte_ed.php'; 
	$editar = True;
	
	$http_ver = '';
	
	$http_redirect = page();

	$clx->row();

	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	echo '<div id="content">';
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	
	echo '</div>';

	require("../foot.php"); 
?>