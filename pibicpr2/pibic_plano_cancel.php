<?php
$include = '../';
require('../db.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Plano do Aluno</title>
	<link rel="STYLESHEET" type="text/css" href="css/letras.css">	
<?
require('../_class/_class_pibic_projetos.php');	
$pj = new pibic_projetos;

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }
	
$sql = "select * from pibic_submit_documento where id_doc = ".round($dd[0])." limit 1";
$rlt = db_query($sql);
$line = db_read($rlt);

echo '<table width="100%">';
echo $pj->planos_mostra_mini($line);
echo '</table>';

echo '<form method="post" action="'.page().'">';
echo '<input name="dd0" value="'.$dd[0].'" type="hidden">';
echo '<input name="dd90" value="'.$dd[90].'" type="hidden">';
echo '<center>';
echo '<input type="checkbox" value="1" name="dd2">SIM, cancelar plano do aluno<BR><BR>';
echo '<input type="submit" name="dd3" value="cancelar plano do aluno">';
echo '</form>';

if ((strlen($dd[2]) > 0) and (strlen($dd[3]) > 0))
	{
		echo '>>> CANCELADO';
		$pj->plano_cancelar($dd[0]);
		require('close.php');
	}
?>