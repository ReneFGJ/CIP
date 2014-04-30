<?php
require("cab.php");
$ano1 = (date("Y")-1);
$ano2 = date("Y");
//
$sql = "select centro_nome, pp_nome, pb_ano, pp_email, pp_email_1 from pibic_bolsa_contempladas 
		inner join pibic_professor on pb_professor = pp_cracha
		left join centro on pp_escola = centro_codigo
	where
	(pb_ano = '".$ano1."' or pb_ano = '".$ano2."')
	and pb_status <> 'C'
	order by centro_nome, pp_nome, pb_ano
	";
$rlt = db_query($sql);
$xesc = '';
$sx .= '<table class="tabela00">';
while ($line = db_read($rlt))
	{
		$esc = $line['centro_nome'];
		$prof = $line['pp_nome'];
		if ($xesc != $esc)
			{
				$sx .= '<TR><TD colspan=10><h3>'.$esc.'</h3>';
				$xesc = $esc;
			}
		if ($xprof != $prof)
			{
				$sx .= '<TR><TD><NOBR>'.$prof;
				$sx .= '<TD>'.$line['pp_email'];
				$sx .= '<TD>'.$line['pp_email_1'];
				$xprof = $prof;
			}
		$sx .= '<TD align="center">';
		if ($line['pb_ano']==date("Y")) { $sx .= '<font color="blue"><B>'; }
		$sx .= $line['pb_ano'].'</B>';
	}
$sx .= '</table>';
echo $sx;
require('../foot.php');
?>
