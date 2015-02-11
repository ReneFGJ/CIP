<?php
require("cab_semic.php");
;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');

//$row_class = 'link';

require("../_class/_class_docentes.php");
$dis = new docentes;
$tabela = $dis->tabela;
$dis->row();

	$label = '';
	$http_edit = '';
	
	$http_ver = 'semic_avaliador_confirma.php';
	
	$http_redirect = page();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	$tab_max = '100%';
	$order  = "pp_nome";
	echo '<div id="content">';
	echo '<TABLE width="1024" align="center" border=0 ><TR><TD>';
	echo '<h1>Importar dados do professor para avaliador</h1>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	
	echo '</div>';



require("../foot.php");
