<?
$breadcrumbs=array();
require("cab_pos.php");

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS

//array_push($menu,array('Inicia��o Cient�fica','Indicadores Bolsas PIBIC','pibic_indicadores_bolsas.php?dd1=PIBIC'));

array_push($menu,array('PPG','Programas de P�s-Gradua��o','pos_graduacao_resume.php'));
array_push($menu,array('PPG','Programas de P�s-Gradua��o (indicadores)',$http.'/bi/pos_graduacao.php'));
if ($perfil->valid('#SEP'))
	{
		array_push($menu,array('PPG','Programas de P�s-Gradua��o (cadastro)','../cip/programa_pos.php'));
	}

array_push($menu,array('PPG','__Linhas de Pesquisa','programa_pos_linhas.php'));

array_push($menu,array('Fluxo Discente','Discentes ativos por orientador','discentes_orientador.php'));
array_push($menu,array('Fluxo Discente','Fluxo discente','discente_orientacao.php'));

array_push($menu,array('Mobilidade','Mobilidade Docente','mobilidade_docente.php'));
array_push($menu,array('Mobilidade','Professor visitante','mobilidade_visitante.php'));
array_push($menu,array('Mobilidade','Mobilidade discente','mobilidade_discente.php'));
array_push($menu,array('Mobilidade','Discente estrangeiro','mobilidade_estrangeiro.php'));

if ($perfil->valid('#SEP'))
	{
	array_push($menu,array('Mobilidade','__Cadastro das mobilidades','mobilidade_row.php'));
	array_push($menu,array('Mobilidade','__Cadastro dos tipos de bolsas/isen��es','bolsas_row.php'));
	
	}

array_push($menu,array('Docentes','Docentes','docentes.php'));
	///////////////////////////////////////////////////// redirecionamento
?>

<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="index.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?php
	$tela = menus($menu,"3");

require("../foot.php");	
?>