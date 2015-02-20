<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pós-graduação'));

//require("cab_pos.php");
require("cab.php");

/* Dados da Classe */
require('../_class/_class_programa_pos.php');
$pos = new programa_pos;

require("../_class/_class_programa_pos_linhas.php");
$lin = new pos_linha;

		$programa_nome = $_SESSION['pos_nome'];
		$programa_pos = $_SESSION['pos_codigo'];
		$programa_pos_anoi = $_SESSION['pos_anoi'];
		$programa_pos_anof = $_SESSION['pos_anof'];
		if (strlen($programa_pos_anoi)==0) { $programa_pos_anoi = 1996; }
		if (strlen($programa_pos_anof)==0) { $programa_pos_anof = date("Y"); }
		
$pos->le($programa_pos);
		
		
$sx = '';
$sx .= $pos->mostra();
$sx .= $lin->mostra_resumo_pos($programa_pos);	

/* Linhas de Pesquisa */
$sql = "select * from programa_pos_linhas
			where posln_programa = '$programa_pos'
			and posln_ativo = 1
		";
$rlt = db_query($sql);
$sx .= '<BR><BR>';
while ($line = db_read($rlt))
	{
		$lin_id = round($line['id_posln']);
		$lin->le($lin_id);
	
		$sx .= $lin->mostra();
		$sx .= $lin->mostra_docentes();
	}


echo $sx;
		
require("../foot.php");	?>