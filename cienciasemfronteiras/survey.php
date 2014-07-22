<?php
ob_start();
session_start();

require("cab_survey.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require("_class/_class_survey_part_001.php");
$sv = new survey;
require("../_class/_class_ic.php");
//$sv->busca_alunos_questionario_csf('S004','88958022');
//$sv->resumo();
//exit;

if (strlen($dd[0])==0)
	{
		$dd[0] = $_SESSION['dd0'];
		if (strlen($dd[0])==0)
			{
	 			echo 'Erro de post'; exit;
			}
	}
else {
	$_SESSION['dd0'] = $dd[0];
}
	
$sv->le($dd[0]);
echo '<h1>'.$sv->nome.'</h1>';


if ($sv->status == 'A')
	{
		echo '<h1><font color="red">Questionário Finalizado</h1>';
		exit;
	}
function msg($x) 
	{
		if ($x=='field_requered') { $x = 'campo obrigatório'; }
		 return($x); 
	}

/* Pï¿½gina */
$pag = $_GET['pag'];
if (strlen($pag)==0)
	{
	$pag = $_SESSION['pag'];
	}
if (round($pag)==0) { $pag = 1; }
$_SESSION['pag'] = $pag;

switch ($pag)
	{
	case '1': $cp = $sv->cp_01(); break;
	case '2': $cp = $sv->cp_02(); break;
	case '3': $cp = $sv->cp_03(); break;
	case '4': $cp = $sv->cp_04(); break;
	case '5': $cp = $sv->finish(); break; 
	}
$tela = $form->editar($cp,'csf_survey');

if ($form->saved > 0)	
	{
		redirecina(page().'?dd0='.$dd[0].'&pag='.($pag+1));
	} else {
		echo $tela;
	}
require("foot_survey.php");
?>

