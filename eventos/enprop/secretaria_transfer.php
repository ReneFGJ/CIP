<?php
require("secretaria_cab.php");
require($include.'sisdoc_data.php');
require("_class/_class_proceeding.php");
$ev = new proceeding;

switch ($dd[1])
	{
	case 'T':
		echo '<h1>Chegada</h1>';
		echo $ev->lista_transfer(0,0,0);
		break;
	case 'P':
		echo '<h1>Partida</h1>';
		echo $ev->lista_transfer(0,0,1);
		break;
	case 'H':
		echo '<h1>Partida</h1>';
		echo $ev->lista_transfer_hoteis();
		break;		
	case 'B':
		echo '<h1>Busca Aeroporto - Transfer</h1>';
		echo $ev->lista_transfer_aeroporto();
		break;			
	}

echo $sc->foot();
?>
