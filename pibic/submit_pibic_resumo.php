<?
$nl = chr(13).chr(10);
$sr = '';

$sql = "select * from ".$tdoc." ";
$sql .= "left join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo = '".$protocolo."' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$pp_titulo = trim($line['doc_1_titulo']);
	$pp_professor = trim($line['pp_nome']);
	$pp_lattes = trim($line['pp_lattes']);
	$pp_email = trim($line['pp_email']);
	$pp_email2 = trim($line['pp_email_2']);
	$pp_titulacao = trim($line['ap_tit_titulo']);
	$pp_curso = trim($line['pp_curso']);
	}
	
$plano_trabalho_nr = 0;
$plano_trabalho_jr = 0;

$pp_area_2 = "área do conhecimento";

$sr .= $nl . '<CENTER><FONT CLASS="lt4">Resumo do projeto - PIBIC</FONT></CENTER>';
$sr .= $nl . '<TABLE width="'.$tab_max.'" align="center" class="lt2" border=0 >';
$sr .= $nl . '<TR valign="top">';
$sr .= '<TD colspan="3" align="center"><font class="lt5">'.$pp_titulo.'</font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt0">Prof. responsável&nbsp;</font>';
$sr .= $nl . '<font class="lt2">'.$pp_titulacao.'&nbsp;'.$pp_professor.'</font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt0"><font class="lt1">'.$pp_email2.'&nbsp;'.$pp_email.'</font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt0"><A HREF="'.$pp_lattes.'" target="_new"><font class="lt1">'.$pp_lattes.'</A></font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt1">'.$pp_curso.'</font></TD></TR>';

$sr .= $nl . '<TR valign="top">';
$sr .= '<TD rowspan="20" width="60"><img src="../pibicpr/img/icone_pibic_prof.png" alt="" border="0"></TD>';
$sr .= '<Th colspan="2" align="center" bgcolor="#E0E0E0"><font class="lt2">Projeto de pesquisa do professor orientador</font></TD></TR>';

///////////////////////////// pROJETO DO PROFESSOR ORIENTADOR
$sql = "select * from ".$tdov." ";
$sql .= " left join ".$submit_manuscrito_field." on spc_codigo  = sub_codigo ";
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
		$sr .= $nl . '<TR '.$xcol.'>';
		$sr .= $nl . '<TD colspan="1" align="right"><font class="lt0">'.$line['sub_descricao'].'</font></TD>';
		$sr .= $nl . '<TD colspan="1" align="left"><font class="lt1"><B>'.$line['spc_content'].'</B></font></TD>';
		$sr .= $nl . '</TR>';
		}
	}
	
////////////////////// ARQUIVOS DO PROJETO
$fl1 = True;
$fl2 = True;
$fl3 = True;

$proto_file = $protocolo;
require('submit_pibic_resumo_arquivos.php');
$sr .= $nl . '<TR><TD colspan="4" bgcolor="#00ffff">'.$sb.'</TD></TR>';
if ($fl == 0) { $fl1 = False; }

if ($ed_acao != false)
	{
	$sr .= $nl . '<TR><TD colspan="4" align="center"><TABLE width="80%" border="0">';
	$sr .= $nl . '  <TR><TD>&nbsp;</TD></TR>';
	$sr .= $nl . '	<TR><TD></TD><TD class="lt0" align="right">';
	$sr .= $nl . '	<TR><TH colspan="2">Cadastrar Planos de trabalho</TH></TR>';
	$sr .= $nl . '	<TR align="center"><TD colspan="1" align="center">';
	
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_pibic_sel.php';

	$sr .= $nl . '	<form action="'.$link.'">';
	$sr .= $nl . '	<input type="submit" name="xb" value=" Cadastrar plano do aluno '.chr(13).chr(10).' PIBIC" style="height:60px; background-color:#e6f2ff;">';
	$sr .= $nl . '	<input type="hidden" name="dd0" value="00015">';
	$sr .= $nl . '	<input type="hidden" name="dd98" value="1">';
	$sr .= $nl . '	</Form></TD>';

	$sr .= $nl . '<TD colspan="1" align="center">';
	
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_pibic_sel.php';
	
	$sr .= $nl . '	<form action="'.$link.'"><input type="submit" name="xb" value=" Cadastrar plano do aluno '.chr(13).chr(10).' PIBIC Jr." style="height:60px; background-color:#e6f2ff;">';
	$sr .= $nl . '	<input type="hidden" name="dd0" value="00016">';
	$sr .= $nl . '	<input type="hidden" name="dd98" value="1">';
	$sr .= $nl . '	</Form></TD>	';
	$sr .= $nl . '	</TR>';
	$sr .= $nl . '</TABLE>';
	}
	

$sr .= $nl . '<TR><TD>&nbsp;</TD></TR>';
$sr .= '</TABLE>';
//<!--- Primeiro plano - Aluno Matriculado --->
require("submit_pibic_resumo_1.php");

//<!--- PIBIC Jr--->
require("submit_pibic_resumo_2.php");

if ($plano_trabalho_nr == 0)
	{
	$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_NEED1' and nw_journal = ".$jid;
	$sql .= " and nw_idioma = '".$idioma_id."'";
	$rrr = db_query($sql);
	$texto = 'SUB_NEED1';
	if ($eline = db_read($rrr)) 
		{
		$texto = mst($eline['nw_descricao']);
		}
	$sr .= $nl . '<TR bgcolor="#ffffff"><TD align="center"><img src="img/icone_alerta.png" width="64" height="64" alt="" border="0"><BR><BR><font class="lt2" color="center"><font color="red"><B>'.$texto.'</font><BR><BR>';
	$sr .= $nl . '</TABLE>';
	echo $sr;
	exit;
	}
	
if ($ed_acao != false)
	{
	require("submit_pibic_checklist.php");
	$sr .= $nl . '<TR><TD colspan="3"><TABLE width="'.$tab_max.'" align="center" class="lt2" border=0 ><TR><TD>';

	$sr .= $nl . $st;
	}
?>