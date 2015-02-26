<?
$tabela = "pibic_bolsa_contempladas";

if ((strlen($dd[3]) >4) and (strlen($dd[4]) == 10) and ($dd[5] == 'S'))
	{
	$sql = "select * from pibic_submit_documento where doc_protocolo = '".$dd[7]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
//		print_r($line);
//		exit;
		$aluno = $line['doc_aluno'];
		$professor = $line['doc_autor_principal'];
		$titulo_aluno = $line['doc_1_titulo'];
			$histo = "Implantaзгo de bolsa para o protocolor ".$dd[7];
			$sql = "update ".$tabela." set ";
			$sql .= "pb_contrato = '".$dd[3]."', ";
			$sql .= "pb_data_ativacao = '".brtos($dd[4])."', ";
			$sql .= "pb_status = 'A' ";
			$sql .= " where id_pb = ".$dd[0].';';

				$sql .= "insert into pibic_bolsa_historico ";
				$sql .= "(bh_protocolo,bh_data,bh_hora,";
				$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
				$sql .= "'".$dd[5]."','".date("Ymd")."','".date("H:i")."',";
				$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[9]."'); ";
				$rlt = db_query($sql);
			
			$rlt = db_query($sql);
			$sql = "";
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
			echo $sql;
			
		} else {
			$msg = "Projeto nгo cadastrado";
		}
	}


$cp = array();
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Alteraзгo do Projeto do Professor',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$S12','pb_contrato','Nъmero do contrato',True,True,''));
array_push($cp,array('$D8','pb_data_ativacao','Data da implementaзгo',True,True,''));
array_push($cp,array('$O N:NГO&S:SIM','','Confirma operaзгo ?',True,True,''));
array_push($cp,array('$B8','','Implantar agora',False,True,''));
array_push($cp,array('$H8','pb_protocolo','',False,True,''));
array_push($cp,array('$H4','','',True,True,''));
array_push($cp,array('$Q motivo_descricao:motivo_codigo:select * from pibic_motivo where motivo_tipo = 1 order by motivo_descricao','','Motivo',True,True,''));
$dd[2] = '004';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>