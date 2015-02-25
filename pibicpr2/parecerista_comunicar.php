<?php
require("cab.php");
require($include.'sisdoc_windows.php');
require("../_class/_class_semic.php");
$semic = new semic;
echo $semic->comunitar_avaliador_externo_row();

require("foot.php");
?>
