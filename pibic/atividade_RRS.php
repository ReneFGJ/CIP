<?
require("cab_pibic.php");
require($include.'sisdoc_debug.php');

require("../_class/_class_ic_relatorio_parcial.php");
$rl = new ic_relatorio_parcial;

$ss = '<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">';
$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Pr�ximas atividades - Entrega Relat�rio Parcial</font></B>&nbsp;</legend>';
$user->cracha = $nw->user_cracha;
?>
<div id="total">
	<h1>Lista de alunos</h1>
	<p><?=msg("msg_RRS");?></p>
<?php		
echo $rl->lista_validacoes_semic($user->cracha);
echo '</table>';


require("../foot.php");
?>
