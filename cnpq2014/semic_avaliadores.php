<?php
$include = '../';
require("cab_cnpq.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

$jid = 85; 
echo '<h1>Avaliadores</h1>';

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
		$sx .= '<TR><TH>Código<th>Nome do avaliador<TH>Instituição<TH>Avaliações (P-Pôster, O-Oral)';
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
					$sx .= '<TD class="tabela01" width="10%">';
					$sx .= trim($line['us_codigo']);	
					
					$sx .= '<TD class="tabela01" width="30%">';
					$sx .= trim($nome);		
					$sx .= '<TD class="tabela01" width="30%">';
					$sx .= $line['inst_nome'];
					$sx .= '<TD class="tabela01">';
					$xnome = $nome;
					}
				$sx .= '<nobr>';
				$tot = $line['total'];
				$tp = (trim($line['pp_tipo']));
				if ($tp == 'O') { $to1 = $to1 + $tot; }
				else { $to2 = $to2 + $tot; } 
				if ($tot > 0)
					{
					$sx .= $line['total'];
					$sx .= ' ('.trim($line['pp_tipo']).')';
					} else {
						//$sx .= '<font color="gray">n/a</font>';
					}
			}
		$sx .= '<TR class="lt2"><TD colspan=5>Total de avaliadores: '.$it.', com '.$to.' avaliações!';
		$sx .= '<BR>Pôster: '.$to2.', Oral: '.$to1;
		$sx .= '</table>';
		echo $sx;
		
		
?>