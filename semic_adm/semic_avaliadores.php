<?php
$include = '../';
require("cab_semic.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

$jid = 85; 

		global $jid;
		$sql = "select * from  pareceristas  ";
		$sql .= " inner join instituicao on us_instituicao = inst_codigo ";
		$sql .= " left join (
				select pp_avaliador, count(*) as total, pp_tipo
				from semic_parecer_2014
				where pp_status <> '@' and pp_status <> 'X'
				group by pp_avaliador, pp_tipo
		) as tabela02 on us_codigo = pp_avaliador ";
		$sql .= " where us_journal_id = ".$jid;;
		$sql .= " and us_ativo = 1 ";
		$sql .= " order by us_nome ";
		
		$rlt = db_query($sql);
		$sx = '<table>';
		$it = 0;
		$to = 0;
		$to1 = 0;
		$to2 = 0;
		while ($line = db_read($rlt))
			{
				$nome = UpperCaseSql($line['us_nome']);
				$it++;
				$to = $to + $line['total'];
				if ($nome != $xnome)
					{
					$sx .= '<TR>';
					$sx .= '<TD width="10%">';
					$sx .= trim($line['us_codigo']);	
					
					$sx .= '<TD width="30%">';
					$sx .= trim($nome);		
					$sx .= '<TD width="30%">';
					$sx .= $line['inst_nome'];
					$xnome = $nome;
					}
				$sx .= '<TD><nobr>';
				$tot = $line['total'];
				$tp = (trim($line['pp_tipo']));
				if ($tp == 'O') { $to1 = $to1 + $tot; }
				else { $to2 = $to2 + $tot; } 
				if ($tot > 0)
					{
					$sx .= $line['total'];
					$sx .= ' ('.trim($line['pp_tipo']).')';
					} else {
						$sx .= '<font color="red">sem avaliador</font>';
					}
			}
		$sx .= '<TR><TD colspan=5>Total de avaliação '.$it.' - '.$to;
		$sx .= '<BR>Pôster: '.$to2.', Oral: '.$to1;
		$sx .= '</table>';
		echo $sx;
		
		$sql = "select * from semic_parecer_2014
					inner join pareceristas on us_codigo = pp_avaliador 
					where pp_status <> '@' and pp_status <> 'X' 
					and (pp_protocolo like 'MEDV%' or pp_protocolo like 'CTA%' or pp_protocolo like 'FLORE%'  or pp_protocolo like 'AGRO%')
					order by pp_protocolo
					";
					
		$rlt = db_query($sql);
		$sx = '';
		$sx .= '<TABLE width="100%">';
		$sx .= '<TR><TD><B>Código<TD><B>Avaliador<TD><B>Nota';
		while ($line = db_read($rlt))
			{
				$nota = $line['pp_nota']+$line['pp_fc'];
				if ($nota > 100)
					{
						$nota = 100;
					}
				$sx .= '<TR>';
				$sx .= '<TD>';
				$sx .= $line['pp_protocolo'];
				$sx .= '<TD>';
				$sx .= $line['us_nome'];
				$sx .= '<TD align="right">';
				$sx .= number_format($nota,1);						
			}
		$sx .= '</TABLE>';
		echo $sx;
?>