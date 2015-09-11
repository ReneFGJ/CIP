<?php
	require ("cab_semic.php");
	
	require ($include . 'cp2_gravar.php');
	require ($include . 'sisdoc_colunas.php');
	require ($include . 'sisdoc_data.php');
	require ($include . 'sisdoc_form2.php');
	
	require ("../_class/_class_semic.php");
	$dis = new semic;

	$tabela = $dis -> tabela_nota_trab;
	
	$dis -> row();
	
	$label = '<h1>Trabalhos SEMIC ' . date("Y") . '</h1>';
	$http_edit = '';
	
	$editar = True;
	$http_edit = '../semic_adm/semic_list_ed.php';
	
	//redirect para ver detalhes do trabalho
	$http_ver = 'semic_list_ed.php';
	
	$http_redirect = page();
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order = "st_cod_trabalho";
	$tab_max = '100%';
	echo '<div id="content">';
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require ($include . 'sisdoc_row.php');
	echo '</table>';
	echo '</div>';

	require ("../foot.php");
?>