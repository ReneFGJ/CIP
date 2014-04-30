<?php
require("cab.php");
;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');

require("../_class/_class_docentes.php");
$dis = new docentes;
$tabela = $dis->tabela;
$dis->row();

	$label = '<h1>Docentes</h1>';
	$http_edit = '';
	
if (($perfil->valid('#ADM#PIB#PIT#SPI')))
	{ 
	$editar = True;
	$http_edit = '../cip/docentes_ed.php';
	}
	
	$http_ver = 'docente.php';
	
	$http_redirect = page();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order  = "pp_nome";
	$tab_max = '100%';
	echo '<div id="content">';
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	
	echo '</div>';



require("../foot.php");
