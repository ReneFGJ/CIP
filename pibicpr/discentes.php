<?php
require("cab.php");
;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');


require("../_class/_class_discentes.php");
$dis = new discentes;
$tabela = $dis->tabela;

$dis->limpar_aluno_sem_codigo();


$dis->row();

	$label = msg('tit_'.$tabela);
	$http_edit = 'discentes_ed.php'; 
	//$editar = True;
	
	$http_ver = 'discente.php';
	$editar = True;
	
	$http_redirect = page();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order  = "pa_nome";
	$tab_max = '100%';
	echo '<div id="content">';
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	
	echo '</div>';



require("../foot.php");
