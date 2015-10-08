<?
$breadcrumbs=array();
require("cab_cnpq.php");

require('../_class/_class_docentes.php');

require('../_class/_class_pibic_edital.php');
$ed = new pibic_edital;
$ano = date("Y");

echo '<h1>Edital '.$ano.'</h1>';
echo '<h3>resultado</h3>';

echo $ed->grafico_titulacao($ano,$dd[0],$dd[1]);

echo $ed->edital_resumo_area($ano,$dd[0],$dd[1]);
//echo $ed->edital_resumo($ano,$dd[0],$dd[1]);


require("../foot.php");	
?>