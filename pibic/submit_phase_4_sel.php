<?php
require("cab.php");
require("cab_main.php");
require($include."sisdoc_tips.php");
require($include."sisdoc_breadcrumb.php");
$pos = new position;
$pos->items = array(array('título do projeto<BR>do professor','00',''),
			  array('dados do projeto','00','submit_phase_1.php'),
			  array('plano do aluno','00','submit_phase_3_sel.php'),
			  array('pibic jr','00','submit_phase_4_sel.php'),
			  array('finalização','01','submit_pibic_projeto.php'));
$pos->position = 0;
	
require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."cp2_gravar.php");
require("../_class/_class_ged.php");
$ged = new ged;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;

/* Mostra projeto */
echo $pos->display();

echo '<BR>';

$proto = $_SESSION['protocolo'];

if (strlen($proto)==0)
	{ redirecina('main.php'); }

$prj->protocolo = $proto;
echo $prj->mostra_projeto();

echo '<HR>';

echo $prj->resumo_planos();

$planos = round($prj->plano_pibic_em);
/*
 * plano_aluno($line)
 */
if (strlen($dd[0]) > 0)
	{
		if ($dd[90] == checkpost($dd[0]))
			{
				$_SESSION['proto_aluno'] = $dd[0];
				redirecina('submit_phase_4.php');
				exit;
			}
	}

$_SESSION['proto_aluno']='';
if ($planos < 1)
	{
		$sx .= '<form method="get" action="submit_phase_4.php">';
		$sx .= '<input type="hidden" name="dd0" value="NEW">';
		$sx .= '<input type="submit" value="submeter novo plano de aluno (Júnior)">';
		$sx .= '</form>';		
		echo $sx;
	}


echo $prj->resumo_planos_list('2');
	
?>