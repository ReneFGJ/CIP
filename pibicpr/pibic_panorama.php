<?php
	require("cab.php");
	
	require("../_class/_class_pibic_bolsa_contempladas.php");
			
		$pb = new pibic_bolsa_contempladas;
	
		//echo "Em desenvolvimento!";
		
		echo $pb->acompanhamento_relatorio_parcial();
		echo $pb->acompanhamento_idioma();	
		echo $pb->semic_area_de_apresentacao(date("Y")-1);	
		echo $pb->semic_area_de_apresentacao_geral(date("Y")-1);
				
	require("../foot.php");	
?>