<?php
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
	
	/* Dados da Classe */
	require('../_class/_class_lattes.php');
	$clx = new lattes;
	$tabela = $clx->tabela_journal;
	
	/* Não alterar - dados comuns */
	$label = msg($tabela);
	$http_edit = 'lattes_periodicos_ed.php'; 
	$http_ver = 'lattes_periodicos_ver.php'; 
	$editar = True;
	$http_redirect = 'lattes_periodicos.php';
	$clx->row_journal();
	$busca = true;
	$offset = 20;
	
	if ($order == 0) { $order  = $cdf[1]; }
	
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 