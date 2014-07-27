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

$data_rp = round($pb->pb_rf);

if ($data_rp < 20100101)
	{
		if (date("Ymd") > 20140729)
			{
				echo $rp->prazo_encerrado();
				echo $rp->form($ged);
			} else {
				echo $rp->form($ged);
			}
	} else {
		echo '<BR><BR>';
		echo '<H1>Relatório já entregue</H1>';
	}

require("../foot.php");
?>