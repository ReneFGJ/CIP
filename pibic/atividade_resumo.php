<FIELDSET><legend>Abstract</legend>
	<div class="lt2">
Prezados orientadores,
<BR><BR>
Com o objetivo de internacionalização e maior visibilidade das 
pesquisas na PUCPR será necessária, a partir deste ano, a submissão do resumo e das 
palavras-chave em Inglês. <BR><BR>Esta submissão não será feita neste 
momento, <B>somente após aprovação</B> do resumo em português será solicitado 
via sistema o <I>abstract</I> em <B>Inglês</B> e suas <I>keywords</I>. 
	<BR><BR>
	Coordialmente,
	<BR>PIBIC
	</div>
</FIELDSET>
<?
$ss = '<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">';
$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Próximas atividades - Resumo e Abstract</font></B>&nbsp;</legend>';

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where pb_professor = '".$id_pesq."' ";
//$sql .= " and pb_resumo = 0 ";
$sql .= " and (pb_status <> '@' and pb_status <> 'C' and pb_status <> 'F')";
$sql .= " and pb_ano = '".(date("Y")-1)."' ";
$sql .= " order by pa_nome";
$SQL .= " limit 10 ";
$rlt = db_query($sql);

$ss .= '<TABLE width="100%" class="lt1" border="0">';
$ss .= '<TR><TD>';
$ss .= '<font color="red">Prazo de 06/ago./2012 até <B>12/ago./2012</B> as 23h59</font>';
$ss .= '<BR><BR>';
$ss .= 'Clique no plano de trabalho do aluno para submeter atividade.<BR>';
$ss .= '<UL>';

$to = 0;
while ($line = db_read($rlt))
	{
		//print_r($line);
		//echo '<HR>';
	$to++;
	if (round($line['pb_resumo']) < 20100101)
	{
		$ttp = LowerCase($line['pb_titulo_projeto']);
		$ttp = UpperCase(substr($ttp,0,1)).substr($ttp,1,strlen($ttp));	
		$bolsa = $line['pb_codigo'];
		$aluno = $line['pa_nome'];
		$status = $line['pb_status'];
		$link = '<a href="main_atividade_resumo.php?dd0='.trim($line['pb_protocolo']).'&dd1='.$line['id_pb'].'">';
		$ss .= '<LI><B>'.$link.$ttp.'</A></B>';
		$ss .= '<BR>Aluno: '.$aluno;
		$ss .= '<BR>Contrato ativo: '.$bolsa.' ('.$line['pb_tipo'].')';
		$ss .= ' '.$line['doc_edital'].'/'.$line['pb_ano'];
		$ss .= '</LI><BR>';
	}
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
