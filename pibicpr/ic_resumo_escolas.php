<?php
require("cab.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
if (strlen($dd[4])==0) { $ano = date("Y"); }
else { $ano = $dd[4]; }

echo '<h3>Bolsas Ativas por Escola '.$ano.' '.$dd[3].'</h3>';

if ($dd[2]=='R')
	{ echo $pb->resumo_bolsas_escolas($ano,$dd[3],$dd[5]); }
if ($dd[2]=='D')
	{ echo $pb->resumo_bolsas_escolas_detalhado($ano,$dd[3],$dd[5]); }

echo $hd->foot();
?>
