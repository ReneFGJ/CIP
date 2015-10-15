<?php
$include = '../';
require("cab_cnpq.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

$jid = 85; 

$sql = "select * from semic_parecer_2014
					inner join pareceristas on us_codigo = pp_avaliador 
					where pp_status <> '@' and pp_status <> 'X' 				
					order by pp_protocolo
					";
				
//and (pp_protocolo like 'MEDV%' or pp_protocolo like 'CTA%' or pp_protocolo like 'FLORE%'  or pp_protocolo like 'AGRO%')					
		$rlt = db_query($sql);
		$sx = '<H1>Nota dos avaliadores por trabalho</h1>';
		$sx .= '<TABLE width="100%">';
		$sx .= '<TR><TD><B>Código<TD><B>Avaliador<TD><B>Nota<TH><B>Fator de Correção<TH><B>Nota final';
		$tot = 0;
		while ($line = db_read($rlt))
			{
				$tot++;
				$nota = $line['pp_nota'];
				if ($nota > 100)
					{
						$nota = 100;
					}
				if ($nota < 0) { $nota = 0; }
				$sx .= '<TR>';
				$sx .= '<TD>';
				$sx .= $line['pp_protocolo'];
				$sx .= '<TD>';
				$sx .= $line['us_nome'];
				$sx .= '<TD align="right">';
				$sx .= number_format($nota,1);
				$sx .= '<TD align="right">';
				$sx .= number_format($line['pp_fc'],1);						
				$sx .= '<TD align="right">';
				$sx .= number_format($line['pp_fc']+$line['pp_nota'],1);						
			}
		$sx .= '<TR><TD span=5>'.$tot;
		$sx .= '</TABLE>';
		echo $sx;
		
?>