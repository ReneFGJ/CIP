<?php
require("cab_bi.php");
require($include.'sisdoc_debug.php');

require('_class/_class_banco_variaveis.php');
$bc = new banco_variavel;
$bc->structure();

$ele = $_GET['varid'];

$ele = troca($ele,"'",'´');
	
	echo '<h1>Banco de Variáveis</h1>';
	echo '<BR>';
	echo $bc->lista_variaveis();
?>
<form action="var_ed.php"><input type="submit" value="novo registro"></form>
