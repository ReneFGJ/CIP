<?php
require("cab_bi.php");
require($include.'sisdoc_debug.php');

require('_class/_class_banco_variaveis.php');
$bc = new banco_variavel;
$bc->structure();

$ele = $_GET['varid'];

$ele = troca($ele,"'",'´');
	
	echo '<h1>Banco de Variáveis - '.$ele.'</h1>';
	echo '<BR>';
	echo 'Exportar: ';
	echo '<A HREF="varCSV.php?varid='.$ele.'&dd1=XLS" target="new_'.date("Ymdhis").'">Excel</A> ';
	echo '<A HREF="varCSV.php?varid='.$ele.'&dd1=CSV" target="new_'.date("Ymdhis").'">CSV</A> ';
	echo '<BR>';
	echo $bc->exportar_lista($ele);
?>
<form action="var_dados_ed.php?dd1=<?php echo $dd[1]; ?>"><input type="submit" value="nova entrada de dados"></form>
