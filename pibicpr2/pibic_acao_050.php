<?
$tabela = "pibic_bolsa_contempladas";
if ((strlen($dd[3]) > 10) and ($dd[4] == 'S'))
	{
			
			$sql = "update ".$tabela." set pb_titulo_projeto = '".$dd[3]."' ";
			$sql .= " where id_pb = ".$dd[0].';';
			
			$sql .= "insert into pibic_bolsa_historico ";
			
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= " bh_log,bh_historico,bh_aluno_1,";
			$sql .= " bh_aluno_2,bh_motivo) values (";
			
			$sql .= "'".$protocolo."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "0".$user_id.",'Alterado título de:".$ttp." Para:".$dd[3]."','','','".$dd[9]."'); ";

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
			$sql .= " where pb_protocolo = '".$dd[7]."'";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$email = trim($line['pp_email']);
			$email_alt = trim($line['pp_email_1']);
			///////////////////////////////////////////////////////////// Enviar e-mail
			$e3 = '[PIBIC] - Substituição de título do plano do aluno';
			
			$texto = "Prezado professor, ";
			$texto .= '<BR><BR>Conforme sua solicitação foi realizada a alteração do título do projeto:'.chr(13).chr(10);
			$texto .= '<HR>DE:<HR><B>'.$ttp.'</B>'.chr(13).chr(10);
			$texto .= '<HR>PARA:<HR><B>'.$dd[3].'</B>'.chr(13).chr(10);
			$texto .= '<BR><BR>Protocolo: '.$dd[7].chr(13).chr(10);
			$texto .= '<BR><BR>Solicitação atendida em '.date("d/m/Y H:i").chr(13).chr(10);
			$e4 = mst($texto);
			echo '<BR><BR>enviado para:';
			enviaremail('renefgj@gmail.com',$e2,$e3,$e4);
			enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
			if (strlen($email) > 0) { enviaremail($email_alt,$e2,$e3,$e4); echo ' '.$email; }
			if (strlen($email_alt) > 0) { enviaremail($email_alt,$e2,$e3,$e4); echo ' '.$email_alt; }

			///////////////////////////////////////////////////////////////////////////
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
	}


$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$HV','',$dd[1],False,True,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$T80:6','','Alterar o título para',True,True,''));
array_push($cp,array('$O N:NÃO&S:SIM','','Confirma operação ?',False,True,''));
array_push($cp,array('$B8','','Alterar agora',False,True,''));
array_push($cp,array('$H8','pb_protocolo','',False,True,''));
array_push($cp,array('$H4','','',True,True,''));
$dd[2] = '001';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>