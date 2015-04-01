<?php


	require("cab.php");
	
	require("../_class/_class_pibic_bolsa_contempladas.php");

		//echo "11 a 22 Março, Período de avaliação do relatório parcial PIBIC/PIBITI(2014/2015)";			
			
		$pb = new pibic_bolsa_contempladas;
		
		//entregas de Relatorios
		//echo $pb->acompanhamento_relatorio_parcial();
		//echo $pb->acompanhamento_idioma();	
		//echo $pb->semic_area_de_apresentacao(date("Y")-1);	
		//echo $pb->semic_area_de_apresentacao_geral(date("Y")-1);
		//$breadcrumbs = array();
		
	//Avaliação do relatório Parcial
	require("../_class/_class_ic_relatorio_parcial.php");		
			
		
		echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
		$pb = new pibic_bolsa_contempladas;
		$rp = new ic_relatorio_parcial;
		echo $pb->acompanhamento_avaliacao_relatorio_parcial();
		echo $pb->acompanhamento_avaliacao_relatorio_aprovacao();
		//echo $rp->acompanhamento_avaliacao_estatistica();
						
	require("../foot.php");	
?>