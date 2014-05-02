<?
if ((strlen($dd[3]) == 8) and (strlen($dd[4]) == 8) and ($dd[5] == 'S') and (strlen($dd[6]) > 0) and ($dd[4] != $dd[3]))
	{
	$sql = "select * from pibic_aluno where pa_cracha = '".$dd[4]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
			/* Buscsa nome do primeiro estudante */
			$xsql = "select * from pibic_aluno where pa_cracha = '".$dd[3]."' ";
			$xrlt = db_query($xsql);
			if ($xline = db_read($xrlt)) { $nome1 = trim($xline['pa_nome']); } else { echo 'Código '.$dd[3].' não é valido '; exit; }

			/* Buscsa nome do segundo estudante */
			$xsql = "select * from pibic_aluno where pa_cracha = '".$dd[4]."' ";
			$xrlt = db_query($xsql);
			if ($xline = db_read($xrlt)) { $nome2 = trim($xline['pa_nome']); } else { echo 'Código '.$dd[3].' não é valido '; exit; }
			
			$histo = "Protocolo ".$dd[8].", troca de aluno de ".$nome1.' ('.$dd[3].") pelo(a) ".$nome2.' ('.$dd[4].') - Submissão';
			$nome_de = $nome2;
			
			$sql = "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
			$sql .= "'".$dd[8]."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[9]."'); ";
			$rlt = db_query($sql);

			///////////////////////////////////////////////////////////// Recupera e-mail do professor
			$sql = "select * from pibic_submit_documento ";
			$sql .= "left join pibic_professor on doc_autor_principal = pp_cracha ";
			$sql .= " where doc_protocolo = '".$dd[8]."'";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$email = trim($line['pp_email']);
			$email_alt = trim($line['pp_email_1']);

			/* Enviar e-mail */
			$e3 = '[PIBIC] - Substituição de estudante';
			
			$texto = "Prezado professor, ";
			$texto .= '<BR><BR>Conforme sua solicitação foi realizada com sucesso a substituição de seu estudante.'.chr(13).chr(10);
			$texto .= '<BR>Protocolo: '.$dd[8].chr(13).chr(10);
			$texto .= "<BR>Estudante retirado: ".$dd[3]." ".$nome1.chr(13).chr(10);
			$texto .= "<BR>Estudante aivado: ".$dd[4]." ".$nome2.chr(13).chr(10);
			$texto .= '<BR><BR>Solicitação atendida em '.date("d/m/Y H:i").chr(13).chr(10);
			$e4 = mst($texto);
			echo '<BR><BR>enviado para:';
			enviaremail('renefgj@gmail.com',$e2,$e3,$e4); 
			//echo 'renefgj@gmail.com,';
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4); echo 'pibicpr@pucpr.br,';
			if (strlen($email) > 0) { enviaremail($email_alt,$e2,$e3,$e4); echo ' '.$email; }
			if (strlen($email_alt) > 0) { enviaremail($email_alt,$e2,$e3,$e4); echo ' '.$email_alt; }
	}
}
?>