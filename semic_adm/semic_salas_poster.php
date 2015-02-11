<?php
require("cab_semic.php");
require("../_class/_class_semic_blocos.php");
$bl = new blocos;

echo $bl->mostra_blocos(0,0);

require("../foot.php");
?>
