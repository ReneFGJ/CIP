<?
if ($dd[0] == '@') { $tit_status = "Protocolos em submissão"; }
?>
<TABLE align="center" width="100%" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt1">
<font class="lt1"><BR>
<h3><?=$tit_status;?></h3>
<?
$sql = "select * from ".$tdoc." ";
$sql .= " inner join submit_manuscrito_tipo on doc_tipo = sp_codigo";
$sql .= " where doc_autor_principal ='".strzero($id_pesq,7)."' ";
$sql .= " and doc_status = '@' ";
$sql .= " and doc_journal_id = '".strzero($jid,7)."'";
$sql .= " and (doc_tipo = '00014' or doc_tipo = '00041')";
$sql .= " order by doc_dt_atualizado ";
$rlt = db_query($sql);

$ccc= '<font class="lt5">Projetos em submissão</font><BR>';
while ($line = db_read($rlt))
	{
	echo $ccc;
	$ccc = '';
	$tipo = $line['sp_codigo'];
	
	if ($tipo == '00014')
		{ $link = '<A HREF="submit_phase_2_pibic_sel.php?dd0='.$line['doc_protocolo'].'&dd1=00014&dd3=&dd98=1&dd3='.$line['doc_id'].'&dd5='.$line['doc_tipo'].'">'; }
	if ($tipo == '00041')
		{ $link = '<A HREF="submit_phase_2_pibiti_sel.php?dd0='.$line['doc_protocolo'].'&dd1=00014&dd3=&dd98=1&dd3='.$line['doc_id'].'&dd5='.$line['doc_tipo'].'">'; }
//	$autores = trim($line['doc_']);
//  http://www2.pucpr.br/reol/pibic/submit_phase_2.php?dd1=00014&dd98=1&dd0=0001063&dd3=FC1357F62D3EBB10BC0E
	echo '<B>';
	echo $link;
	echo '<font class="lt3">';
	echo trim($line['doc_1_titulo']);
	if (strlen(trim($line['doc_1_subtitulo'])) > 0)
		{ echo UpperCase(trim($line['doc_1_subtitulo'])); }
	echo '</font>';
	echo '</A>';
	echo ' </B><font class="lt0"><BR>('.$line['sp_descricao'].')';
	echo '</B>';
	echo '<BR>';
	echo '<font class="lt0">';
	echo stodbr($line['doc_data']);
	$subm = trim($line['doc_protocolo']);
	$prot = trim($line['doc_cep']);
	if (strlen($subm) > 0) { echo ', controle nº '.$subm; }
	if (strlen($prot) > 0) { echo ', protocolo do CEP nº '.$prot; }
	//echo ' &nbsp;&nbsp;versão '.trim($line['doc_versao']);
	echo '</font>';
	echo '<BR>';
	echo '<BR>';
	}
?>
</table>
