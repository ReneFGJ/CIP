<?php
require('cab.php');
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

require($include.$include.'_class_form.php');
$form = new form;
echo '<h1>Equipamentos para pesquisa</h1>';
require($include.'sisdoc_data.php');

	require("../_class/_class_laboratorio.php");
	$cl = new laboratorio;
	
	$cl->le_equipamento($dd[0]);
	$cl->le($cl->laboratorio);
	echo $cl->mostra();
	echo $cl->mostra_equipamento();
	
	require("_ged_equipamento_ged.php");
	$ged->protocol = $cl->line_eq['eq_codigo'];	
	$proto = $ged->protocol;
	//$ged->structure();
	echo $ged->mostra_fotos();

	echo $ged->upload_botton_with_type($proto);
		
	echo $cl->lista_equipamentos($dd[0]);
	
	
return('../foot.php');		
?>

