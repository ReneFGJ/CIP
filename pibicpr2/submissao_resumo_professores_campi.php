<?
	require("cab.php");
	require($include."sisdoc_debug.php");
	//require("../_class/_class_pibic_projetos.php");
	require("../_class/_class_pibic_projetos_v2.php");
		
		$ano = date("Y");
		$cpi = "";
		
		$pj = new projetos;
		
		echo '<H2>Resumo da Submissão - Campus</H2>';
		echo $pj->resumo_projetos_area();
		
	require("foot.php");
?>