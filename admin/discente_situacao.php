<?php
require("cab.php");
require($include."sisdoc_debug.php");
require("../_class/_class_discentes.php");
$dis = new discentes;

$ok = $dis->reconsulta_dados_estudantes();

if ($ok > 0)
	{
		echo '<meta http-equiv="refresh" content="1">';
	}

require("../foot.php");	?>