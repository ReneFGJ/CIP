<?php
require("cab.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
if (strlen($dd[1])==0) { $dd[1] = date("Y"); }
echo '<h3>Bolsas Ativas por Escola '.$dd[1].' '.$dd[3].'</h3>';
$ano = $dd[4];
if ($dd[2]=='R')
	{ echo $pb->resumo_bolsas_campi($ano,$dd[3],$dd[4],$dd[5]); }
if ($dd[2]=='D')
	{ echo $pb->resumo_bolsas_campi_detalhado($ano,$dd[3],$dd[4],$dd[5]); }

echo $hd->foot();
?>
