<?
require("cab_pibic.php");
require($include.'sisdoc_debug.php');

$ss = '<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">';
$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Próximas atividades - Entrega Relatório Parcial</font></B>&nbsp;</legend>';
$user->cracha = $nw->user_cracha;
?>
<div id="total">
	<h1>Lista de alunos</h1>
	<p><?=msg("msg_IC1");?></p>
<?php		
require("atividade_IC1_row.php");

echo '</div>';


require("../foot.php");
?>
