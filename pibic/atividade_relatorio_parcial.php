<?
$ss = '<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">';
$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Pr�ximas atividades - Entrega Relat�rio Parcial</font></B>&nbsp;</legend>';

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where pb_professor = '".$id_pesq."' ";
//$sql .= " and ((pb_relatorio_final = 0) or (pb_relatorio_final  isnull)) ";
$sql .= " and (pb_status <> '@' and pb_status <> 'C' ) ";
//$sql .= " and pb_ano = '".(date("Y")-1)."' ";
$sql .= " and pb_relatorio_parcial < 20000000 ";
$sql .= " order by pa_nome";
$SQL .= " limit 1000 ";
$rlt = db_query($sql);


$ss .= '<TABLE width="100%" class="lt1" border="0">';
$ss .= '<TR><TD>';
$ss .= '<font color="red">Prazo de 22/fev./2011 at� <B>04/mar./2011</B> as 23h59</font>';
$ss .= '<BR><BR>';
$ss .= 'Clique no plano de trabalho do aluno para submeter atividade.<BR>';
$ss .= '<UL>';

$to = 0;
while ($line = db_read($rlt))
	{
	$to++;
	$bolsa = $line['pb_tipo'];
	require('../pibicpr/bolsa_tipo.php');
//	print_r($line);
//	echo '<HR>';
	$ttp = LowerCase($line['pb_titulo_projeto']);
	$ttp = UpperCase(substr($ttp,0,1)).substr($ttp,1,strlen($ttp));	
	$bolsa = $line['pb_codigo'];
	$aluno = $line['pa_nome'];
	$status = $line['pb_status'];
	$link = '<a href="atividade_relatorio_parcial_acao.php?dd0='.trim($line['pb_protocolo']).'&dd1='.$line['id_pb'].'">';
	$ss .= '<LI><B>'.$link.$ttp.'</A></B>';
	$ss .= '<BR>Aluno: '.$aluno;
	$ss .= '<BR>Contrato ativo: '.$bolsa.' ('.$bolsa_nome.')';
	$ss .= '</LI><BR>';
	}
$ss .= '</UL>';
$ss .= '</TD></TR>';
$ss .= '</table></fieldset>';
$ss .= '</table>';

if ($to > 0)
	{
		echo $ss;
	}
?>
