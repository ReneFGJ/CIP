<?
$img = 'icone_'.trim(lowercase($line['doc_edital'])).'.png';
echo $img;
$nl = chr(13).chr(10);
$sr = '';

$sx .= '<DIV>';
$sx .= '<fieldset><legend>Plano de trabalho do aluno</legend>';
$sx .= '<TABLE width="100%">';
$sx.= $nl . '<CENTER><FONT CLASS="lt4">Resumo do projeto</FONT></CENTER>';
$sx.= $nl . '<TABLE width="'.$tab_max.'" align="center" class="lt2" border=0 >';

$sx.= $nl . '<TR valign="top">';
$sx.= '<TD rowspan="20" width="60"><img src="../pibicpr2/img/'.$img.'" alt="" border="0"></TD>';
$sx.= '<Th colspan="2" align="center" bgcolor="#E0E0E0"><font class="lt2">Plano de trabalho do aluno</font></TD></TR>';

$sql = "select * from pibic_submit_documento_valor ";
$sql .= " left join submit_manuscrito_field on spc_codigo  = sub_codigo ";
$sql .= " where spc_projeto = '".$protocolo."' ";
$sql .= " order by sub_pag,sub_ordem,sub_pos ";

$rlt = db_query($sql);
$dx=90;
while ($line = db_read($rlt))
	{
	$vlr = trim($line['spc_content']);
	$CPID = trim($line['sub_id']);
	$dd[$dx] = $vlr;
	$xcol = '';
	if (strlen($vlr) > 0)
		{
		if ($ed_acao != false) { $xcol = coluna(); }
		require("submit_phase_2_fields.php");
		$sx .= $nl . '<TR '.$xcol.'>';
		$sx .= $nl . '<TD colspan="1" align="right"><font class="lt0">'.$line['sub_descricao'].'</font></TD>';
		$sx .= $nl . '<TD colspan="1" align="left"><font class="lt1"><B>'.$line['spc_content'].'</B></font></TD>';
		$sx .= $nl . '<TD colspan="1" align="left"><font class="lt1"><font color="white">'.$line['spc_codigo'].'</B></font></TD>';
		$sx .= $nl . '</TR>';
		}
	}
	
////////////////////// ARQUIVOS DO PROJETO
$sx .= '</TABLE>';

if ($mostra_arquivos != 'NAO')
	{ require("submissao_mst_arquivos.php"); }
$sx .= '</fieldset>';
$sx .= '</DIV>';
?>