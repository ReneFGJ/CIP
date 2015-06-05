<?php
	require("cab.php");
	require($include."sisdoc_debug.php");
	require($include."sisdoc_menus.php");
	require($include.'sisdoc_form2.php');
	require($include.'cp2_gravar.php');
	
	require("../_class/_class_docentes.php");
	$pb = new docentes;
	
	//Array
	$cp = array();
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$A8','','Seleciona dados',False,True,''));
	//opcao para descrever os valores para usar
	//array_push($cp,array('$O 001:Mestre&002:Dr.&003:Dra.&004:Graduado&005:Especialista_Masc&006:PhD&007:Especialista_Fem.&008:Pós-Graduado&009:Graduando&010:Res. Médica&011:Doutorando','','Docentes',False,True,''));	
	//opcao para buscar os valores de uma tabela
	
	array_push($cp,array('$Q ap_tit_titulo:ap_tit_codigo:select * from apoio_titulacao where at_tit_ativo = 1 order by ap_tit_titulo','','Docentes',False,True,''));
	
	//monta tabela de seleciona dados
	?><TABLE width="<?=$tab_max?>"align="center"><TR><TD><?
		editar();
	?></TD></TR></TABLE><?	
	
	if ($saved == 0)
		{ exit; }
	
	echo $pb->professores_sem_email($dd[2]);
	
	
	
	require("../foot.php");	
?>