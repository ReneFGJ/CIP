<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');

	$link_msg = '../messages/msg_ged_upload.php';
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'erro:msg';}

	/* Mensagens */
	$tabela = 'ged_upload';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }
	
	
	
$tipo = $dd[3];
require("_ged_config.php");

//	$sql = "alter table ".$ged->tabela." add column doc_versao char(4)";
//	$rlt = db_query($sql);

echo $ged->file_attach_form();
?>
