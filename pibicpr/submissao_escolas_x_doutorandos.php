<?php
	require("cab.php");
	require("../_class/_class_pibic_projetos_v2.php");
	
		$ano = date("Y");
		
		$pj = new projetos;
		echo $pj->resumo_doutotando_e_posdoutorando_escola($ano); 
	
	require("../foot.php");	
?>


