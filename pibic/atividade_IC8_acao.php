<?
require("cab_pibic.php");

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

require('../_class/_class_ic_relatorio_final.php');
$rp = new ic_relatorio_final;

require('_ged_config.php');

$ged->protocol = $dd[0];
$pb->le('',$dd[0]);

echo $pb->mostar_dados();

$data_rp = round($pb->pb_rf_nota_correcao);

if ($data_rp <= 2)
	{
		if (date("Ymd") > 20130829)
			{
				
				echo $rp->form2($ged);
			} else {
				echo $rp->form2($ged);
			}
	} else {
		echo '<BR><BR>';
		echo '<H1>Relatório já entregue</H1>';
	}

require("../foot.php");
?>