<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_pibic_projetos_v2.php");
$pb = new projetos;
$ano = $dd[0];
if (strlen($ano) == 0) { $ano = date("Y"); }
echo '<h1>Demanda Iniciação Científica '.$ano.'</h3>';

echo $pb->demandas($ano);

require("../foot.php");	
?>