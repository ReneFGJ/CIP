<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_email.php");
require($include."sisdoc_debug.php");
require($include."cp2_gravar.php");
$tabela = "pibic_bolsa_contempladas";
$enviar_email = 1;

	$dd3 = '';
	if ((strlen($dd[0]) > 0) and strlen($dd[1]) > 0)
		{ $dd3 = 'ok'; }
	
	if ((strlen($dd[1]) == 0) and (strlen($dd[0]) > 0))
		{
		$sql = "select * from ic_noticia ";
		$sql .= " where nw_ref = '".$dd[0]."' ";
		$rlt = db_query($sql);
		$texto = 'C�digo da not�cia: '.$dd[0];
		if ($line = db_read($rlt))
			{
			$texto = $line['nw_descricao'];
			}
		$dd[1] = $texto;
		}
		
		$tabela = '';
		$cp = array();
		$opa = "&email_rp:Relat�rio Parcial&email_rf:Relat�rio Final e Resumo&email_prp:Parecer do Relat�rio Parcial (todos)";
		$opa .= "&email_prpa:Parecer do Relat�rio Parcial (Aprovado)&email_prpp:Parecer do Relat�rio Parcial (Pend�ncia)";
		$opa .= "&email_prfa:Parecer do Relat�rio Final e Resumo (Aprovado)&email_prfp:Parecer do Relat�rio Final e Resumo (Pend�ncia)";
		$opa .= "&email_retifica:E-mail Para PIBIC Cancelados";
		array_push($cp,array('$O : '.$opa,'','Tipo:',False,True,''));
		array_push($cp,array('$T60:10','','Texto para enviar',True,True,''));
		array_push($cp,array('$HV','',$dd3,True,True,''));
		array_push($cp,array('$O :N�o&1:SIM','','Enviar',True,True,''));
		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '<TR><TD colspan="2">';
		?>
		$professor, $aluno, $projeto, $protocolo, $bolsa
		<?
		echo '</TD></TR>';
		echo '</TABLE>';	

if ($saved > 0)
	{
		if ($dd[0] == 'email_retifica') { $rtipo = 'Relat�rio Retifica��o'; }
		if ($dd[0] == 'email_rf') { $rtipo = 'Relat�rio Final'; }
		if ($dd[0] == 'email_rp') { $rtipo = 'Relat�rio do Parcial'; }
		if ($dd[0] == 'email_prp') { $rtipo = 'Parecer do Relat�rio Parcial'; }
		if ($dd[0] == 'email_prpp') { $rtipo = 'Parecer do Relat�rio Parcial (Pend�ncia)'; }
		if ($dd[0] == 'email_prpa') { $rtipo = 'Parecer do Relat�rio Parcial (Aprovado)'; }
		if ($dd[0] == 'email_prpp') { $rtipo = 'Parecer do Relat�rio Parcial (Pend�ncia)'; }
		if ($dd[0] == 'email_prpa') { $rtipo = 'Parecer do Relat�rio Parcial (Aprovado)'; }
		if ($dd[0] == 'email_prfp') { $rtipo = 'Parecer do Relat�rio Final e Resumo (Pend�ncia)'; }
		if ($dd[0] == 'email_prfa') { $rtipo = 'Parecer do Relat�rio Final e Resumo (Aprovado)'; }
		
		//////////////////////////////////////////////////////////////////////////////////////
		if ($dd[0] == 'email_rp')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and pb_relatorio_parcial = 0  and pb_status <> 'C' ";
			$sql .= "order by pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}
		//////////////////////////////////////////////////////////////////////////////////////
		if ($dd[0] == 'email_rf')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and (pb_relatorio_final < 20100101 or pb_resumo < 20100101) and pb_status <> 'C'  ";
			$sql .= "order by pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}	
		////////////////////////////////////////////////////////////////////////////////////// RELATORIO PARCIAL APROVADO
		if ($dd[0] == 'email_prpa')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and (pb_relatorio_final < 20100101 or pb_resumo < 20100101) and pb_status <> 'C' ";
			$sql .= "order by pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}		

		//////////////////////////////////////////////////////////////////////////////////////
		if ($dd[0] == 'email_retifica')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and (pb_relatorio_final < 20100101 or pb_resumo < 20100101) ";
			$sql .= " and pb_status = 'C' ";
			$sql .= "order by pb_status desc, pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}	
			
			//////////////////////////////////////////////////////////////////////////////////////
		if ($dd[0] == 'email_prfa')
			{	
//			$sql = "select * from pibic_bolsa_contempladas ";
//			$sql .= " inner join pibic_parecer_2010 on pp_protocolo = pb_protocolo and pp_status = 'A' ";
//			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
//			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
//			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
//			$sql .= " and pb_relatorio_final <> 0 ";
//			$sql .= " and pb_relatorio_final_nota = 1 ";
//			$sql .= " and pb_status <> 'X' ";
//			$sql .= " and doc_ano = '".(date("Y")-1)."'";
//			$sql .= "order by pa_centro, pa_curso, pp_nome";
			
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= " inner join pibic_parecer_2010 on pp_protocolo = pb_protocolo ";
			$sql .= " and (pp_status = 'B' or  pp_status = 'F')";
			$sql .= " and pp_tipo like '%F' ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where ";
			$sql .= " (pb_status = 'A' or pb_status = 'B')";
//			(pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
//			$sql .= " and pb_relatorio_final > 20000101 ";
			$sql .= " and pl_p0 = '1' ";
			$sql .= " and doc_ano = '".(date("Y")-1)."'";
			$sql .= " order by pa_centro, pa_curso, pp_nome";
						
			echo '<HR>';
			$rlt = db_query($sql);
			}
			//////////////////////////////////////////////////////////////////////////////////////
		if ($dd[0] == 'email_prpa')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= " inner join pibic_parecer_2010 on pp_protocolo = pb_protocolo and pp_status = 'A' ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and pb_relatorio_parcial <> 0 ";
			$sql .= " and pb_relatorio_parcial_nota = 1 ";
			$sql .= " and pb_status <> 'X' ";
			$sql .= " and doc_ano = '".(date("Y")-1)."'";
			$sql .= "order by pa_centro, pa_curso, pp_nome";
			echo '<HR>';
			$rlt = db_query($sql);
			}
					//////////////////////////////////////////////////////////////////////////////////////
		if ($dd[0] == 'email_prpp')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= " inner join pibic_parecer_2010 on pp_protocolo = pb_protocolo and pp_status = 'B' ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and pb_relatorio_parcial <> 0 ";
			$sql .= " and pb_relatorio_parcial_nota = 2 ";
			$sql .= " and pb_status <> 'X' ";
			$sql .= " and doc_ano = '".(date("Y")-1)."'";
			$sql .= "order by pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}
		
		if ($dd[0] == 'email_prfp')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= " inner join pibic_parecer_2010 on pp_protocolo = pb_protocolo ";
			$sql .= " and (pp_status = 'B' or  pp_status = 'F')";
			$sql .= " and pp_tipo like '%F' ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where ";
			$sql .= " (pb_status = 'A' or pb_status = 'B')";
