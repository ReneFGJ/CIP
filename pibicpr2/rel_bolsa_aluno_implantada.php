<?
require("cab.php");


$tabela = "pibic_bolsa_contempladas";

//$sql = "update pibic_bolsa_contempladas set pb_ano = '2011' where pb_data > 20110800 "; 
//$sql = "select * from pibic_bolsa_contempladas where pb_data > 20100100 "; 
//$rlt = db_query($sql);

//while ($line=db_read($rlt))
//	{
//	echo '<HR>';
//	print_r($line);
//	}

$sql = "select count(*) as total, pb_ano, pb_tipo, pb_edital from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= " where (pb_tipo = 'B' or pb_tipo = 'O' or pb_tipo = 'G' or pb_tipo = 'V' or ";
$sql .= " pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F'  or pb_tipo = 'A' or pb_tipo = 'E'  or pb_tipo = 'U' ";
$sql .= " or pb_tipo = 'J' or pb_tipo = 'L' or pb_tipo = 'H'  ";
$sql .= " ) ";
$sql .= " and (pb_status <> 'C' and pb_status <> '@') ";
//$sql .= " and pb_data_ativacao > 20000000 ";
$sql .= " group by pb_tipo, pb_ano, pb_edital ";
$sql .= " order by pb_ano desc, pb_edital, pb_tipo ";
//$rlt = db_query($sql);

$sql = "select count(*) as total, pb_tipo, pbt_descricao, pbt_edital, pb_ano
	from pibic_bolsa_contempladas 
	left join pibic_bolsa_tipo on pbt_codigo = pb_tipo 
	where (pb_status <> 'C' and pb_status <> '@') 
	and pb_data_ativacao > 20000000 
	
	group by pb_tipo, pbt_descricao, pbt_edital, pb_ano
	order by pb_ano desc, pbt_edital, pb_tipo 
	";	
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

	if (($edital != $editalx) or ($xano != $ano))
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
	
	//require("bolsa_tipo.php");
	
	$bolsa_descricao = $line['pbt_descricao'];

	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>';
	$sx .= $bolsa;
	$sx .= '</TD>';
	$sx .= '<TD align="center">';
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
echo '<TR><TH>C</TH><TH width=50>Edital</TH><TH>Bolsa</TH><TH width=50>Total</TH></TR>';
echo $sx;
echo '<TR><TD colspan="4" align="right">Total <B>'.number_format($tot0,0).'</B></TD></TR>';
echo '</table>';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sql = "select count(*) as total, pb_tipo from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= " where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'A') ";
$sql .= " and pb_status = '@' ";
$sql .= " and pb_data_ativacao < 20000000 ";
$sql .= " group by pb_tipo ";
$rlt = db_query($sql);

$sz = "";
$sc = "";
$sp = "";
$tot0 = 0;
$tot1 = 0;
$sx = '';
while ($line = db_read($rlt))
	{
	$link = '<a href="rel_bolsa_aluno.php?dd0='.$line['pb_tipo'].'&dd1=@&dd2='.$ano.'">';
	$bolsa = $line['pb_tipo'];
	$total = $line['total'];
	$bolsa_descricao = '';
	if ($bolsa == 'P') { $bolsa_descricao = 'Bolsista PUCPR'; }
	if ($bolsa == 'F') { $bolsa_descricao = 'Bolsista Fundação Araucária'; }
	if ($bolsa == 'C') { $bolsa_descricao = 'Bolsista CNPq'; }
	if ($bolsa == 'I') { $bolsa_descricao = 'Bolsista ICV'; }
	if ($bolsa == 'A') { $bolsa_descricao = 'Qualificados'; }
	$sx .= '<TR>';
	$sx .= '<TD>';
	$sx .= $bolsa;
	$sx .= '</TD>';
	$sx .= '<TD>';
	$sx .= $link;
	$sx .= $bolsa_descricao;
	$sx .= '</TD>';
	$sx .= '<TD align="right">';
	$sx .= number_format($total,0);
	$sx .= '</TD>';
	$sx .= '</TR>';
	$tot0 = $tot0 + $total;
	$tot1++;
	}

echo '<BR><BR>';
echo '<CENTER><font class="lt4">Bolsas Implementadas sem efetivação</font></CENTER>';
echo '<table border="0" width="650" align="center" class="lt0">';
echo '<TR><TH>C</TH><TH>Bolsa</TH><TH>Total</TH></TR>';
echo $sx;
echo '<TR><TD colspan="3" align="right">Total <B>'.number_format($tot0,0).'</B></TD></TR>';
echo '</table>';


require("foot.php");	
?>