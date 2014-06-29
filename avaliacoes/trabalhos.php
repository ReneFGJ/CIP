<?
require("cab.php");
require($include."sisdoc_windows.php");
$no_pdf = "S";
$sumario="SUMÁRIO";
if ($idioma=="2") { $sumario = "SUMMARY"; }
if ($idioma=="3") { $sumario = "EL RESUMEN"; }
if ($idioma=="4") { $sumario = "LE RÉSUMÉ"; }
?>
<P>
<CENTER><FONT class="lt3"><B><?=CharE($sumario)?></B></FONT>
<P>
<?
$is_max = 668;
echo '<TABLE width="'.$is_max.'" cellpadding="0" cellspacing="2" border="0" class=lta ><TR><TD>';
echo "<FONT CLASS=lt4>Seminário de Iniciação Científica</FONT>";
echo '</TD></TR></TABLE>';
$isstp=1;
$seq_min = 0;
$seq_max = 79;
require('../layout/0115/titulo_mostra.php');

//***********************************************
echo "<P>";
echo '<TABLE width="'.$is_max.'" cellpadding="0" cellspacing="2" border="0" class=lta ><TR><TD>';
echo "<FONT CLASS=lt4>Mostra de Pesquisa da PUCPR</FONT>";
echo '</TD></TR></TABLE>';
$seq_min = 80;
$seq_max = 299;
require('../layout/0115/titulo_mostra.php');
?>
</TABLE>
<?
require("foot.php");	?>