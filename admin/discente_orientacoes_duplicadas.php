<?php
require("cab.php");

echo '</center>';
echo '<H1>Orienta��es duplicadas</h1>';

require("../_class/_class_docentes.php");
	$doc = new docentes;
	
			/* Recupera nome dos alunos n�o inseridos */
			echo $doc->docente_orientacao_duplicado();
			
require("../foot.php");
?>
