<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));
require("cab_pibic.php");

require($include.'sisdoc_data.php');

$professor = $ss->user_cracha;

/*
echo '<font class="lt1">Submiss�o de projeto IC Internacional</font><BR>';
echo '<A HREF="submit_project.php">
	<img src="img/logo_ic_internacional.png" border=0>
	</A>
';
echo '<BR><font class="lt1">Envie aqui!</font><BR>';
*/

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$pb->set($professor);
//if ($professor == '88958022')
	{
		echo $pb->resumo();
	}

require("../_class/_class_atividades.php");
$act = new atividades;

require("../_class/_class_docentes.php");

require("../_class/_class_pibic_edital.php");
$ed = new pibic_edital;



$ano = date("Y");

if (date("m") < 4)
	{
		$ano = $ano - 1;
	}

//if ($professor == '88958022')
{
	//echo $ed->bolsas_indicadas($professor,$ano);
	$id_pesq = $professor;
	require("atividade_bolsa_implantacao.php");
}

/*
$ed = new pibic_edital;
echo '<h3>PIBIC_EM (Jr)</h3>';
echo $ed->edital_resumo_professor(date("Y"),$professor,'PIBICE');

echo '<h3>PIBITI</h3>';
echo $ed->edital_resumo_professor(date("Y"),$professor,'PIBITI');

echo '<h3>PIBIC</h3>';
echo $ed->edital_resumo_professor(date("Y"),$professor,'PIBIC');
*/
/* Relatório Parcial */
require("atividade_IC1_row.php");
/* Relatório Parcial - Correcoes */
require("atividade_IC7_row.php");
 
/*
 equire("atividade_IC3_row.php");
require("atividade_IC4_row.php");
echo '<HR>';
*/
 /* require("atividade_IC6_row.php"); */

require("../foot.php");
?>