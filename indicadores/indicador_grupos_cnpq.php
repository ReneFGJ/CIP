<?php
require("cab.php");
require($include.'sisdoc_data.php');

echo $hd->hr('Grupos de Pesquisa');

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

echo $gp->resumo_grupos();

require("foot.php");
?>
