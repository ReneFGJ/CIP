<?
require("cab.php");

if (strlen($dd[1]) == 0) { $dd[1] = date("Y")-1; }

$sql = "select substr(bh_historico,38,8) as a1, substr(bh_historico,52,8) as a2, ";
$sql .= " aa1.pa_nome as na1, aa2.pa_nome as na2, ";
$sql .= " * from pibic_bolsa_historico ";
$sql .= " inner join pibic_bolsa_contempladas on bh_protocolo = pb_protocolo ";
$sql .= " left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
$sql .= " left join pibic_professor on pb_professor = pp_cracha ";
$sql .= " left join pibic_aluno as aa1 on substr(bh_historico,38,8) = aa1.pa_cracha ";
$sql .= " left join pibic_aluno as aa2 on substr(bh_historico,52,8) = aa2.pa_cracha ";
$sql .= " where ";
$sql .= " bh_historico like '%troca de aluno de%' ";
//$sql .= " and pb_tipo = 'F' and  ";
$sql .= " and doc_ano = '".$dd[1]."' ";
$sql .= " and pb_status <> 'C' ";
$sql .= " order by na2, doc_edital, bh_data ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
//	print_r($line);
//	exit;
	$bolsa = $line['pb_tipo'];
	require("bolsa_tipo.php");

	

	$sx .= '<TR bgcolor="#c0c0c0"><TD align="right">Histórico<TD colspan=4 ><B>'.$line['bh_historico'].'</TD>';

	$sx .= '<TR><TD align="right">Aluno incluso<TD colspan=2 ><B>'.$line['na2'].'('.$line['a2'].')</TD>';
	$sx .= '<TD align="right">Data substituição</TD><TD colspan=2 >'.stodbr($line['bh_data']).'</TD></TR>';

	$sx .= '<TR><TD align="right">Substituto de<TD colspan=2>'.$line['na1'].'('.$line['a1'].')</TD>';
	$sx .= '<TD align="right">Orientador</TD><TD colspan=2 >'.$line['pp_nome'].'</TD></TR>';

	$sx .= '<TR>';
	$sx .= '<TD align="center" colspan="3"><B>';
	$sx .= ($line['doc_ano']);
	$sx .= '</B>&nbsp;Edital/Protocolo ';
	$sx .= ($line['doc_edital']);
	$sx .= '/';
	$sx .= trim($line['bh_protocolo']);
	
	$sx .= '<TD align="right">Tipo de bolsa</TD><TD>';
	$sx .= $bolsa_nome;

	$sx .= '<TR><TD align="right">Título do projeto:</TD><TD colspan=4>'.$line['pb_titulo_projeto'].'</TD></TR>';
	
	$sx .= '<TR>';
	$sx .= '<TD>';
	$sx .= '&nbsp;';
	$sx .= '</TR>';
	}
?>
<BR>
<font class="lt5">
<center>Relatório de Substituições - Ano <?=$dd[1];?></center>
</font>
<BR>
<table width="<?=$tab_max;?>" align="center" class="lt1" border=1 >
<TR>
	<TH>Ano</TH>
	<TH>Aluno</TH>
	<TH>Data da substituição</TH>
	<TH>&nbsp;</TH>
	<TH>&nbsp;</TH>
<?=$sx;?>
</table>
<?

require("foot.php");
?>