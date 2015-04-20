<?php
require("cab.php");
require("../_class/_class_docentes.php");

	$cl = new docentes;	
	
	echo $cp = $cl->docentes_blacklist();

require("../foot.php");
?>
