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
array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', 'Resumo Geral', '_semic_nota.php'));
if (strlen($dd[0]) > 0) {
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase I - Notas Submiss�o', '_semic_nota.php?dd0=1'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase II - Notas Relat�rio Parcial', '_semic_nota.php?dd0=2'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase III - Notas Relat�rio Final', '_semic_nota.php?dd0=3'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase IV - Associar Trabalhos', '_semic_nota.php?dd0=4'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase V - M�dias Final', '_semic_nota.php?dd0=5'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase VI - Distribui��o das �reas', '_semic_nota.php?dd0=6'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase VII - Numera��o dos trabalhos', '_semic_nota.php?dd0=7'));
	array_push($menu, array(msg('SEMIC') . ' - Pr�-Edital', '__Prepara��o Fase VIII - Distribui��o Quartil', '_semic_nota.php?dd0=8'));
	}
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Fora de Sede - Estudantes', '_semic_fora_de_sede.php'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Fora de Sede - Professores', '_semic_fora_de_sede_professor.php'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Edital Quartil', '_semic_edital_quartil.php'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Apresenta��o Oral por �reas', '_semic_apresentacao.php?dd0=1'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Apresenta��o Post�r por �reas', '_semic_apresentacao.php?dd0=2'));
	array_push($menu, array(msg('SEMIC') . ' - Edital', 'Trabalhos n�o indicados para apresenta��o', '_semic_para_nao_apresentacao.php'));


$tela = menus($menu, "3");

require ("../foot.php");
?>