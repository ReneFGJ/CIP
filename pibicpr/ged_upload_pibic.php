<?php
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
$LANG = 'pt_BR';
require("../messages/msg_pt_BR.php");

?>
<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" />
	<link rel="stylesheet" type="text/css" href="../css/fieldset.css" />
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
<?php
require($include.'sisdoc_debug.php');


	/* Mensagens */
	$tabela = 'ged_upload';
	

$tipo = $dd[3];
require("_ged_config_submit_pibic.php");

echo '--->'.$ged->tabela;
echo $ged->file_attach_form();
?>
