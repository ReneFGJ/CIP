<?php
require("cab.php");
require("../_class/_class_protocolo.php");
$proto = new protocolo;

echo '<h1>Inica��o Cient�fica</h1>';

echo $nw->user_cracha;
$sx = $proto->lista_protocolos_fechados('IC');

if (strlen($sx) > 0)
	{
		echo $sx;
	}


?>