<?php
$breadcrumbs = array();
array_push($breadcrumbs, array('main.php', 'principal'));
array_push($breadcrumbs, array('relatorio.php', 'relatórios'));

require ("cab_cip.php");
require($include.'sisdoc_data.php');

require ($include . "_class_form.php");
$form = new form;

if (strlen($dd[1]) == 0) { $dd[1] = date("d/m/Y");
}
if (strlen($dd[2]) == 0) { $dd[2] = date("d/m/Y");
}

$cp = array();
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$D8', '', 'De', True, True));
array_push($cp, array('$D8', '', 'Até', True, True));

$tela = $form -> editar($cp, '');

if ($form -> saved > 0) {
	$tipo = $dd[3];
	
	echo '<A HREF="bonificacao_cr_excel.php?dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$dd[2].'">Exportar para o Excel</A>';

	require ("../_class/_class_bonificacao.php");
	$cl = new bonificacao;
	$datai = brtos($dd[1]);
	$dataf = brtos($dd[2]);
	echo $cl -> relatorio_pagamento_cr($datai, $dataf);
} else {
	echo $tela;
}


echo '<BR><BR>';
echo '</div></div>';
echo $hd->foot();
?>