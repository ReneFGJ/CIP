<?
$breadcrumbs=array();
require("cab_bi.php");

$dd1=$dd[1]; /* Programa de Pos */
$datai = 2010;
$dataf = date("Y");

require("../_class/_class_captacao.php");
$cap = new captacao;

/* Graficos */
		$dd[3] = '002';
		$ddi = $datai.'0101';
		$ddf = $dataf.'1299';
		$programa_pos = $dd1;
		$detalhe = 1;
		if ($dd[3] == '001') { echo $cap->projetos_vigentes_inicio($ddi,$ddf,1,$detalhe,$agencia,$status,$programa_pos); }
		if ($dd[3] == '002') { echo $cap->projetos_vigentes_inicio($ddi,$ddf,2,$detalhe,$agencia,$status,$programa_pos); }
		
		
		echo '<table border=1 width="100%">';
		echo '<tr>';
		echo '<TD width="33%">';
		echo $cap->sg2; 
		echo '<TD width="33%">';
		echo $cap->sg3; 
		echo '<TD width="33%">';
		echo $cap->sg4; 
		
		echo '<tr>';
		echo '<TD width="33%">';
		echo $cap->sg5; 
		echo '<TD width="33%">';
		echo $cap->sg6; 
		echo '<TD width="33%">';
		echo $cap->sg7; 
				
		echo '</table>';
		
/* Open Data */

echo $cap->mostra_captacao_programas($dd1,$datai,$dataf);

echo $cap->mostra_captacao_programas_v2($dd1,$datai,$dataf);

require("../foot.php");	
?>