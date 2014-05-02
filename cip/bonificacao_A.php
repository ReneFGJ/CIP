<?php
/*** Modelo ****/
require("cab_cip.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

	/* Dados da Classe */
	require('../_class/_class_bonificacao.php');

	$clx = new bonificacao;
	$tabela = $clx->tabela;
	
	//$sql = "delete from ".$tabela." where id_bn = 46";
	//$rlt = db_query($sql);
	
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'bonificacao_ed.php'; 
	$http_ver = 'bonificacao_detalhe.php'; 
	$editar = False;
	$http_redirect = page();
	$clx->row();
	$busca = true;
	$offset = 20;
	$pre_where = " bn_status = 'A' and bn_original_tipo = 'PRJ' ";
	//and bn_original_tipo = 'PRJ' ";
	if ($order == 0) { $order  = $cdf[3] . ' desc '; }
	
	echo '<TABLE width="98%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 