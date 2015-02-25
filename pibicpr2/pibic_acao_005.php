<?
$tabela = "pibic_bolsa_contempladas";

if ((strlen($dd[5]) == 1)  and ($dd[6] == 'S') and ($dd[3] != $dd[5]))
	{
		$tpa = "";
		$tpb = "";
		if ($dd[3] == 'A') { $tpa = 'Qualificado'; }
		if ($dd[3] == 'I') { $tpa = 'ICV'; }
		if ($dd[3] == 'F') { $tpa = 'Fundaчуo Araucсria'; }
		if ($dd[3] == 'P') { $tpa = 'PUCPR'; }
		if ($dd[3] == 'C') { $tpa = 'CNPq'; }

		if ($dd[5] == 'I') { $tpb = 'ICV'; }
		if ($dd[5] == 'F') { $tpb = 'Fundaчуo Araucсria'; }
		if ($dd[5] == 'P') { $tpb = 'PUCPR'; }
		if ($dd[5] == 'C') { $tpb = 'CNPq'; }
		
			$histo = "Troca de bolsa de ".$tpa." para ".$tpb;

			$sql = "update ".$tabela." set ";
			$sql .= "pb_tipo = '".$dd[5]."'  ";
			$sql .= " where id_pb = ".$dd[0].';';

				$sql .= "insert into pibic_bolsa_historico ";
				$sql .= "(bh_protocolo,bh_data,bh_hora,";
				$sql .= "bh_log,bh_historico,bh_aluno_1,bh_aluno_2,bh_motivo) values (";
				$sql .= "'".$dd[5]."','".date("Ymd")."','".date("H:i")."',";
				$sql .= "0".$user_id.",'".$histo."','".$dd[3]."','".$dd[4]."','".$dd[10]."'); ";
				$rlt = db_query($sql);
			
			$rlt = db_query($sql);

			$sql = "update pibic_bolsa_contempladas set pb_codigo = '' ";	
			$sql .= " where pb_protocolo = '".$dd[7] ."' ";
			$xrlt = db_query($sql);

			$sql = "";
			redirecina("pibic_bolsas_contempladas.php?dd0=".$dd[0]);
			
			
		} else {
			$msg = "Projeto nуo cadastrado";
		}

$cp = array();
$op = "A:Aprovados&I:ICV&C:CNPq&F:Fundaчуo Araucсria&P:PUCPR";
array_push($cp,array('$H4','id_pb','id_pb',False,True,''));
array_push($cp,array('$A8','','Alteraчуo do Tipo de Bolsa',False,False,''));
array_push($cp,array('$HV','',$dd[2],False,True,''));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo order by pbt_descricao','pb_tipo','Bolsa aprovada',False,False,''));

array_push($cp,array('$A8','','Alteraчуo para',False,False,''));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo order by pbt_descricao','pb_tipo','Bolsa aprovada',False,False,''));
array_push($cp,array('$O N:NУO&S:SIM','','Confirma operaчуo ?',False,True,''));
array_push($cp,array('$S8','pb_protocolo','Protocolo de Submissуo',False,False,''));
array_push($cp,array('$B8','','Alterar agora',False,True,''));
array_push($cp,array('$H4','','',True,True,''));
array_push($cp,array('$Q mt_descricao:mt_codigo:select * from pibic_motivos where mt_ativo = 1 order by mt_descricao','','Motivo',True,True,''));


$dd[2] = '004';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
exit;
?>