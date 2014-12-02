<?php
require("cab_semic.php");

require("../_class/_class_semic.php");
$sa = new semic;
$sa->semic_premiacao();

require("../_class/_class_semic_avaliacao.php");
$sa = new avaliacao;

echo $sa->show_notas();
echo '<HR>'.$sa->show_notas_final();
require("../foot.php");
?>