//			(pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
//			$sql .= " and pb_relatorio_final > 20000101 ";
			$sql .= " and pl_p0 = '2' ";
			$sql .= " and doc_ano = '".(date("Y")-1)."'";
			$sql .= " order by pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}

		if ($dd[0] == 'email_rp2')
			{	
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= " inner join pibic_parecer_2010 on pp_protocolo = pb_protocolo and pp_status = 'B' ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= 	" where (pb_tipo = 'C' or pb_tipo = 'I' or pb_tipo = 'P' or pb_tipo = 'F' or pb_tipo = 'E' or pb_tipo = 'U') ";
			$sql .= " and pb_relatorio_parcial = 0 ";
			$sql .= " and pb_relatorio_parcial_nota = 2 ";
			$sql .= "order by pa_centro, pa_curso, pp_nome";
			$rlt = db_query($sql);
			}

		
		$texto2 = troca($dd[1],chr(13),'<BR>');
		$texto2 = '<table width=600 align=center><TR><TD>'.$texto2.'</table>';
		echo '['.$rtipo.']'.$dd[0];
		$total = 0;

		while ($line = db_read($rlt))
			{
			$total++;
			$email_1 = trim($line['pa_email']);
			$email_2 = trim($line['pp_email']);
			$email_3 = trim($line['pp_email_1']);
			$titulo  = $line['pb_titulo_projeto'];

			$tipo_bolsa = $line['pb_tipo'];
			if ($tipo_bolsa == 'I') { $tipo_bolsa = 'Inicia��o Cient�fica Volunt�ria'; }
			if ($tipo_bolsa == 'P') { $tipo_bolsa = 'Bolsa PUCPR'; }
			if ($tipo_bolsa == 'C') { $tipo_bolsa = 'Bolsa CNPq'; }
			if ($tipo_bolsa == 'T') { $tipo_bolsa = 'Bolsa PIBIT - CNPq'; }
			if ($tipo_bolsa == 'F') { $tipo_bolsa = 'Bolsa Funda��o Arauc�ria'; }
			if ($tipo_bolsa == 'E') { $tipo_bolsa = 'Bolsa Estrat�gica - CNPq'; }
			if ($tipo_bolsa == 'U') { $tipo_bolsa = 'Bolsa Estrat�gica - PUCPR'; }
			if ($tipo_bolsa == 'B') { $tipo_bolsa = 'Bolsa PIBITI - PUCPR'; }
			
			$e3 = '[PIBIC] '.$rtipo.' '.trim($line['pa_nome']);
			$plink = 'http://www2.pucpr.br/reol/pibicpr2/pibic_parecer_mostrar.php?dd10='.$line['pp_protocolo'].'&dd11='.md5('parecer'.$line['pp_protocolo']);
			$flink = 'http://www2.pucpr.br/reol/pibicpr2/pibic_parecer_mostrar.php?dd10='.$line['pp_protocolo'].'&dd12=F&dd11='.md5('parecer'.$line['pp_protocolo']);
			$texto = $texto2;
			$texto = troca($texto,chr(92),'');
			$texto = troca($texto,'$professor',$line['pp_nome']);
			$texto = troca($texto,'$aluno',$line['pa_nome']);
			$texto = troca($texto,'$projeto',$line['pb_titulo_projeto']);
			$texto = troca($texto,'$protocolo',$line['pb_protocolo']);
			$texto = troca($texto,'$bolsa',$tipo_bolsa);
			$texto = troca($texto,'$flink',$flink);
			$texto = troca($texto,'$plink',$plink);

			$e4 = $texto;
			// e-mail de seguran�a
			$e1 = 'renefgj@gmail.com';
			enviaremail($e1,$e2,$e3,$e4);
			echo '<HR>';
			echo 'Para:'.$e1;
			echo '<BR>'.$texto;
			//exit;
			if ($enviar_email == 1)
				{
				$e1 = 'pibicpr@pucpr.br';
				enviaremail($e1,$e2,$e3,$e4);
				//// Enviar para professor
				echo '<BR>'.$line['pp_nome'];

				if (strlen($email_2) > 0) { enviaremail($email_2,$e2,$e3,$e4); echo $email_2.'<BR>'; }
				if (strlen($email_3) > 0) { enviaremail($email_3,$e2,$e3,$e4); echo $email_3.'<BR>'; }
				}
			}
		}
		echo 'Total ['.$total.']';


require("foot.php");	
?>