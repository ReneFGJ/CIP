<?php
require("cab.php");
require('../_class/_class_pibic_projetos.php');
$pj = new pibic_projetos;


if ($dd[5] == 'AGR')
	{ echo $pj->plano_troca_protocolo_mae($dd[1],$dd[2]); }
if ($dd[5] == 'DIF')
	{ echo $pj->protocolo_diferenciar($dd[1],$dd[2]); }
require("../foot.php");
?>
