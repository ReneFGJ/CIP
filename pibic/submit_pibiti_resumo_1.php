<?
$projeto_aluno = false;
$sql = "select * from ".$tdoc." ";
$sql .= "left join pibic_aluno on doc_aluno = pa_cracha ";
//$sql .= " left join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where doc_protocolo_mae = '".$protocolo."' ";
$sql .= " and doc_tipo = '00042' ";
$sql .= " and doc_status <> 'X' ";
$rlt = db_query($sql);
$spp = '';

while ($line = db_read($rlt))
	{
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
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_pibiti_sel.php';
	$link2 = 'http://www2.pucpr.br/reol/pibic/submit_cancelar_pibiti.php';
	$pl1_icv = "";
	
	$xsql = "select * from ".$tdov;
	$xsql .= " where spc_projeto='".$prot_plano."' ";
	$xsql .= " and spc_codigo = '00042' ";
	$yrlt = db_query($xsql);
	if ($xline = db_read($yrlt)) { $pl1_icv = trim($xline['spc_content']); }

	$spp .= $nl . '<TABLE width="'.$tab_max.'" align="center" class="lt2" border=0 >';
	$spp .= $nl . '<TR bgcolor="#e0e0e0"><TH colspan="3">Plano de trabalho PIBITI (Aluno)</TH></TR>';
	$spp .= $nl . '<TR valign="top">';
	$spp .= '<TD rowspan="15"><img src="../pibicpr/img/icone_pibic.png" alt="" border="0"></TD>';
	$spp .= '<TD colspan="2" class="lt4" align="center"><B>'.$pp_titulo.'</B></TD></TR>';
	$spp .= $nl . '	<TR bgcolor="#f8f8f8"><TD class="lt0" align="right" width="30%">Protocolo</TD><TD class="lt1"><B>'.$prot_plano.'</B></TD></TR>';
	$spp .= $nl . '	<TR><TD class="lt0" align="right">Aluno</TD><TD><B>'.$pp_aluno.'</B></TD></TR>';
	$spp .= $nl . '	<TR bgcolor="#f8f8f8"><TD class="lt0" align="right">Código</TD><TD><B>'.$pl1_codigo.'</B></TD></TR>';
	$spp .= $nl . '	<TR><TD class="lt0" align="right">Curso</TD><TD><B>'.$pl1_curso.' '.$pl1_periodo.'</B></TD></TR>';
	$spp .= $nl . '	<TR bgcolor="#f8f8f8"><TD class="lt0" align="right">Aluno</TD><TD><B>'.$pp_escola.'</B></TD></TR>';
	$spp .= $nl . '	<TR><TD class="lt0" align="right">e-mail</TD><TD><B>'.$pl1_email.'&nbsp;'.$pl1_email2.'</B></TD></TR>';
	$spp .= $nl . '	<TR bgcolor="#f8f8f8"><TD class="lt0" align="right">Somente ICV</TD><TD><B>'.$pl1_icv.'</B></TD></TR>';
	$spp .= $nl . '	<TR><TD class="lt0" align="right"><TD>';

	if ($ed_acao != false)
		{	
		$spp .= $nl . '	<TABLE width="100%">';
		$spp .= $nl . '	<TR  '.coluna().'><TD>';
		$spp .= $nl . '	<form method="get" action="'.$link.'"><input type="submit" name="xa" value=" Alterar este plano de trabalho " style="height:40px;  background-color:#e8ffe8;">';
		$spp .= $nl . '	<input type="hidden" name="dd1" value="'.$prot_plano.'">';
		$spp .= $nl . '	<input type="hidden" name="dd0" value="00042">';
		$spp .= $nl . '	<input type="hidden" name="dd98" value="1">';
		$spp .= $nl . '	</form>	';
		$spp .= $nl . '	<TD>';
		$spp .= $nl . '	<form method="get" action="'.$link2.'"><input type="submit" name="xa" value=" Cancelar este plano de trabalho " style="height:40px; background-color:#ffd9d9;">';
		$spp .= $nl . '	<input type="hidden" name="dd1" value="'.$prot_plano.'">';
		$spp .= $nl . '	<input type="hidden" name="dd0" value="00042">';
		$spp .= $nl . '	<input type="hidden" name="dd98" value="1">';
		$spp .= $nl . '	</form>	';
		$spp .= $nl . '	</TD>';
		$spp .= $nl . '	</TABLE>';
		}
		
		$proto_file = $prot_plano;
		require('submit_pibic_resumo_arquivos.php');
		$spp .= $nl . '<TR><TD colspan="4">'.$sb.'</TD></TR>';
		if ($fl == 0) { $fl2 = False; }	
		$spp .= $nl . '</TABLE>';
	}
	$sr .= $spp;	
	?>