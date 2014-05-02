<?
$projeto_jr = false;
$sr .= $nl . '<TR '.coluna().'><TD><BR><BR></TD></TR>';
	$sql = "select * from ".$tdoc." ";
//	$sql .= "inner join ".$tdov." on sub_codigo = spc_codigo ";
//	$sql .= "inner join ".$submit_manuscrito_field." on sub_codigo = spc_codigo ";
	$sql .= " where doc_protocolo_mae = '".$protocolo."' ";
	$sql .= " and doc_tipo = '00016' ";
	$sql .= " and doc_status <> 'X' ";
	$xrlt = db_query($sql);
		
	while ($line = db_read($xrlt))
		{
		$projeto_jr = true;
		
		$pp_titulo = trim($line['doc_1_titulo']);
		$prot_plano = trim($line['doc_protocolo']);
		if (strlen($pp_titulo) > 1)
			{
			$sr .= $nl . '<TR><TD bgcolor="#ffffff">';
			$sr .= $nl . '<TABLE width="'.$tab_max.'" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" align="center">';
			$sr .= $nl . '<TR bgcolor="#FFFFFF"><TD rowspan="6" width="74"><img src="/reol/pibicpr/img/icone_pibic_jr.png" alt="" border="0"></TD><TH colspan="2" bgcolor="C0C0C0">Plano de trabalho PIBIC Jr. (Aluno)</TH></TR>';
			$sr .= $nl . '<TR bgcolor="#ffffff"><TD colspan="2" class="lt4" align="center"><B>'.$pp_titulo.'</B></TD></TR>';
			$sr .= $nl . '<TR bgcolor="#ffffff"><TD class="lt1" align="left" colspan="2">Protocolo &nbsp;<B>'.$prot_plano.'</B></TD></TR>';


			$proto_file = $prot_plano;
			require('submit_pibic_resumo_arquivos.php');
			
			$sr .= $nl . '<TR><TD colspan=2>';
			$sr .= $nl . '<TABLE width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff">';
			$sr .= $nl . '<TR><TD colspan="4">'.$sb.'</TD></TR>';
			$sr .= $nl . '</TABLE>	';

			$sr .= $nl . '<TR><TD colspan=2>';
			

			$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_pibic_sel.php';
			$link2 = 'http://www2.pucpr.br/reol/pibic/submit_cancelar_pibic.php';

			if ($ed_acao != false)
				{			
				$sr .= $nl . '<TR align="center"><TD>';
				$sr .= $nl . '<form method="get" action="'.$link.'"><input type="submit" name="xa" value=" Alterar este plano de trabalho " style="height:40px;  background-color:#e8ffe8;">';
				$sr .= $nl . '<input type="hidden" name="dd1" value="'.$prot_plano.'">';
				$sr .= $nl . '<input type="hidden" name="dd0" value="00016">';
				$sr .= $nl . '<input type="hidden" name="dd98" value="1">';
				$sr .= $nl . '</form>	';
				$sr .= $nl . '<TD>';
				$sr .= $nl . '<form method="get" action="'.$link2.'"><input type="submit" name="xa" value=" Cancelar este plano de trabalho " style="height:40px; background-color:#ffd9d9;">';
				$sr .= $nl . '<input type="hidden" name="dd1" value="'.$prot_plano.'">';
				$sr .= $nl . '<input type="hidden" name="dd0" value="00016">';
				$sr .= $nl . '<input type="hidden" name="dd98" value="1">';
				$sr .= $nl . '</form>	';
				$sr .= $nl . '</TD>';
				}
			}
			$sr .= $nl . '</TABLE>	';

			if ($fl == 0) { $fl3 = False; }	
		}
?>
