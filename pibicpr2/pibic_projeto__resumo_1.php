<?
$sr .= '<TABLE width="'.$tab_max.'" class="lt1" border="0">';
$projeto_aluno = false;
$sql = "select * from ".$tdoc." ";
$sql .= "left join pibic_aluno on doc_aluno = pa_cracha ";
//$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo_mae = '".$protocolo."' ";
$sql .= " and (doc_tipo = '00015' or doc_tipo = '00032' or doc_tipo = '00015' or doc_tipo = '00042')";
$sql .= " and (doc_status != '@' and doc_status != 'X')";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$icv = $line['doc_icv'];
	if ($icv == 1) 
		{
		$pl1_icv = 'SIM';
		} else {
		$pl1_icv = 'NÃO';
		}
	$projeto_aluno = True;
	$plano_trabalho_nr++;
	$prot_plano = trim($line['doc_protocolo']);
	$pp_titulo = trim($line['doc_1_titulo']);
	$pp_aluno = trim($line['pa_nome']);
	$pp_lattes = trim($line['pp_lattes']);
	$pl1_email = trim($line['pa_email']);
	$pl1_email2 = trim($line['pa_email_1']);
	$pp_escola = trim($line['pa_escolaridade']);
	$pp_curso = trim($line['pa_curso']);
	$pl1_codigo = trim($line['pa_cracha']);
	$pl1_curso = trim($line['pa_curso']);
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_sel.php';
	$link2 = 'http://www2.pucpr.br/reol/pibic/submit_cancelar.php';
	array_push($log_protos,$prot_plano);

	$sr .= $nl . '<TR><TD>&nbsp;</TD></TR>';
	$sr .= $nl . '<TR><TH colspan="3">Plano de trabalho PIBIC (Aluno)</TH></TR>';
	$sr .= $nl . '	<TR valign="top">';
	$sr .= $nl . '<TD rowspan="9 width="74"><img src="'.$link_ad.'img/icone_'.lowercase($pp_edital).'.png" width="74" height="114" alt="">';
	if ($estrategica == 'S')
			{ $sr .= $nl . '<BR><img src="img/icone_estrategica.png" width="74" height="16" alt="" border="0">'; }
	$sr .= $nl . '		<TD colspan="2" class="lt4" align="center"><B>'.$pp_titulo.'</B></TD></TR>';
	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right" width="25%">Protocolo</TD><TD class="lt1"><B>'.$prot_plano.'</B></TD></TR>';
	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right">Aluno</TD><TD><B>'.$pp_aluno.'</B></TD></TR>';
	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right">Código</TD><TD><B>'.$pl1_codigo.'</B></TD></TR>';
	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right">Curso</TD><TD><B>'.$pl1_curso.' '.$pl1_periodo.'</B></TD></TR>';
//	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right">Aluno</TD><TD><B>'.$pp_escola.'</B></TD></TR>';
//	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right">e-mail</TD><TD><B>'.$pl1_email.'&nbsp;'.$pl1_email2.'</B></TD></TR>';
	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right">Somente ICV</TD><TD><B>'.$pl1_icv.'</B></TD></TR>';
	$sr .= $nl . '	<TR  '.coluna().'><TD class="lt0" align="right"><TD>';
//	$sr .= '<TD>';
//	$sr .= $line['doc_status'];

	if ($ed_acao != false)
		{	
		$sr .= '	<TABLE width="100%">';
		$sr .= '	<TR  '.coluna().'><TD>';
		$sr .= '	<form method="get" action="'.$link.'"><input type="submit" name="xa" value=" Alterar este plano de trabalho " style="height:40px;  background-color:#e8ffe8;">';
		$sr .= '	<input type="hidden" name="dd1" value="'.$prot_plano.'">';
		$sr .= '	<input type="hidden" name="dd0" value="00015">';
		$sr .= '	<input type="hidden" name="dd98" value="1">';
		$sr .= '	</form>	';
		$sr .= '	<TD>';
		$sr .= '	<form method="get" action="'.$link2.'"><input type="submit" name="xa" value=" Cancelar este plano de trabalho " style="height:40px; background-color:#ffd9d9;">';
		$sr .= '	<input type="hidden" name="dd1" value="'.$prot_plano.'">';
		$sr .= '	<input type="hidden" name="dd0" value="00015">';
		$sr .= '	<input type="hidden" name="dd98" value="1">';
		$sr .= '	</form>	';
		$sr .= '	</TD>';
		$sr .= '	</TABLE>';
		}
		
		$proto_file = $prot_plano;
		require('pibic_projeto__resumo_arquivos.php');
		$sr .= '<TR><TD colspan="4">'.$sb.'</TD></TR>';
		
		require('pibic_parecer_tipo_2.php');
		$sr .= $nl . $sp;		
		if ($fl == 0) { $fl2 = False; }	
	}
$sr .= '</table>';
	?>