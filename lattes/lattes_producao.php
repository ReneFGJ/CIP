<?
$breadcrumbs=array();
require("cab_lattes.php");
require("../_class/_class_lattes.php");
$lattes = new lattes;

$ano_ini = round($_SESSION['ano_ini']);
$ano_fim = round($_SESSION['ano_fim']);

	echo '<h1>Produção em Periódicos Científicos / Docentes e Discentes</h1>';
	echo '<h3>Perídodo de '.$ano_ini.' até '.$ano_fim;
	
echo $lattes->grafico_publicacao('','',$ano_ini,$ano_fim);

require("../foot.php");	
?>