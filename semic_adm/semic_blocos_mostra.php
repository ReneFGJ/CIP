<?php
require("cab_semic.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

require("../_class/_class_semic_blocos.php");
$blk = new blocos;

$id = round($dd[0]);
echo '<a href="semic_salas.php">Voltar</A>';
$blk->le($id);
echo $blk->mostra_bloco();

echo $blk->vincular_bloco_trabalho(0);
echo '<a href="semic_blocos_poster.php?dd0='.$dd[0].'">Mudas para POSTER</A>';
require("../foot.php");
?>
