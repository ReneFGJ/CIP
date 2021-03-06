<?
if ((substr($dd[1],0,1)=='0') or (substr($dd[1],0,1)=='1'))
	{
		$op = $dd[1];
		if ($op == '100')
		{
			require("../_class/_class_docentes.php");
			$doc = new docentes;
			$rlt = $doc->rel_prof_produtividade();
			$id = 0;
			while ($line = db_read($rlt))
			{
				$id++;
				$email = trim($line['pp_email']);
				$email1 = trim($line['pp_email_1']);
				if (strlen($email) > 0)
					{ $ee .= '; '.$email; }
				if (strlen($email1) > 0)
					{ $ee .= '; '.$email1; }
			}
			$dd[3] = $ee;
		}
		
	/* Estudantes PIBIC Atual */
	if ($op == '060')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".date("Y")."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')		
			";
			echo $sql;
			$rlt = db_query($sql);
		}
				
	/* Estudantes PIBIC Atual -1 */
	if ($op == '061')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')		
			";
			echo $sql;
			$rlt = db_query($sql);
		}
	/* Estudantes PIBIC Atual -2 */
	if ($op == '062')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".(date("Y")-2)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')		
			";
			echo $sql;
			$rlt = db_query($sql);
		}	
	/* Estudantes PIBIC Atual -3 */
	if ($op == '063')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".(date("Y")-3)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')		
			";
			echo $sql;
			$rlt = db_query($sql);
		}			
	if ($op == '001')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".date("Y")."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')		
			";
			echo $sql;
			$rlt = db_query($sql);
		}
		
	if ($op == '002')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS') 		
			";
			$rlt = db_query($sql);
		}	
		
	if ($op == '003')
		{
			$sql = "select pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					group by pp_email, pp_email_1 		
			";
			$rlt = db_query($sql);
		}		

	if ($op == '004')
		{
			$sql = "select pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pp_ss = 'S'
					group by pp_email, pp_email_1 		
			";
			$rlt = db_query($sql);
		}
	if ($op == '005')
		{
			$sql = "
				select pp_email, pp_email_1 from
				(
				select pdce_docente from programa_pos_docentes where pdce_ativo = 1
				group by pdce_docente
				) as tabela
				inner join pibic_professor on pdce_docente = pp_cracha
			";
			$rlt = db_query($sql);
		}
		
	if ($op == '006')
		{
			$sql = "
				select pp_email, pp_email_1 from pibic_professor
					where pp_ativo = 1 and pp_titulacao = '002' and pp_update = '".date("Y")."'
			";
			$rlt = db_query($sql);
		}		
	/* Todos os professores */
	if ($op == '007')
		{
			$sql = "
				select pp_email, pp_email_1 from pibic_professor
					where pp_ativo = 1 and pp_update = '".date("Y")."'
			";
			$rlt = db_query($sql);
		}
	/* Todos os professores */
	if ($op == '008')
		{
			$sql = "
				select pp_email, pp_email_1 from pibic_professor
					where pp_ativo = 1 and pp_update = '".date("Y")."'
					and (pp_titulacao = '002' or pp_titulacao = '001' or pp_titulacao = '003' or pp_titulacao = '006')
			";
			$rlt = db_query($sql);
		}
	if ($op == '009')
		{
			$sql = "select distinct pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".date("Y")."' or pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pp_ch = 'HR'		
			";
			$rlt = db_query($sql);
		}
							
	if ($op == '010')
		{
			$sql = "select pp_email, pp_email_1 from pibic_projetos 
					inner join pibic_professor on pj_professor = pp_cracha
					where (pj_status <> 'X') and pj_ano = '".date("Y")."'
					group by pp_email, pp_email_1 		
			";
			$rlt = db_query($sql);
		}
	if ($op == '011')
		{
			$sql = "select pp_email, pp_email_1 from pibic_projetos 
					inner join pibic_professor on pj_professor = pp_cracha
					inner join pibic_submit_documento on doc_protocolo_mae = pj_codigo
					where (pj_status <> 'X') and pj_ano = '".date("Y")."'and doc_edital = 'PIBITI'
					group by pp_email, pp_email_1 		
			";
			$rlt = db_query($sql);
		}		
	if ($op == '012')
		{
			$sql = "select pp_email, pp_email_1 from pibic_projetos 
					inner join pibic_professor on pj_professor = pp_cracha
					inner join pibic_submit_documento on doc_protocolo_mae = pj_codigo
					where (pj_status <> 'X') and pj_ano = '".date("Y")."' and doc_edital = 'PIBIC'
					group by pp_email, pp_email_1 		
			";
			$rlt = db_query($sql);
		}	
	if ($op == '013')
		{
			$sql = "select distinct pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".date("Y")."' or pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pp_ch = 'TP'		
			";
			$rlt = db_query($sql);
		}		
	if ($op == '014')
		{
			$sql = "select distinct pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".date("Y")."' or pb_ano = '".(date("Y")-1)."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pp_ch = 'TI'		
			";
			$rlt = db_query($sql);
		}		
	if ($op == '015')
		{
			// 	
			//  left join apoio_titulacao on ap_tit_codigo = pp_titulacao 
			$ano = date("Y");
			$wh = " and doc_edital = 'PIBIC' ";
			$sql = "select pp_email, pp_email_1 from (
					select pp_email, pp_email_1 from pibic_bolsa 					
					inner join pibic_bolsa_tipo on pbt_codigo =  pb_tipo 
					inner join pibic_submit_documento on pb_protocolo = doc_protocolo
					inner join pibic_professor on pp_cracha = pb_professor 
					where pp_ano = '$ano' $wh and pb_tipo = 'I'
					and pb_ativo = 1 ) as tabela
					group by pp_email, pp_email_1
					";			
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$rlt = db_query($sql);
		}
	if ($op == '016')
		{
			// 	
			//  left join apoio_titulacao on ap_tit_codigo = pp_titulacao 
			$ano = date("Y");
			$wh = " and doc_edital = 'PIBITI' ";
			$sql = "select pp_email, pp_email_1 from (
					select pp_email, pp_email_1 from pibic_bolsa 					
					inner join pibic_bolsa_tipo on pbt_codigo =  pb_tipo 
					inner join pibic_submit_documento on pb_protocolo = doc_protocolo
					inner join pibic_professor on pp_cracha = pb_professor 
					where pp_ano = '$ano' $wh and pb_tipo = 'Y'
					and pb_ativo = 1 ) as tabela
					group by pp_email, pp_email_1
					";			
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$rlt = db_query($sql);
		}
	if ($op == '017')
		{
			// 	
			//  left join apoio_titulacao on ap_tit_codigo = pp_titulacao 
			$ano = date("Y");
			$wh = " and doc_edital = 'PIBIC' and pb_vies = '1'";
			$sql = "select pp_email, pp_email_1 from (
					select pp_email, pp_email_1 from pibic_bolsa 					
					inner join pibic_bolsa_tipo on pbt_codigo =  pb_tipo 
					inner join pibic_submit_documento on pb_protocolo = doc_protocolo
					inner join pibic_professor on pp_cracha = pb_professor 
					where pp_ano = '$ano' $wh and pb_tipo = 'I'
					and pb_ativo = 1 ) as tabela
					group by pp_email, pp_email_1
					";			
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$rlt = db_query($sql);
		}							
	if ($op == '001')
		{
			$sql = "select pa_email, pa_email_1 from pibic_bolsa_contempladas 
					inner join pibic_aluno on pb_aluno = pa_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where pb_status <> 'C' and pb_ano = '".date("Y")."'
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')		
			";
			$rlt = db_query($sql);
		}
		

	/* Acompanhamento */
	if ($op == '021')
		{
			/* RESUMO */
			$sql = "select pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where (pb_status <> 'C' and pb_ano = '".(date("Y")-1)."')
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pb_relatorio_parcial < 20000101
					
					group by pp_email, pp_email_1 		
			";
			echo 'RESUMO';
			$rlt = db_query($sql);
		}	
	
	if ($op == '022')
		{
			/* RESUMO */
			$sql = "
					
					
					select pp_p01, pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					inner join pibic_parecer_".date("Y")." on pp_protocolo = pb_protocolo
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where (pb_status <> 'C' and pb_ano = '".(date("Y")-1)."')
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pp_p01 = '2'
					
					group by pp_email, pp_email_1, pp_p01	
			";
			echo 'CORRE��O';
			$rlt = db_query($sql);
		}
	if ($op == '028')
		{
			/* RESUMO */
			$sql = "select pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where (pb_status <> 'C' and pb_ano = '".(date("Y")-1)."')
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pb_resumo < 20000101
					
					group by pp_email, pp_email_1 		
			";
			echo 'RESUMO';
			$rlt = db_query($sql);
		}		
	if ($op == '024')
		{
			/* RELATORIO FINAL */
			$sql = "select pp_email, pp_email_1 from pibic_bolsa_contempladas 
					inner join pibic_professor on pb_professor = pp_cracha
					left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
					where (pb_status <> 'C' and pb_ano = '".(date("Y")-1)."')
					and (pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' or pbt_edital = 'IS')
					and pb_relatorio_final < 20000101
					
					group by pp_email, pp_email_1 		
			";
			echo 'RELAT�RIO FINAL';
			$rlt = db_query($sql);
		}		
			
	if ($op == '110')
		{
			/* RELATORIO PARCIAL - AVALIADORES */
			require("../_class/_class_parecer_pibic.php");
			$parecer_pibic = new parecer_pibic;
			
			$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
			$sql = "select pp_email, pp_email_1 from ".$parecer_pibic->tabela." as tb1 
					inner join pibic_professor on tb1.pp_avaliador = pp_cracha
					where pp_tipo = 'RPAR' and pp_status = '@' 
					and pp_ativo = 1 
					group by pp_email, pp_email_1
					";
			$rlt = db_query($sql);
		}
		
	if ($op == '111')
		{
			/* RELATORIO PARCIAL - AVALIADORES */

			$parecer_pibic->tabela = 'pibic_parecer_'.date("Y");
			$sql = "select pp_email, pp_email_1 from ".$parecer_pibic->tabela." as tb1 
					inner join pibic_professor on tb1.pp_avaliador = pp_cracha
					where pp_tipo = 'SUBMI' and pp_status = 'B' 
					and pp_ativo = 1 
					group by pp_email, pp_email_1
					";
			$rlt = db_query($sql);
		}		
						
	$ee = '';
	$tot = 0;
	$ee = 'pibicpr@pucpr.br; renefgj@gmail.com; cleybe.vieira@pucpr.br; edna.grein@pucpr.br; mariani.barbosa@pucpr.br; edena.grein@pucpr.br';
	while ($line = db_read($rlt))
		{
			$tot++;
			$email = trim($line['pa_email']).trim($line['pp_email']);
			if (strlen($email) > 0) { $ee .= '; '.$email; }
			$email = trim($line['pa_email_1']).trim($line['pp_email_1']);
			if (strlen($email) > 0) { $ee .= '; '.$email; }
		}	
	$dd[3] = $ee;
}	echo '---->'.$tot;
?>