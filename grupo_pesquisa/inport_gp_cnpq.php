<?php
require("cab.php");

require($include.'_class_io.php');

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

echo $gp->inport($dd[0]);


?>