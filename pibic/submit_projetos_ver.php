<?
require("cab.php");
require("cab_main.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
$protocolo = $dd[0];
?>
<style>
DIV {
	background : #ffffff;
	border : none;
}
</style>

<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left">
<?
//$sql = "update ".$tdoc." set doc_tipo ='00001'";
//$rlt = db_query($sql);
$sql = "select * from ".$tdoc." ";
$sql .= " where doc_autor_principal ='".strzero($id_pesq,7)."' ";
$sql .= " and doc_protocolo = '".$dd[0]."' ";
$sql .= " order by doc_dt_atualizado ";

$qrlt = db_query($sql);
if ($line = db_read($qrlt))
	{
	$protocolo = $line['doc_protocolo'];
//	print_r($line);
	$sta = trim($line['doc_status']);
	setcookie("prj_proto",$line['doc_protocolo'],time()+60*60*60);
	setcookie("prj_tipo",$line['doc_tipo'],time()+60*60*60);
	setcookie("prj_nr",$line['doc_id'],time()+60*60*60);
//	$link = 'submit_phase_2.php?dd1='.trim($line['doc_tipo']).'&dd98=1&dd0='.trim($line['doc_protocolo']);
//	$link .= '&dd3='.$line['doc_id'];
	$tipo = trim($line['doc_tipo']);
	if ($tipo == '00014') { $link = '<A HREF="submit_phase_2_pibic_sel.php?dd0='.$line['doc_protocolo'].'&dd5='.$line['doc_tipo'].'&dd1=00014&dd3=&dd98=1&dd3='.$line['doc_id'].'">'; }
	if ($tipo == '00041') { $link = '<A HREF="submit_phase_2_pibiti_sel.php?dd0='.$line['doc_protocolo'].'&dd5='.$line['doc_tipo'].'&dd1=00041&dd3=&dd98=1&dd3='.$line['doc_id'].'">'; }

	if ($tipo == '00014') { $link2 = 'submit_cancelar_pibic.php?dd1='.trim($line['doc_tipo']).'&dd98=1&dd0='.trim($line['doc_protocolo']); }
	if ($tipo == '00041') { $link2 = 'submit_cancelar_pibiti.php?dd1='.trim($line['doc_tipo']).'&dd98=1&dd0='.trim($line['doc_protocolo']); }
	$link2 .= '&dd3='.$line['doc_id'];

if ($submissao_aberta == true)
	{
	if ($sta == '@')
		{
		echo $link.'<img src="img/bt_editar_off.png" width="164" height="32" alt="" border="0"></a>';
		echo '&nbsp;&nbsp;';
		echo '<a href="'.$link2.'"><img src="img/bt_cancelar_off.png" width="164" height="32" alt="" border="0"></a>';
		}
	}
	
	if ($sta == 'C')
		{
		echo 'PROTOCOLO FINALIZADO';
		$tipo_doc = '00004';
		require("submit_projetos_ver_arquivos.php");
		}		
	echo '<BR><BR>';
	if ($tipo == '00014')
		{
		require("submit_pibic_resumo.php");
//		require("submit_pibic_resumo_1.php");
//		require("submit_pibic_resumo_2.php");
		}
	if ($tipo == '00041')
		{
		require("submit_pibiti_resumo.php");
//		require("submit_pibiti_resumo_1.php");
//		require("submit_pibiti_resumo_2.php");
		}
	echo $sr;
exit;
	
	$sql = "select * from ".$tdov." ";
	$sql .= "inner join ".$submit_manuscrito_field." on sub_codigo = spc_codigo ";
	$sql .= "where spc_projeto = '".$dd[0]."' ";
	$sql .= "and sub_ativo = 1 ";
	$sql .= "order by sub_pos,sub_ordem ";
	$xrlt = db_query($sql);
	while ($line = db_read($xrlt))
		{
//		print_r($line);
		$ttt = trim($line['spc_content']);
		if (strlen($ttt) > 1)
			{
			$content = $line['spc_content'];
			$content = troca($content,chr(13),'<BR><BR>');
			echo '<font class="lt0"><B>';
			echo trim($line['sub_descricao']);
			echo '</B></font>';
			echo '<BR>';
			echo '<DIV class="lt1" align="justify"><P>';
			echo mst($content);
			echo '</P></div>';
			echo '<BR>';
			}
		}
	}
?>
<TD width="210">
<? require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_2.php");?>
</table>
<? require("foot.php"); ?>