<?
$tabela = "pibic_bolsa_contempladas";

$sql = "select pbt_edital, pbt_descricao, count(*) as total, pb_ano, pb_tipo from pibic_bolsa_contempladas ";
$sql .= " left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= " left join pibic_professor on pb_professor = pp_cracha ";
$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= " left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
$sql .= " where (pb_status = 'A') ".$wsql;
$sql .= " group by pb_tipo, pb_ano, pbt_edital, pbt_descricao ";
$sql .= " order by pb_ano desc, pbt_edital, pb_tipo ";
$rlt = db_query($sql);

$sz = "";
$sc = "";
$sp = "";
$tot0 = 0;
$tot1 = 0;
$tot2 = 0;
$ano = "X";
$editalx = "";
while ($line = db_read($rlt))
	{
	$ano = $line['pb_ano'];
	$edital = UpperCase($line['pbt_edital']);

	if ($edital != $editalx)
		{
		if ($tot2 > 0) {
			$sx .= '<TR><TD colspan="4" align="right">Sub-total <I>'.number_format($tot2,0).'</B></TD></TR>';		
		}
		$tot2 = 0;
		/////////////////////////////////////// Separa por ano
		if ($xano != $ano)
			{
			$ano = $line['pb_ano'];
			if ($tot0 > 0) {
				$sx .= '<TR><TD colspan="4" align="right">Total <B>'.number_format($tot0,0).'</B></TD></TR>';		
			}
			
		$tot0 = 0;
		$xano = $ano;
		}

		$sx .= '<TR><TD colspan=5 class=lt3 >'.$ano.' - '.$edital.'</TD></TR>';
		$editalx = $edital;
		$col = 0;
		}

	$link = '<a href="rel_bolsa_aluno.php?dd0='.$line['pb_tipo'].'&dd1='.$pb_tipo.'&dd2='.$ano.'">';
	$bolsa = $line['pb_tipo'];
	$total = $line['total'];
	$bolsa_descricao = '';
	
	$bolsa_descricao = $line['pbt_descricao'];

	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>';
	$sx .= $bolsa;
	$sx .= '</TD>';
	$sx .= '<TD>';
	$sx .= '<font color="#0000ff">';
	$sx .= UpperCase($line['pbt_edital']);
	$sx .= '<TD>';
	$sx .= $link;
	$sx .= $bolsa_descricao;
	$sx .= '</TD>';
	$sx .= '<TD align="right">';
	$sx .= number_format($total,0);
	$sx .= '</TD>';
	$sx .= '</TR>';
	$tot0 = $tot0 + $total;
	$tot2 = $tot2 + $total;
	$tot1++;
	}
$sx .= '<TR><TD colspan="4" align="right">Sub-total <I>'.number_format($tot2,0).'</B></TD></TR>';		

echo '<BR><BR>';
echo '<CENTER><font class="lt4">Bolsas Implementadas</font></CENTER>';
echo '<table border="0" width="650" align="center" class="lt0">';
echo '<TR><TH>C</TH><TH>Edital</TH><TH>Bolsa</TH><TH>Total</TH></TR>';
echo $sx;
echo '<TR><TD colspan="4" align="right">Total <B>'.number_format($tot0,0).'</B></TD></TR>';
echo '</table>';
?>