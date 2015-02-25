<?
$projeto_jr = false;

if (strlen($dd[1]) < 60)
{
$sr .= '<TABLE width="'.$tab_max.'" class="lt1" border="0">';
$sr .= '<TR '.coluna().'><TD><BR><BR></TD></TR>';
	$sql = "select * from ".$tdoc." ";
//	$sql .= "inner join ".$tdov." on sub_codigo = spc_codigo ";
//	$sql .= "inner join ".$submit_manuscrito_field." on sub_codigo = spc_codigo ";
	$sql .= " where doc_protocolo_mae = '".$protocolo."' ";
	$sql .= " and (doc_tipo = '00016' or doc_tipo = '00043') ";
	$sql .= " and (doc_status != '@' and doc_status != 'X')";
	$xrlt = db_query($sql);
	$link = 'http://www2.pucpr.br/reol/pibic/submit_phase_1_sel.php';
	$link2 = 'http://www2.pucpr.br/reol/pibic/submit_cancelar.php';

	while ($line = db_read($xrlt))
		{
		$projeto_jr = true;
		
		$pp_status = trim($line['doc_status']);
		$pp_titulo = trim($line['doc_1_titulo']);
		$prot_plano = trim($line['doc_protocolo']);
		array_push($log_protos,$prot_plano);
		if (strlen($pp_titulo) > 1)
			{
			$sr .= '<TR '.coluna().'><TH colspan="3">Plano de trabalho PIBIC Jr. (Aluno)</TH></TR>';
			$sr .= '<TR '.coluna().'><TD colspan="3" class="lt4" align="center"><B>'.$pp_titulo.'</B></TD></TR>';
			$sr .= '<TR><TD rowspan="4" width="74"><img src="'.$link_ad.'img/icone_pibic_jr.png" width="74" height="114" alt=""></TD><TD class="lt0" align="right" width="25%">Protocolo</TD><TD class="lt1"><B>'.$prot_plano.'</B></TD></TR>';
			$sr .= '<TR '.coluna().'><TD class="lt0" align="right"><TD>';
			
			if ($ed_acao != false)
				{			
				$sr .= '<TABLE width="100%">';
				$sr .= '<TR '.coluna().'><TD>';
				$sr .= '<form method="get" action="'.$link.'"><input type="submit" name="xa" value=" Alterar este plano de trabalho " style="height:40px;  background-color:#e8ffe8;">';
				$sr .= '<input type="hidden" name="dd1" value="'.$prot_plano.'">';
				$sr .= '<input type="hidden" name="dd0" value="00016">';
				$sr .= '<input type="hidden" name="dd98" value="1">';
				$sr .= '</form>	';
				$sr .= '<TD>';
				$sr .= '<form method="get" action="'.$link2.'"><input type="submit" name="xa" value=" Cancelar este plano de trabalho " style="height:40px; background-color:#ffd9d9;">';
				$sr .= '<input type="hidden" name="dd1" value="'.$prot_plano.'">';
				$sr .= '<input type="hidden" name="dd0" value="00016">';
				$sr .= '<input type="hidden" name="dd98" value="1">';
				$sr .= '</form>	';
				$sr .= '</TD>';
				$sr .= '</TABLE>	';
				}
			}
			$proto_file = $prot_plano;
			require('pibic_projeto__resumo_arquivos.php');
			
			require('pibic_parecer_tipo_2JR.php');
			$sr .= '<TR><TD colspan="4">'.$sb.'</TD></TR>';
			$sr .= $nl . $sp;		
			if ($fl == 0) { $fl3 = False; }	
		}
$sr .= '</table>';
$sr .= '<BR><BR>';
}
?>
