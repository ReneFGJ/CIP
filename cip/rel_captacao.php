<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));
require("cab_cip.php");

echo '<h1>Relatório</h1>';

require("../_class/_class_captacao.php");
$cap = new captacao;

$d1 = 20100101;
$d2 = date("Ymd");

echo $cap->relatorio_captacao_tabela($d1,$d2);

echo '</div>';
echo '</div>';
require("../foot.php");	
?>