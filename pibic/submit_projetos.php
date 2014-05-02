<?
require("cab.php");
require("cab_main.php");
require($include."sisdoc_data.php");

if ($dd[0] == '@') { $tit_status = "Protocolos em submissão"; }
if ($dd[0] == 'A') { $tit_status = "Protocolos submetidos"; }
if ($dd[0] == 'B') { $tit_status = "Protocolos em Análise"; }
if ($dd[0] == 'C') { $tit_status = "Protocolos Concluídos"; }
if ($dd[0] == 'E') { $tit_status = "Protocolos Concluídos (submissão)"; }


?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt1">
<font class="lt1"><BR>
<h1><?=$tit_status;?></h1>
<?
$sql = "select * from ".$tdoc." ";
$sql .= " inner join submit_manuscrito_tipo on doc_tipo = sp_codigo";
$sql .= " where doc_autor_principal ='".strzero($id_pesq,7)."' ";
$sql .= " and doc_status = '".$dd[0]."' ";
$sql .= " and doc_journal_id = '".strzero($jid,7)."'";
$sql .= " and (doc_tipo = '00014' or doc_tipo = '00041') ";
$sql .= " and doc_protocolo_mae = '' ";
$sql .= " order by doc_ano desc, doc_1_subtitulo, doc_dt_atualizado ";
$rlt = db_query($sql);
$xano = "1900";
while ($line = db_read($rlt))
	{
	$link = '<A HREF="submit_projetos_ver.php?dd0='.$line['doc_protocolo'].'">';
//	$link = '<A HREF="submit_phase_2_sel.php?dd0='.$line['doc_protocolo'].'&dd1=00014&dd3=&dd98=1&dd3='.$line['doc_id'].'">';
	
	$ano = $line['doc_ano'];
	if ($ano != $xano)
		{
		echo '<HR><font class="lt5">'.$ano.'</font><HR>';
		$xano = $ano;
		}
		
//	$autores = trim($line['doc_']);
	if (trim($line['doc_tipo']) == '00015') { echo '<img src="img/bar_space.gif" width="36" height="48" alt="" align="left">'; }
	if (trim($line['doc_tipo']) == '00016') { echo '<img src="img/bar_space_jr.gif" width="36" height="48" alt="" align="left">'; }
	
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
<TD width="210">
<? require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_2.php");?>
</table>
<? require("foot.php"); ?>