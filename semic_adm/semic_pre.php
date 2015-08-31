<?php
require ("cab_semic.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs, array(http . 'admin/index.php', msg('principal')));
array_push($breadcrumbs, array(http . 'admin/index.php', msg('menu')));
echo '<div id="breadcrumbs">' . breadcrumbs() . '</div>';

require ($include . "sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', 'Resumo Geral', '_semic_nota.php'));
if (strlen($dd[0]) > 0) {
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase I - Notas Submissão', '_semic_nota.php?dd0=1'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase II - Notas Relatório Parcial', '_semic_nota.php?dd0=2'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase III - Notas Relatório Final', '_semic_nota.php?dd0=3'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase IV - Associar Trabalhos', '_semic_nota.php?dd0=4'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase V - Médias Final', '_semic_nota.php?dd0=5'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase VI - Distribuição das áreas', '_semic_nota.php?dd0=6'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase VII - Numeração dos trabalhos', '_semic_nota.php?dd0=7'));
	array_push($menu, array(msg('SEMIC') . ' - Pré-Edital', '__Preparação Fase VIII - Distribuição Quartil', '_semic_nota.php?dd0=8'));
	}
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Fora de Sede - Estudantes', '_semic_fora_de_sede.php'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Fora de Sede - Professores', '_semic_fora_de_sede_professor.php'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Edital Quartil', '_semic_edital_quartil.php'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Apresentação Oral por áreas', '_semic_apresentacao.php?dd0=1'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Apresentação Postêr por áreas', '_semic_apresentacao.php?dd0=2'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Trabalhos não indicados para apresentação', '_semic_para_nao_apresentacao.php'));


$tela = menus($menu, "3");

require ("../foot.php");
?>