<?
$include = '../';
require("db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');

	$link_msg = '../messages/msg_ged_download.php';
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'erro:msg';}

	/* Mensagens */
	$tabela = 'ged_upload';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }
	
$id = $dd[0];
$secu = uppercase($secu);
$chk1 = checkpost($id.$secu);
$secu = '';
$chk2 = checkpost($id);
if (($dd[90] == $chk1) or ($dd[90] == $chk2))
	{
	require("../pibic/_ged_config.php");
		echo $ged->download($id);
		if (strlen($dd[91])==0)
		{ mail('renefgj@gmail.com','leitura documento','ged_documento.php?dd91=1&dd0='.$dd[0].'&dd90='.$dd[90]); }
	} else {
		echo msg('erro_post');
		echo '['.$secu.']';
	}
?>
