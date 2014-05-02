<?
require("cab_pibic.php");

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

require('../_class/_class_ic_relatorio_parcial.php');
$rp = new ic_relatorio_parcial;

require('_ged_config.php');

$ged->protocol = $dd[0];
$pb->le('',$dd[0]);

echo $pb->mostar_dados();

echo '<h3>';
echo '<center>Em Manutenção</center>';
echo '</h3>';
$semic_valida = $pb->semic_valida;

if ($semic_valida < 20100101)
	{
		if (date("Ymd") > 20130701)
			{
				echo $rp->prazo_encerrado();
				echo $rp->semic_crp($ged);
			} else {
				echo $rp->semic_crp($ged);
			}
	} else {
		echo '<BR><BR>';
		echo '<H1>Validação já realizada</H1>';
	}

require("../foot.php");
?>