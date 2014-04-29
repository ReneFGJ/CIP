<?php
require("cab.php");
require('../_class/_class_ged.php');

	/* Dados da Classe */
	require('../_class/_class_pibic_projetos.php');	
	
	$prj = new projetos;
	$edital = $dd[0];
	$ano = round($dd[1]);
	if (round($ano) == 0) { $ano = date("Y"); }
	
	echo '<h1>Planos submetidos</h1>';
	echo $prj->mostra_planos($edital,$ano);

?>

