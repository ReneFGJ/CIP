<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pуs-graduaзгo'));

require("cab_pos.php");

/* Dados da Classe */
require('../_class/_class_programa_pos.php');
$pos = new programa_pos;

require("../_class/_class_programa_pos_linhas.php");
$lin = new pos_linha;

/* busca programa secretaria */
$programa_nome = $_SESSION['pos_nome'];
if (strlen($programa_nome) == 0)
	{
		$pos->busca_secretaria();
	} else {
		redirecina('pos_graduacao_resume.php');
	}
	
/* Recupera Labels */	
	$programa_nome = $_SESSION['pos_nome'];
	$programa_pos = $_SESSION['pos_codigo'];
	$programa_pos_anoi = $_SESSION['pos_anoi'];
	$programa_pos_anof = $_SESSION['pos_anof'];
	if (strlen($programa_pos_anoi)==0) { $programa_pos_anoi = 1996; }
	if (strlen($programa_pos_anof)==0) { $programa_pos_anof = date("Y"); }
		
		
$pos->le($programa_pos);
echo $pos->mostra();

print_r($line);

echo $lin->mostra_resumo_pos($programa_pos);		
		
		
require("../foot.php");	?>