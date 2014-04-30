<?php
require("cab.php");
$ano1 = 2009;
$ano2 = date("Y");
//
$wh = '';
for ($r=$ano1;$r <= $ano2; $r++)
	{
		if (strlen($wh) > 0) { $wh .= ' or '; }
		$wh .= "(pb_ano = '".$r."') ";		
	}
$sql = "select centro_nome, pp_nome, pb_ano, pp_email, pp_email_1 from pibic_bolsa_contempladas 
		inner join pibic_professor on pb_professor = pp_cracha
		left join centro on pp_escola = centro_codigo
	where
	($wh)
	and pb_status <> 'C'
	order by centro_nome, pp_nome, pb_ano
	";
$rlt = db_query($sql);
$xesc = '';
$xano = '';
$sx .= '<table class="tabela00">';
while ($line = db_read($rlt))
	{
		$ano = $line['pb_ano'];
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
				$xano = '';
			}
		if ($xano != $ano)
			{
			$sx .= '<TD align="center">';
			if (($xano == '') and ( $ano==(date("Y")-1) )) { $sx .= '<font color="red"><B>'; }
			
			$sx .= $line['pb_ano'].'</B>';
			}
		$xano = $ano;
	}
$sx .= '</table>';
echo $sx;
require('../foot.php');
?>
