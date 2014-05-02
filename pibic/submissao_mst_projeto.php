<?
$nl = chr(13).chr(10);
$sr = '';

$img = 'icone_'.trim(lowercase($line['doc_edital'])).'_prof.png';

$pp_titulo = trim($line['doc_1_titulo']);
$pp_professor = trim($line['pp_nome']);
$pp_lattes = trim($line['pp_lattes']);
$pp_email = trim($line['pp_email']);
$pp_email2 = trim($line['pp_email_2']);
$pp_titulacao = trim($line['ap_tit_titulo']);
$pp_curso = trim($line['pp_curso']);
	
$plano_trabalho_nr = 0;
$plano_trabalho_jr = 0;

$pp_area_2 = "área do conhecimento";
$sx .= '<DIV>';
$sx .= '<fieldset><legend>Projeto do Professor</legend>';
$sx .= '<TABLE width="100%">';
$sx.= $nl . '<CENTER><FONT CLASS="lt4">Resumo do projeto</FONT></CENTER>';
$sx.= $nl . '<TABLE width="'.$tab_max.'" align="center" class="lt2" border=0 >';
$sx.= $nl . '<TR valign="top">';
$sx.= '<TD colspan="3" align="center"><font class="lt5">'.$pp_titulo.'</font></TD></TR>';
$sx.= $nl . '<TR><TD colspan="3" align="right"><font class="lt0">Prof. responsável&nbsp;</font>';
$sx.= $nl . '<font class="lt2">'.$pp_titulacao.'&nbsp;'.$pp_professor.'</font></TD></TR>';
$sx.= $nl . '<TR><TD colspan="3" align="right"><font class="lt0"><font class="lt1">'.$pp_email2.'&nbsp;'.$pp_email.'</font></TD></TR>';
$sx.= $nl . '<TR><TD colspan="3" align="right"><font class="lt0"><A HREF="'.$pp_lattes.'" target="_new"><font class="lt1">'.$pp_lattes.'</A></font></TD></TR>';
$sx.= $nl . '<TR><TD colspan="3" align="right"><font class="lt1">'.$pp_curso.'</font></TD></TR>';

$sx.= $nl . '<TR valign="top">';
$sx.= '<TD rowspan="20" width="60"><img src="../pibicpr2/img/'.$img.'" alt="" border="0"></TD>';
$sx.= '<Th colspan="2" align="center" bgcolor="#E0E0E0"><font class="lt2">Projeto de pesquisa do professor orientador</font></TD></TR>';

///////////////////////////// pROJETO DO PROFESSOR ORIENTADOR
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