<?
require($include.'sisdoc_security_post.php');
require($include.'sisdoc_debug.php');
$nl = chr(13).chr(10);
/////////////////////////////////////// Status
$bt_acao = array();
/////////////// Projeto enviado
if ($status == 'A')
	{
	array_push($bt_acao,array('Recusar submissão'.chr(13).chr(10).'Devolver ao autor','@'));
	array_push($bt_acao,array('Indicar parecerista'.chr(13).chr(10).'peer review','B'));
	array_push($bt_acao,array('Cancelar submissão'.chr(13).chr(10).'Devolver ao autor','X'));
	}
	
if ($status == 'B')
	{
	array_push($bt_acao,array('Enviar para parecerista'.chr(13).chr(10).'peer review','C'));
	array_push($bt_acao,array('Devolver para o autor'.chr(13).chr(10).'para correções','@'));
//	array_push($bt_acao,array('Cancelar submissão'.chr(13).chr(10).'Devolver ao autor','X'));
	}	

if ($status == 'C')
	{
	//require("ed_reol_parecerista.php");
	array_push($bt_acao,array('Novos pareceristas'.chr(13).chr(10).'peer review','B'));
	array_push($bt_acao,array('Finalizar avaliação','D'));
	}	
	
if ($status == 'D')
	{
	//require("ed_reol_parecerista.php");
	array_push($bt_acao,array('Novos pareceristas'.chr(13).chr(10).'peer review','B'));
	array_push($bt_acao,array('Finalizar pontuação','E'));
	}		
	
if ($status == '@')
	{
	array_push($bt_acao,array('Cancelar submissão'.chr(13).chr(10).'Devolver ao autor','X'));
	}

if ($status == 'E')
	{
	array_push($bt_acao,array('Indicar parecerista'.chr(13).chr(10).'peer review','B'));
	}	
		
if ($status == 'X')	
	{
	echo '<CENTER><font class="lt5"> * * * CANCELADO * * *</font></CENTER><HR>';
	}
/////////////////////////////////////// executa a acao
if (strlen($dd[50]) > 0)
	{
	if (strlen($dd[51]) == 0)
		{
			?>
			<script>
				alert('Click no SIM para confirmar a ação');
			</script>
			<?
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
			$stm = '';
			for ($x=0; $x < count($bt_acao);$x++)
				{
				if (trim($bt_acao[$x][0]) == trim($dd[50])) { $stm = $bt_acao[$x][1]; }
				}
			if (strlen($stm) > 0)
				{
				$sql = "begin; ".chr(13).chr(10);
				$sql = "update ".$tabela." ";
				$sql .= " set doc_status = '".$stm."',  ";
				$sql .= " doc_update = ".date("Ymd")." ";
				$sql .= " where (id_doc = ".$dd[0];
				$sql .= " or doc_protocolo_mae = '".$prj_nr."')";
				$sql .= " and doc_status <> 'X' ";
				$sql .= "; ".chr(13).chr(10);
				
				$sql .= "insert into ".$tabela."_log ";
				$sql .= "(slog_data,slog_hora,slog_status_de,";
				$sql .= "slog_status_para,slog_conent,slog_ip,";
				$sql .= "slog_user_id,slog_protocolo)";
				$sql .= " values ";
				$sql .= "('".date("Ymd")."','".date("H:i")."','".$status."',";
				$sql .= "'".$stm."','".$dd[52]."','".$ip."',";
				$sql .= "0".$user_id.",'".strzero($dd[0],7)."');".chr(13).chr(10);
				$sql .= "commit;";
				$rlt = db_query($sql);
				//////////////////////////////////////////////////////////////// enviar e-mail
				////////////////////////
				if ($status = '@') { $texto ="SUB_DEVOLU"; $destino = true; }
				if ($status = 'A') { $texto ="PAR_NADA"; $destino = false; }
				if ($status = 'B') { $texto ="PAR_NADA"; $destino = false; }
				if ($status = 'C') { $texto ="PAR_AVAL"; $destino = false; }
				
				$sql = "select * from ic_noticia where nw_ref = '".$texto."'";
				$sql .= "  and nw_journal = '".$jid."' ";
				$rrr = db_query($sql);
				$texto = 'Título: <B>'.$ttitulo.'</B><BR>';
				$texto .= 'protocolo: '.$protocolo.'<HR>';
				if ($eline = db_read($rrr))
				{
					$sC = $eline['nw_titulo'];
					$texto .= $eline['nw_descricao'];			
				}			
				$texto .= '<BR><B>'.$dd[52].'</B>'.$nl;
				$texto_original = $texto;
				
				global $http_site;

				if ($stm == 'C')
				{
				require("ed_reol_submit_acao_c20.php");
				require("ed_reol_submit_acao_c21.php");
				require("ed_reol_submit_acao_c22.php");
				exit;
				}
			}
			//////////////////////////////////////////////////////////////////////////////
			redirecina('ed_pibic_submit_article.php?dd0='.$dd[0]);
			exit;
		}
	}
//////////////////////////////////////////////////////
$bt_style = 'style = "width:200; height:50 "';

	
$t_col = 0;
$sca .= '<TR>';
for ($ka = 0;$ka < count($bt_acao);$ka++)
	{
	$t_col++;
	$sca .= '<TD align="center">';
	$sca .= '<input type="submit" name="dd50" value="'.$bt_acao[$ka][0].'" '.$bt_style.' >';
	$sca .= '</TD>';
	}
$sca .= '</TR>';
/////////////// Informações complementares
if ($t_col > 0)
	{
	$sc .= '<font class="lt4">Ações para este manuscrito:</font>';
	$sc .= '<TABLE width="100%" align="center" border=0>';
	$sc .= '<TR><TD>';
	$sc .= $sp;
	$sc .= '<form method="post" action="ed_pibic_submit_article.php">';	

	$sc .= '<TR><TD colspan="'.$t_col.'">';
	$sc .= 'Informações, orientações e comentários<BR>';
	$sc .= '<textarea cols="80" rows="4" name="dd52">'.$dd[52].'</textarea>';
	
////////////// Caixa de confirmação
	$sc .= '<TR><TD colspan="'.$t_col.'">';
	$sc .= '<input type="checkbox" name="dd51" value="1">SIM, confirmo a operação';
	
	$sc .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
	}
/////////////// Insere os botoes de acao no HTML
$sc .= $sca;

if ($status == 'B')
		{ require("ed_reol_submit_acao_b.php"); }
if ($status == 'B')
		{ require("ed_reol_submit_acao_b_pucpr.php"); }
		
$sc .= '</form>';
$sc .= '</table>';
?>