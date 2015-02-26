<?
$tabela = "pibic_bolsa_contempladas";

if ((strlen($dd[6]) == 7) and (strlen($dd[7]) == 7) and ($dd[8] == 'S') and ($dd[6] != $dd[3]))
	{
	$sql = "select * from pibic_submit_documento where  doc_protocolo = '".$dd[7]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
//		print_r($line);
//		exit;
		$aluno = $line['doc_aluno'];
		$professor = $line['doc_autor_principal'];
		$titulo_aluno = $line['doc_1_titulo'];
			$histo = "Troca de projeto de professor ".$dd[3]." para ".$dd[6];
			$histo .= " e plano do aluno de ".$dd[4]." para ".$dd[7];
			$sql = "update ".$tabela." set ";
			$sql .= "pb_protocolo = '".$dd[7]."', ";
			$sql .= "pb_protocolo_mae = '".$dd[6]."', ";
			$sql .= "pb_professor = '".$professor."', ";
			$sql .= "pb_aluno = '".$aluno."', ";
			$sql .= "pb_titulo_projeto = '".$titulo_aluno."'";
			$sql .= " where id_pb = ".$dd[0].';';
//		echo $sql;
//		exit;
				$sql .= "insert into pibic_bolsa_historico ";
				$sql .= "(bh_protocolo,bh_data,bh_hora,";
				$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
				$sql .= "'".$dd[5]."','".date("Ymd")."','".date("H:i")."',";
				$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[11]."'); ";
				$rlt = db_query($sql);
			
			$rlt = db_query($sql);
			$sql = "";
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
			echo $sql;
			
		} else {
			$msg = "Projeto nуo cadastrado";
		}
	}


$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Alteraчуo do Projeto do Professor',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$S8','pb_protocolo_mae','Protocolo (Projeto Professor)',False,False,''));
array_push($cp,array('$S8','pb_protocolo','Protocolo (Plano de Aluno)',False,False,''));

array_push($cp,array('$A8','','Alteraчуo para',False,False,''));
array_push($cp,array('$S8','','Protocolo (Projeto Professor)',True,True,''));
array_push($cp,array('$S8','','Protocolo (Plano de Aluno)',True,True,''));
array_push($cp,array('$O N:NУO&S:SIM','','Confirma operaчуo ?',False,True,''));
array_push($cp,array('$B8','','Alterar agora',False,True,''));
array_push($cp,array('$H4','','',True,True,''));
array_push($cp,array('$Q motivo_descricao:motivo_codigo:select * from pibic_motivo where motivo_tipo = 1 order by motivo_descricao','','Motivo',True,True,''));

$dd[2] = '004';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>