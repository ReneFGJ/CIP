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

$data_rp = round($pb->pb_rp);

if ($data_rp < 20151001)
	{
			$file = "__submit_RPAR.php";
			$open = 0;
			if (file_exists($file)) { require($file); }
			if ($open == 1)
				{
					echo $rp->form($ged);
				} else {
					
				}
	} else {
		echo '<BR><BR>';
		echo '<H1>Relatório já entregue</H1>';
	}

require("../foot.php");
?>