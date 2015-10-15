<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

echo '<h1>'.$dd[1];
echo '</h1>';

if ($dd[1] == 'PIBITI')
	{
		echo '<h2>Bolsas CNPq</h2>';
		echo $pb->semic_mostra_trabalhos($dd[1],date("Y")-1,'B');
		
		echo '<h2>Bolsas Agência PUCPR</h2>';
		echo $pb->semic_mostra_trabalhos($dd[1],date("Y")-1,'G');

		echo '<h2>Bolsas PUCPR</h2>';
		echo $pb->semic_mostra_trabalhos($dd[1],date("Y")-1,'O');

		echo '<h2>Bolsas Iniciação Tecnológica Voluntária</h2>';
		echo $pb->semic_mostra_trabalhos($dd[1],date("Y")-1,'Y');
	} else {
		echo '<h2>Bolsas CNPq</h2>';
		echo $pb->semic_mostra_trabalhos($dd[1],date("Y")-1,'C');
	}

require("../foot.php");	
?>