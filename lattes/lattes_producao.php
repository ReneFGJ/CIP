<?
$breadcrumbs=array();
require("cab_lattes.php");
require("../_class/_class_lattes.php");
$lattes = new lattes;

$ano_ini = round($_SESSION['ano_ini']);
$ano_fim = round($_SESSION['ano_fim']);

	echo '<h1>Produ��o em Peri�dicos Cient�ficos / Docentes e Discentes</h1>';
	echo '<h3>Per�dodo de '.$ano_ini.' at� '.$ano_fim;
	
echo $lattes->grafico_publicacao('','',$ano_ini,$ano_fim);

require("../foot.php");	
?>