<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">	
</head><?

	require('../_class/_class_agencia_editais.php');
	$clx = new agencia_editais;
	$cp = $clx->cp_captacao();
	$tabela = $clx->tabela.'_captacao';
	
	echo '<table width="100%">';
	editar();
	echo '</table>';
	
	if ($saved > 0)
		{
			$clx->updatex();
			require("close.php");
		}
	
	?>
