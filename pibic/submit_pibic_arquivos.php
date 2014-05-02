<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require('_ged_config_submit_pibic.php');
?>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/style_body.css" />
	<link rel="stylesheet" type="text/css" href="../css/style_table.css" />
	<link rel="stylesheet" type="text/css" href="../css/style_botao.css" />
	
	<script language="JavaScript" type="text/javascript" src="../js/jquery-1.7.1.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/jquery.corner.js"></script>		
	<title>:: CIP :: Portal do Pesquisador</title>
</head>
<style>
body
	{
	font-family:Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 130%;
	}
</style>
<?
require('../_class/_class_language.php');
$proto = $_SESSION['protocolo'];
if (strlen($proto)==0) 
	{
		echo '<center>';
		echo 'Grava primeiro para poder inserir arquivos do projeto do professor';
	 exit; 
	}
if ($_GET['ddg'] == 'DEL')
	{
		$ged->id_doc = round($_GET['ddf']);
		$ged->file_delete();
	}
//$ged->structure();
$ged->protocol = $proto;
echo $ged->file_list();
?>
<input type="button" onclick="newxy2('ged_upload_pibic.php?dd1=<?php echo $proto;?>&dd2=PROJ',600,400);" value="Enviar Arquivo" class="botao-geral">
