<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');

	$link_msg = '../messages/msg_ged_download.php';
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'erro:msg';}

	/* Mensagens */
	$tabela = 'ged_upload';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }
	
$id = $dd[0];
	
//if ($dd[90] == checkpost($id))
	{
		if ($dd[50] == 'pibic_submit_ged')
			{
				require("../pibic/_ged_config_submit_pibic.php");
			} else {
				require("../pibic/_ged_config.php");
			}
		$ged->id_doc = $id;
		echo $ged->file_delete($id);
		require("close.php");
//	} else {
//		echo msg('erro_post');
	}
?>
