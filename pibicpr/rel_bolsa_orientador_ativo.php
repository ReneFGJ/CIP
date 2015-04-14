<?php
if ($_GET["dd4"]=='XML') {
	require ("../db.php");
	
	header("Content-Type:   application/vnd.ms-excel; charset=ISO-8859-1");
	header("Content-type:   application/x-msexcel; charset=ISO-8859-1");
	header("Content-Disposition: attachment; filename=Orienteadores_ativos.xls");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
	require ('../_class/_class_pibic_bolsa_contempladas.php');
	
	echo 'Professores com Orientações IC/IT/Jr';
	/* Chama Classe */

	require ('../_class/_class_pibic_bolsa_contempladas.php');
	$pb = new pibic_bolsa_contempladas;
	echo $pb -> orientacoes_ativos($dd[1], $dd[2],$dd[3]);
	exit ;
} else {
	require ("cab.php");
}


require ($include . '_class_form.php');
$form = new form;

$cp = array();
array_push($cp, array('$H8', '', '', False, False));
array_push($cp, array('$[2009-' . date("Y") . ']', '', 'Ano Inicial', True, True));
array_push($cp, array('$[2009-' . date("Y") . ']', '', 'Ano Final', True, True));
array_push($cp, array('$O A:Todos&B:Strico Sensu&C:Sem Stricto Sensu', '', 'Tipos', True, True));

$tela = $form -> editar($cp, '');

if ($form -> saved > 0) {
	echo '<A HREF="'.page().'?dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.$dd[3].'&dd4=XML">Exportar para Excel</A>';
	require ('../_class/_class_pibic_bolsa_contempladas.php');
	$pb = new pibic_bolsa_contempladas;
	echo '<H1>Professores com Orientações IC/IT/Jr</h1>';
	echo $pb -> orientacoes_ativos($dd[1], $dd[2],$dd[3]);
	exit ;
} else {
	echo $tela;
}
?>