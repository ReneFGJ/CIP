<?php
require("secretaria_cab.php");

require($include."sisdoc_menus.php");
$menu = array();

require("_class/_class_proceeding.php");
$ev = new proceeding;

	echo '<center>';
	echo $ev->busca_form();
		

	array_push($menu,array('Credenciamento','__Realizar credendiamento','registration.php'));

	array_push($menu,array('Inscritos','__Lista de Inscritos','secretaria_inscritos.php'));
	array_push($menu,array('Inscritos','__Inscritos canceladas','secretaria_inscritos.php?dd1=X'));
	
	array_push($menu,array('Inscritos','__Lista de Inscritos (CAPES)','secretaria_inscritos_filtro.php'));
	array_push($menu,array('Inscritos','__Resumo dos Inscritos','secretaria_resumo.php'));

	array_push($menu,array('Transfer','Planilha de Transfer (Chegada)','secretaria_transfer.php?dd1=T'));
	array_push($menu,array('Transfer','__Planilha de Transfer (Por Horário)','secretaria_transfer.php?dd1=B'));
	array_push($menu,array('Transfer','__Planilha de Transfer (Partida)','secretaria_transfer.php?dd1=P'));
	array_push($menu,array('Transfer','__Planilha por hoteis','secretaria_transfer.php?dd1=H'));
	
	array_push($menu,array('Comunicação','__Enviar comunicação','secretaria_comuncacao.php'));
	
	array_push($menu,array('Etiquetas','__Imprimir Todas','secretaria_etiquetas_todas.php'));
	
	menus($menu,'3');
	
echo $sc->foot();
?>
