<?
$include = '../';
require("cab_cnpq.php");

require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');

require("../_class/_class_pibic_projetos_v2.php");
$pj = new projetos;

require("../_class/_class_parecer_pibic.php");
$pp = new parecer_pibic;

$proto = $dd[0];

echo '<CENTER><h1>PARECER</h1></center>';

	$pj->le($proto);
	$line = $pj->line;	
	echo $pj->mostra($line);
	
	echo '<table width="100%">';
	echo '<TR><TD colspan=3><h2>Planos de alunos</h2>';
	echo '<TR><TD colspan=4>';
	echo $pj->mostra_planos_projetos();
	echo '</table>';	
	
	
echo '<CENTER><h1>PARECER</h1></center>';
echo $pp->visualizar_parecer($proto);

?>
