<?php
require('cab_cip.php');
require('../_class/_class_docentes.php');
$dc = new docentes;

echo $dc->sobre_corpo_docente();
$rlt = $dc->rel_prof_produtividade_total();
$tipos = $dc->produtividade();

$sx = '';
$sx .= '<h2>Bolsistas Produtividade</h2>';
$sx .= '<table width="400" class="lt2">';
$sx .= '<TR><TH class="tabela01">Tipo de bolsa<TH class="tabela01">Total';
$tot = 0;
while ($line = db_read($rlt))
	{
		$tot = $tot + $line['total'];
		$tp = round($line['pp_prod']);
		
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01">'.$tipos[$tp];
		$sx .= '<TD class="tabela01" align="center">'.$line['total'];
	}
$sx .= '<TR><TD colspan=2>Total '.$tot;
$sx .= '</table>';
echo $sx;


require("../foot.php");
?>
