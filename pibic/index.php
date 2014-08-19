<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs,array('main.php','principal'));
array_push($breadcrumbs,array($site.'main.php','menu'));
require("cab_pibic.php");

require($include.'sisdoc_data.php');

$professor = $ss->user_cracha;

/* Valida pendencia da submissao */
require("../_class/_class_pibic_projetos_v2.php");
$pj = new projetos;

//$tot = $pj->projetos_para_correcao($professor);
if ($tot > 0)
	{
		echo '<H1><font color="red">Corre��o de trabalhos submetidos</font></h1>';
		echo '<img src="'.$http.'img/icone_alert.png">';
		echo '<A HREF="submit_project.php">Clique arqui para iniciar a corre��o</A>';
	}


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
require("../pibic/__submit_INPL.php");
if ($open == 1)
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

if ((date("m") >= 7) and (date("m") <= 8))
	{
		echo '<h1>PIBIC/PIBITI - Parecer do(s) Projeto(s)'.(date("Y")).'/'.(date("Y")+1).'</h1>';
		echo $ed->show_protocolo_professor($nw->user_cracha);		
	}

/* Relatorio Parcial */
if (date("m") < 4) { require("atividade_IC1_row.php"); }
/* Relatório Parcial - Correcoes */
if (date("m") < 4) { require("atividade_IC7_row.php"); }
/* Relat�rio Final e resumo */
if (file_exists('__submit_RFIN.php'))
	{
		require("__submit_RFIN.php");
		if ((date("m") > 5) and (date("m") < 11) and ($open == 1)) 
		{
		require("atividade_IC3_row.php");
		require("atividade_IC4_row.php");
		}
	}
/* Relat�rio Final e resumo */
if (file_exists('__submit_RFIC.php'))
	{
		require("__submit_RFIC.php");
		if ((date("m") > 5) and (date("m") < 11) and ($open == 1)) 
		{
		require("atividade_IC5_row.php");
		}
	}
 /* require("atividade_IC6_row.php"); */

require("../foot.php");
?>