<?php
require("cab.php");

echo '</center>';
echo '<H1>Estudantes ou Orientadores com c�digo inv�lido</h1>';

require("../_class/_class_docentes.php");
	$doc = new docentes;
	
			/* Recupera nome dos alunos n�o inseridos */
			echo $doc->docente_orientacao_erro_codigo_aluno();
			
require("../foot.php");
?>
