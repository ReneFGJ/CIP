<?
$include = '../';
require("cab_pibic.php");

require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');

require("../_class/_class_pibic_projetos.php");
$pj = new pibic_projetos;

require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

$proto = $dd[0];

echo '<CENTER><h1>PARECER</h1></center>';
echo $pj->mostra_dados_projeto($proto);
echo '<CENTER><h1>PARECER</h1></center>';
echo $pp->visualizar_parecer($proto);

?>
