<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');

	/* Mensagens */
	$tabela = 'ged_upload';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }
	
$id = $dd[0];
//if ($dd[90] == checkpost($id))
//	{
	require("../pibic/_ged_config.php");
	
	if (strlen($dd[50]) > 0) { $ged->tabela = $dd[50]; }
		echo $ged->download($id);
//	} else {
		//echo msg('erro_post');
	//}
?>
