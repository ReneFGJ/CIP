<?php
require("cab.php");

echo '</center>';
echo '<H1>Estudantes ou Orientadores com c�digo inv�lido</h1>';

	require ('../_class/_class_pibic_bolsa_contempladas.php');
	$pb = new pibic_bolsa_contempladas;
	
			/* Recupera nome dos alunos n�o inseridos */
			echo $pb->discentes_com_erro_codigo();
			
require("../foot.php");
?>
