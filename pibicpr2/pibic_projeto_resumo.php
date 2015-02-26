<?
$nl = chr(13).chr(10);
$tdoc = "pibic_submit_documento";
$tdov = "pibic_submit_documento_valor";
$tdoco = "submit_documentos_obrigatorio";
$cdoc = "pibic_submit_sub_orcamento";
$submit_manuscrito_field = "submit_manuscrito_field";
$submit_manuscrito_tipo = "submit_manuscrito_tipo";

$aprovado_externo = False;
$nr = 20;

$ged_files ="pibic_ged_files";

$sr = '';
$sql = "select * from ".$tdoc." ";
$sql .= "left join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo = '".$protocolo."' ";
$rlt = db_query($sql);

$log_protos = array();
array_push($log_protos,$protocolo);

if ($line = db_read($rlt))
	{
	$pp_titulo = trim($line['doc_1_titulo']);
	$estrategica = trim($line['doc_estrategica']);
	if (strlen($estrategica)==0) {$estrategica = 'N'; }
	$pp_professor = trim($line['pp_nome']);
	$pp_lattes = trim($line['pp_lattes']);
	$pp_email = trim($line['pp_email']);
	$pp_email2 = trim($line['pp_email_2']);
	$pp_titulacao = trim($line['ap_tit_titulo']);
	$pp_curso = trim($line['pp_curso']);
	$pp_edital = $line['doc_edital'];
	$pp_ano = $line['doc_ano'];

	}

$plano_trabalho_nr = 0;
$plano_trabalho_jr = 0;

$pp_area_2 = "área do conhecimento";

$sr .= $nl. '<form method="post" action="parecerista_parecer.php">';
$sr .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
$sr .= '<input type="hidden" name="dd1" value="'.$dd[1].'">';
$sr .= '<input type="hidden" name="dd2" value="'.$dd[2].'">';
$sr .= '<input type="hidden" name="dd3" value="'.$dd[3].'">';

$sr .= '<TABLE width="'.$tab_max.'" class="lt1" border="0">';
$sr .= $nl. '<TR><TD colspan="4" class="lt2">'.$pergunta.'</TD></TR>';

if ($parecer != true) { $sr .= $nl . '<TR><TD colspan="4"><CENTER><FONT CLASS="lt4">Resumo do projeto</FONT></CENTER>';}

$sr .= $nl . '<TR><TD colspan="3" align="center"><font class="lt5"><font style="font-size:22px;">'.$pp_titulo.'</font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt0">Prof. responsável&nbsp;</font>';
$sr .= $nl . '<font class="lt2">'.$pp_titulacao.'&nbsp;'.$pp_professor.'</font></TD></TR>';
//$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt0"><font class="lt1">'.$pp_email2.'&nbsp;'.$pp_email.'</font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt0"><A HREF="'.$pp_lattes.'" target="_new"><font class="lt1">'.$pp_lattes.'</A><img src="img/icone_lattes.gif" width="20" height="20" alt="" border="0"></font></TD></TR>';
$sr .= $nl . '<TR><TD colspan="3" align="right"><font class="lt1">'.UpperCase(substr($pp_curso,0,1)).substr($pp_curso,1,strlen($pp_curso)).'</font></TD></TR>';

