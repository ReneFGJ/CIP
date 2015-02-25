<?
$titulo_plan = troca($titulo_plan,chr(13),'');
$titulo_plan = troca($titulo_plan,chr(10),'');

		$pa_email_1 = trim($line['pa_email']);
		$pa_email_2 = trim($line['pa_email_1']);
		
		$pp_email_1 = trim($line['pp_email']);
		$pp_email_2 = trim($line['pp_email_1']);
		
		$avaliador_nome = trim($line['us_nome']);
		
		$aluno_nome = trim($line['pa_nome']);
		$profe_nome = trim($line['pp_nome']);
		$aluno_crac = trim($line['pa_cracha']);
		$profe_crac = trim($line['pp_cracha']);
		
		$titulo_plan = trim($line['doc_1_titulo']);
		if (strlen($titulo_plan) == 0) 
			{ $titulo_plan = $line['pb_titulo_projeto']; }
		$proto = trim($line['doc_protocolo']);
		if (strlen($proto) == 0) { $proto = $line['pb_protocolo']; }
		$protom = trim($line['doc_protocolo_mae']);
		
		$texto = troca($texto,'$titulo',$titulo_plan);
		$texto = troca($texto,'$aluno',$aluno_nome);
		$texto = troca($texto,'$professor',$profe_nome);
		$texto = troca($texto,'$proto_mae',$protom);
		$texto = troca($texto,'$protocolo',$proto);
		$texto = troca($texto,'$avaliador',$avaliador_nome);
		$texto = troca($texto,'$link',$link);
		$texto = troca($texto,'$mlink',$mlink);
?>