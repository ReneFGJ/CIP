<?
echo '-->'.$dd[1];
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
					where pp_ativo = 1 and pp_titulacao = '002'
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
					where (pj_status <> 'X') and pj_ano = '".date("Y")."'and doc_edital = 'PIBIC'
					group by pp_email, pp_email_1 		
			";
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
			echo 'CORREÇÃO';
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
			echo 'RELATÓRIO FINAL';
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
}		
?>