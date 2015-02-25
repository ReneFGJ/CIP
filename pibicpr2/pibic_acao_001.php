<?
$tabela = "pibic_bolsa_contempladas";
$dd[3] = trim($dd[3]);

if ((strlen($dd[3]) == 8) and (strlen($dd[4]) == 8) and ($dd[5] == 'S') and (strlen($dd[6]) > 0) and ($dd[4] != $dd[3]))
	{
	$sql = "select * from pibic_aluno where pa_cracha = '".$dd[4]."' ";
	echo '<HR>'.$sql.'<HR>';
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
			////////////////////////////////////////////////////////////// Atualiza protocolos
			$sql = "update pibic_protocolo set pr_status = 'B' where ";
			$sql .= "pr_aluno_1 = '".$dd[4]."' ";
			$sql .= "and pr_aluno_2 = '".$dd[3]."' ";
			$sql .= "and pr_status = 'A' ";
			
			$rlt = db_query($sql);
		
			$xsql = "select * from pibic_aluno where pa_cracha = '".$dd[3]."' ";
			$xrlt = db_query($xsql);
			if ($xline = db_read($xrlt)) { $nome1 = trim($xline['pa_nome']); } else { echo 'Código '.$dd[3].' não é valido '; exit; }

			$xsql = "select * from pibic_aluno where pa_cracha = '".$dd[4]."' ";
			$xrlt = db_query($xsql);
			if ($xline = db_read($xrlt)) { $nome2 = trim($xline['pa_nome']); } else { echo 'Código '.$dd[3].' não é valido '; exit; }
			
			$histo = "Protocolo ".$dd[8].", troca de aluno de ".$nome1.' ('.$dd[3].") pelo(a) ".$nome2.' ('.$dd[4].')';
			$nome_de = $nome2;
			
			$sql = "update ".$tabela." set pb_aluno = '".$dd[4]."' ";
			$sql .= " where id_pb = ".$dd[0].';';
			
			$sql .= "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo,bh_acao) values (";
			$sql .= "'".$dd[8]."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[9]."',90); ";

			$rlt = db_query($sql);
			$sql = "";

			$sql = "update pibic_bolsa_contempladas set pb_codigo = '' ";	
			$sql .= " where pb_protocolo = '".$dd[7] ."' ";
			$xrlt = db_query($sql);
			
			///////////////////////////////////////////////////////////// Recupera e-mail do professor
			$sql = "select * from pibic_bolsa_contempladas ";
			$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
			$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
			$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
			$sql .= "left join pibic_bolsa_tipo on pbt_codigo = pb_tipo ";
			$sql .= " where pb_protocolo = '".$dd[8]."'";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$email = trim($line['pp_email']);
			$email_alt = trim($line['pp_email_1']);
			///////////////////////////////////////////////////////////// Enviar e-mail
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
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
			if (strlen($email) > 0) { enviaremail($email_alt,$e2,$e3,$e4); echo ' '.$email; }
			if (strlen($email_alt) > 0) { enviaremail($email_alt,$e2,$e3,$e4); echo ' '.$email_alt; }

			///////////////////////////////////////////////////////////////////////////
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
		} else {
			$msg = "Estudante não cadastrado";
		}
	}

$dd[3] = $aluno_cracha;
$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Alteração de alunos para projeto do professor',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$S8','pb_aluno','Aluno (cracha)',False,False,''));
array_push($cp,array('$S8','','Alterar para (cracha)',False,True,''));
array_push($cp,array('$O N:NÃO&S:SIM','','Confirma operação ?',False,True,''));
array_push($cp,array('$Q mt_descricao:mt_codigo:select * from pibic_motivos where mt_ativo = 1 order by mt_descricao','','Motivo',True,True,''));
array_push($cp,array('$B8','','Alterar agora',False,True,''));
array_push($cp,array('$H8','pb_protocolo','',False,True,''));
array_push($cp,array('$H4','','',True,True,''));
$dd[2] = '001';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>