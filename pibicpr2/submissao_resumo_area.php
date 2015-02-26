<?php
require("cab.php");

//require('../_class/_class_pibic_projetos.php');
require("../_class/_class_pibic_projetos_v2.php");
$pj = new projetos;

$ano = '2014';

$sql = "select substr(pj_area,1,1) as pj_area from ".$pj->tabela." 
		inner join pibic_submit_documento on pj_codigo = doc_protocolo_mae
		inner join ajax_areadoconhecimento on pj_area = a_cnpq
		where pj_ano = '$ano' and doc_status <> 'X'
		
		order by pj_area
		";
$rlt = db_query($sql);

$areas = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
$tot = 0;
while ($line = db_read($rlt))
{
	$tot = $tot + 1;
	$area = substr($line['pj_area'],0,1);
	$area = round($area);
	$areas[$area] = $areas[$area] + 1;
}
echo '<table width="500" cellpadding=0 border=1>';
echo '<TR><TD>1. Ciências Exatas e da Terra<TD align="right">'.$areas[1];
echo '<TR><TD>2. Ciências Biológicas<TD align="right">'.$areas[2];
echo '<TR><TD>3. Engenharias<TD align="right">'.$areas[3];
echo '<TR><TD>4. Ciências da Saúde<TD align="right">'.$areas[4];
echo '<TR><TD>5. Ciências Agrárias<TD align="right">'.$areas[5];
echo '<TR><TD>6. Ciências Sociais Aplicadas<TD align="right">'.$areas[6];
echo '<TR><TD>7. Ciências Humanas<TD align="right">'.$areas[7];
echo '<TR><TD>8. Lingüística, Letras e Artes<TD align="right">'.$areas[8];
echo '<TR><TD>9. Outros<TD align="right">'.$areas[9];
echo '<TR><TD>Total<TD align="right">'.$tot;
echo '</table>';
print_r($areas);
?>
