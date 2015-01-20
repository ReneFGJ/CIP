<?php
$breadcrumbs = array();
array_push($breadcrumbs, array('main.php', 'principal'));
array_push($breadcrumbs, array('relatorio.php', 'relatуrios'));

require ("cab_cip.php");

require ($include . "_class_form.php");
$form = new form;

$opa .= ' : ';
$opa .= '&0:Resumo dos pagamentos';
$opa .= '&1:Projetos por professor';
$opa .= '&2:Artigos bonificados por professor';
//$opa .= '&2:Programa de Pуs-Graduaзгo';

$opb .= 'B:Pagos';
$opb .= '&A:Em processo';
$opb .= '&X:Cancelados';
$opb .= '&Z:Todos';

if (strlen($dd[1]) == 0) { $dd[1] = '01/01/' . date("Y");
}
if (strlen($dd[2]) == 0) { $dd[2] = date("d/m/Y");
}

$cp = array();
array_push($cp, array('$H8', '', '', False, True));
array_push($cp, array('$D8', '', 'De', True, True));
array_push($cp, array('$D8', '', 'Atй', True, True));
array_push($cp, array('$O ' . $opa, '', 'Tipo', True, True));
array_push($cp, array('$O ' . $opb, '', 'Status', True, True));

$tela = $form -> editar($cp, '');

if ($form -> saved > 0) {
	$tipo = $dd[3];

	require ("../_class/_class_bonificacao.php");
	$cl = new bonificacao;
	$datai = brtos($dd[1]);
	$dataf = brtos($dd[2]);
	$st = $dd[4];
	switch ($tipo) {
		case '0' :
			echo $cl -> resumo_dos_pagamentos($datai, $dataf);
			break;

		case '1' :
			echo $cl -> relatorio_por_professor($datai, $dataf,'B');
			break;
		case '2' :
			echo $cl -> relatorio_por_professor($datai, $dataf,'C');
			break;
		default :
			echo 'Relatуrio nгo disponнvel';
	}
} else {
	echo $tela;
}
?>