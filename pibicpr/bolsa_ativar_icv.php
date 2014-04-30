<?
require("cab.php");
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_data.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$S8','','Protocolo do aluno',True,True,''));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo order by pbt_edital, pbt_descricao','','Tipo de bolsa',True,True,''));
array_push($cp,array('$['.(date("Y")-1).'-'.(date("Y")).']','','Protocolo do aluno',True,True,''));

	echo '<CENTER><font class=lt5>Ativar projetos ICV</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	if ($saved > 0)
		{
			$ano = $dd[3];
			?><TABLE width="<?=$tab_max?>" align="center" class="lt1" border=1><TR><TD><?		
			$doc_area = '';
			$sql = "select * from pibic_submit_documento ";
			$sql .= " where doc_protocolo = '".$dd[1]."' ";
			$sql .= "limit 1 ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
				$docm = trim($line['doc_protocolo_mae']);
				$aluno = $line['doc_aluno'];
				$professor = $line['doc_autor_principal'];
				$protocolo = $line['doc_protocolo'];
				$titulo = $line['doc_1_titulo'];
				if (strlen($docm) == 0) { $msg .= '<BR>Este não é um plano de trabalho de aluno'; }
				echo '<H1>Plano do aluno</H1>';
				echo 'Título:'.$titulo;
				echo '<BR>protocolo:'.$protocolo;
				echo '<BR>aluno:'.$aluno;

				////////////////// recupera PROJETO DO PROFESSOR
					$sql = "select * from pibic_submit_documento ";
					$sql .= " where doc_protocolo = '".$docm."' ";
					$sql .= "limit 1 ";
					$xrlt = db_query($sql);
					if ($xline = db_read($xrlt))
						{
						echo '<H1>Projeto do professor</H1>';
						$tit_projeto = trim($xline['doc_1_titulo']);
						$doc_area = $xline['doc_area'];
						echo 'Título:'.$tit_projeto;
						echo '<BR>Área:'.$doc_area;
						}
				/////////////////////////////////////
				$sql = "select * from pibic_bolsa_contempladas ";
				$sql .= " where pb_protocolo = '".$dd[1]."' or (pb_aluno = '".$aluno."' and pb_status = 'A' and pb_ano = '".$ano."') ";
				$sql .= " limit 1 ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						echo '<BR><font color="red">Protocolo já cadastrado no sistema ou aluno já tem bolsa</font>!';
						echo '<BR>';
						echo 'Protocolo:'.$line['pb_protocolo'];
						echo '<BR>Bolsa tipo: '.$line['pb_tipo'];
						echo '<BR>Bolsa: '.$line['pb_codigo'];
					} else {
						print_r($line);
						////////// area do conhecimento
						echo '<HR>';
						$sql = "insert into pibic_bolsa_contempladas ";
						$sql .= "(pb_aluno,pb_professor,pb_protocolo,";
						$sql .= "pb_protocolo_mae,pb_tipo,pb_data,";
						$sql .= "pb_hora,pb_ativo,pb_ativacao,";
						
						$sql .= "pb_desativacao,pb_contrato,pb_titulo_projeto,";
						$sql .= "pb_titulo_plano,pb_fomento,pb_status,";
						$sql .= "pb_area_conhecimento,pb_codigo,pb_data_ativacao,";
						
						$sql .= "pb_data_encerramento,pb_relatorio_parcial, ";
						$sql .= "pb_ano ";
						$sql .= ") values (";
						$sql .= "'".$aluno."','".$professor."','".$protocolo."',";
						$sql .= "'".$docm."','".$dd[2]."',".date("Ymd").",";
						$sql .= "'".date("H:i")."',1,19000101,";
						
						$sql .= "19000101,'','".$tit_projeto."',";
						$sql .= "'".$titulo."','','@',";
						$sql .= "'".$doc_area."','',19000101,";
						$sql .= "19000101,0,";
						$sql .= $dd[3];
						$sql .= ")";
						$rlt = db_query($sql);
						echo '<BR>';
						echo '<font class="lt3"><font color="green">ICV Ativado com sucesso</font></font>';
					}
				}
			?></TD></TR></TABLE><?	
		}
	
echo $hd->foot();	
?>