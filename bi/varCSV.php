<?php
require("../db.php");

require('_class/_class_banco_variaveis.php');
$bc = new banco_variavel;

$ele = $_GET['varid'];

$ele = troca($ele,"'",'´');

switch ($dd[1])
	{
	case 'XLS':
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header("Content-type:   application/x-msexcel; charset=utf-8");
		header("Content-Disposition: attachment; filename='.$ele.'.xls"); 
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		break;
	case 'CSV':
		header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
		header("Content-type:   application/x-msexcel; charset=utf-8");
		header("Content-Disposition: attachment; filename='.$ele.'.csv"); 
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		break;
	}

if (strlen($ele) > 0)
	{
		echo $bc->exportar_lista($ele,$dd[1]);
	} else {
		echo 'Variavel não informada';
	}
?>