//////////////////////////// Bloquear acesso ao projeto
if ($bloqueado != true)
{

$sr .= $nl . '<TR><Th colspan="3" align="center" bgcolor="#E0E0E0"><font class="lt2">Projeto de pesquisa do professor orientador</font></TD></TR>';

///////////////////////////// pROJETO DO PROFESSOR ORIENTADOR
$sql = "select * from ".$tdov." ";
$sql .= " left join ".$submit_manuscrito_field." on spc_codigo  = sub_codigo ";
$sql .= " where spc_projeto = '".$protocolo."' ";
$sql .= " order by sub_pag,sub_ordem,sub_pos ";

$rlt = db_query($sql);
$dx=90;
$row = 0;
$idcp = 20;
$projeto_externo = '';
$projeto_fomento = '';
$sr .= '<TABLE width="'.$tab_max.'" class="lt1" border="0">';
while ($line = db_read($rlt))
	{
	$vlr = trim($line['spc_content']);
	$CPID = trim($line['sub_id']);
	$dd[$dx] = $vlr;
	if (strlen($vlr) > 0)
		{
//		require("submit_phase_2_fields.php");
		if ($row == 0)
			{
					$sr .= $nl . '<TR valign="top">';
					$sr .= $nl . '<TD rowspan="20" align="right" width="74"><img src="'.$link_ad.'img/icone_'.lowercase($pp_edital).'_prof.png" width="74" height="114" alt="">';
					if ($estrategica == 'S')
						{ $sr .= $nl . '<BR><img src="img/icone_estrategica.png" width="74" height="16" alt="" border="0">'; }
			} else {
					$sr .= $nl . '<TR '.coluna().'>';
			}
		$row++;
		$codspc = trim($line['spc_codigo']);
		
		if ($user_log == 'rene')
			{
			$links = '<A HREF="#" onclick="newxy2('.chr(39).'ed_edit.php?dd0='.$line['id_spc'].'&dd99=pibic_submit_documento_valor'.chr(39).',500,400);">';
			}
					
//		if ($codspc != '00044')
			{
			$sr .= $nl . '<TD colspan="1" align="right" width="25%"><font class="lt0">'.$line['sub_descricao'].'</font></TD>';
			$sr .= $nl . '<TD colspan="1" align="left"><font class="lt1"><B>'.$links.$vlr.'</B></font></TD>';
//			$sr .= $nl . '<TD colspan="1" align="left"><font class="lt1"><B>'.$links.$codspc.'</B></font>';
			}
		
		///// Área Estratégica
		if ($codspc == '00198') { $area_estrategicao = trim($line['spc_content']); }
		if ($codspc == '00677') { $area_estrategicao = trim($line['spc_content']); }

		if ($codspc == '00045') { $projeto_externo = trim($line['spc_content']); }
		if ($codspc == '00047') { $projeto_fomento = trim($line['spc_content']); }
////		echo '<BR>'.$codspc.'='.$line['spc_content'];
		//////////////////////////////////////////////////// estratégica
		if (trim($codspc) == '00198') 
			{
			$vlr = substr(trim($vlr),0,12);
			if ((trim($vlr) != '9.00.00.00-X') and ($estrategica != 'S'))
				{ 
					$sql = "update pibic_submit_documento set doc_estrategica = 'S' ";
					$sql .= " where doc_protocolo = '".$protocolo."' or doc_protocolo_mae = '".$protocolo."' ";
					$estrategica = 'S';
					$rlt = db_query($sql);
				}
			if ((trim($vlr) == '9.00.00.00-X') and ($estrategica != 'S'))
				{ 
					$sql = "update pibic_submit_documento set doc_estrategica = 'N' ";
					$sql .= " where doc_protocolo = '".$protocolo."' or doc_protocolo_mae = '".$protocolo."' ";
					$estrategica = 'N';
					$rlt = db_query($sql);
				}
			}
			////////////////////////////////////////////////////////////////////////////////////////
			if (trim($codspc) == '00677') 
			{
			$vlr = substr(trim($vlr),0,12);
			if ((substr(trim($vlr),0,4) != '9.00') and ($estrategica != 'S'))
				{ 
					$sql = "update pibic_submit_documento set doc_estrategica = 'S' ";
					$sql .= " where doc_protocolo = '".$protocolo."' or doc_protocolo_mae = '".$protocolo."' ";
					$estrategica = 'S';
					$rlt = db_query($sql);
				}
			if ((trim($vlr) == '9.00.00.00-X') and ($estrategica != 'S'))
				{ 
					$sql = "update pibic_submit_documento set doc_estrategica = 'N' ";
					$sql .= " where doc_protocolo = '".$protocolo."' or doc_protocolo_mae = '".$protocolo."' ";
					$estrategica = 'N';
					$rlt = db_query($sql);
				}
			}
//			$sr .= '<TD>'.$codspc;
			$sr .= $nl . '</TR>';
		}
	}
////////////////////// ARQUIVOS DO PROJETO
$fl1 = True;
$fl2 = True;
$fl3 = True;

$proto_file = $protocolo;
require('pibic_projeto__resumo_arquivos.php');
///////////// Parecer
$sr .= $nl . '<TR><TD colspan="4" bgcolor="#606060">'.$sb.'</TD></TR>';
if ($fl == 0) { $fl1 = False; }
require('pibic_parecer_tipo_1.php');
$sr .= $nl . $sp;
/////////////////////

if ($ed_acao != false)
	{
	$sr .= $nl . '<TR><TD colspan="4" align="center"><TABLE width="80%">';
	$sr .= $nl . '<TR><TD>&nbsp;</TD></TR>';
	$sr .= $nl . '	<TR><TD></TD><TD class="lt0" align="right">';
	$sr .= $nl . '	<TR><TH colspan="2">Cadastrar Planos de trabalho</TH></TR>';
	$sr .= $nl . '	<TR align="center"><TD colspan="1" align="center">';
	
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_sel.php';

	$sr .= $nl . '	<form action="'.$link.'">';
	$sr .= $nl . '	<input type="submit" name="xb" value=" Cadastrar plano do aluno '.chr(13).chr(10).' PIBIC" style="height:60px; background-color:#e6f2ff;">';
	$sr .= $nl . '	<input type="hidden" name="dd0" value="00015">';
	$sr .= $nl . '	<input type="hidden" name="dd98" value="1">';
	$sr .= $nl . '	</Form></TD>';

	$sr .= $nl . '<TD colspan="1" align="center">';
	
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_sel.php';
	
	$sr .= $nl . '	<form action="'.$link.'"><input type="submit" name="xb" value=" Cadastrar plano do aluno '.chr(13).chr(10).' PIBIC Jr." style="height:60px; background-color:#e6f2ff;">';
	$sr .= $nl . '	<input type="hidden" name="dd0" value="00016">';
	$sr .= $nl . '	<input type="hidden" name="dd98" value="1">';
	$sr .= $nl . '	</Form></TD>	';
	$sr .= $nl . '	</TR>';
	$sr .= $nl . '</TABLE>';
	}
	
$sr .= $nl . '</TABLE>';

////////////////////////////////////////////////////// PLANO DE TRABALHO DO ALUNO
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$sr .= $nl . '<TABLE width="'.$tab_max.'" align="center" class="lt2" border=0>';	

//<!--- Primeiro plano - Aluno Matriculado --->
require("pibic_projeto__resumo_1.php");

$sr .= $nl . '</TABLE>';

////////////////////////////////////////////////////// PIBIC Jr
/////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$sr .= $nl . '<TABLE width="'.$tab_max.'" align="center" class="lt2" border=0>';

//<!--- PIBIC Jr--->
require("pibic_projeto__resumo_2.php");

require("pibic_parecer_tipo_3.php");
$sr .= $nl . '</TABLE>';
} else {
	////////////////////// Projeto já relatado
	$PAR_FS = 'PAR_RELATO';
	//////////////// Busca mensagem de entrada
	$sql = "select * from ic_noticia where nw_ref = '".$PAR_FS."' and nw_idioma = 'pt_BR'";
	$rrr = db_query($sql);
	
	$texto = $PAR_FS;
	if ($eline = db_read($rrr))
		{
		$sC = $eline['nw_titulo'];
		$texto = $eline['nw_descricao'];
		}
	$sd = '';
	$sr .= '<TR><TD>';
	$sr .= mst($texto);
	$sr .= '</TD></TR>';
}
$sr .= '</table>';
?>