<?php
require("cab.php");
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
ini_set('display_errors', 255);
ini_set('error_reporting', 255);

$modelo = 3;

require("../editora/_class/_class_parecer.php");
$pp = new parecer;
$pp->le($dd[0]);

require("../editora/_class/_class_submit_article.php");
$art = new submit;
$art->le('',$pp->protocolo);
$jid = $art->journal;

/* Journal */
require("../editora/_class/_class_journal.php");
$jnl = new journal;
$jnl->le($jid);

$ln = $jnl->line;
$parecer = round($ln['jn_parecer']);
if ($parecer > 0)
	{ $modelo = $parecer; }
$clx = new parecer_model;
$clx->parecer_id = $dd[0];
	
echo $art->mostra_dados();
echo '<BR>';
require("../_class/_class_ic.php");

require_once('../editora/_ged_submit_files.php');
$ged->protocol = $pp->protocolo;

$protocolo = $pp->protocolo;
require("avaliacao_jnl_AV_files_2.php");
require("avaliacao_jnl_AV_files.php");

if (($pp->status == 'B') or ($pp->status == 'C'))
	{
		echo '<BR><center>';
		echo '<h2><font color="green">Avaliação Finalizada</font></h2>';
		echo '<BR><BR><BR><center>';
		exit;
	}
if ($pp->status == 'D')
	{
		echo '<BR><center>';
		echo '<h2><font color="red">Indicação de avaliação declinada</h2>';
		echo '<BR><BR><BR><center>';
		exit;
	}
	
echo '<div>';
echo '<form method="post">';
	$edit_mode = 0;
	echo $clx->show_parecer($modelo);
echo '</form>';
echo '</div>';

/* Salvo */
if ($clx->saved == 1)
	{
		echo 'SAVED';
		$pp->alterar_status_avaliacao('B');
		$art->comunicar_editor();
		$art->comunicar_avaliador();		
		redirecina(page().'?dd0='.$dd[0].'&dd90='.$dd[90]);
	} else {
		$pp->alterar_status_avaliacao('A');
	}
?>
