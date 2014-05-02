<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_email.php");
require($include."sisdoc_data.php");
$id_pesq = '88958022';

$rtipo = "relatório parcial";
$fld = "pb_relatorio_parcial";
$fld_nota = "pb_relatorio_parcial_nota";
$rtipoc ="RPARC";
$link = 'atividade_relatorio_parcial_acao.php';
$ic_msg = 'PIBIC_CPPAR';

if (strlen($dd[1]) == 0) { redirecina('main.php'); }

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = '".$dd[1]."' ";
$sql .= " and pb_status <> 'C' ";
$sql .= "order by pa_nome";
$rlt = db_query($sql);

////////////////////////////////////////////////////// MOSTRA DETALHES DO PROJETO
if ($line = db_read($rlt))
	{
	$rf = $line[$rtipo];
	
	if ($rf > 20000000)
		{
		echo '<BR><BR><H2><font color="red">Relatório já foi enviado</font></H2>';
		exit;
		}
	$rm = $line['pb_resumo'];
	$tit1 = $line['pb_titulo_projeto'];
	$tit2 = $line['doc_1_titulo'];
	$orientador = $line['pp_nome'];
	$proto = $line['pb_protocolo'];
	$professor_email = $line['pp_email'];
	$professor_email_1 = $line['pp_email_1'];
	$aluno = $line['pa_nome'];
	
	$pp_orientador = trim($line['pp_cracha']);
	$pp_aluno = trim($line['pa_cracha']);
	
	$bolsa = $line['pb_tipo'];
	require("../pibicpr/bolsa_tipo.php");
	$tipo_bolsa = $bolsa_nome;
	
	$contrato = trim($line['pb_contrato']);
	$status = trim($line['pb_status']);
	
	$texto = '<TABLE align="center" width="'.$tab_max.'" border=0 class="lt1" >';
	$texto .= '<TR valign="top"><TD align="right">';
	$texto .= '<TABLE align="center" width="'.$tab_max.'" border=0 class="lt1" >';
	$texto .= '<TR valign="top" width="'.$tab_max.'" align="center">';
	$texto .= '<TD align="left">';
	$texto .= '<CENTER><H1>Atividades</H1></CENTER>';
	$texto .= '<fieldset><legend>Plano de aluno</legend>';
	$texto .= 'Protocolo: '.$line['pb_protocolo'].'<BR>';
	$texto .= '<B>'.$tit2.'</B>';
	$texto .= '<BR>Orientador: '.$orientador.' ('.$pp_orientador.')';
	$texto .= '<BR><BR>';
	$texto .= '<B>'.$tit1.'</B>';
	$texto .= '<BR>Aluno: '.$aluno.' ('.$pp_aluno.')';
	$texto .= '<BR>';
	$texto .= '<BR>Tipo de Iniciação Científica: <B>'.$tipo_bolsa.'</B>';
	echo $texto;
	?>

	<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
	<?=$linka;?>
	<HR>
	<center>
	<?
	if ($line[$fld] > 20110101)
		{
		echo '<BR><BR><H2><font color="red">Relatório já foi enviado</font></H2>';
		require("foot.php");
		exit;
		}
	//	{ redirecina('main.php'); exit; }
	
	if ((strlen($dd[3]) == 0) or ((strlen(trim($_FILES['userfile']['name'])) == 0) and ($dd[3] != '2')))
		{ ?>
	<B>[Submeter <?=$rtipo?>]</B><BR>
	<?
	$sql = "select * from ic_noticia where nw_ref = 'PIBIC_RELPAR' ";
	$rrr = db_query($sql);
	?>
	<br/>
	<table width="95%" align="center">
	<TR><TD>
	<font class="lt2">
	<?
	if ($eline = db_read($rrr))
		{
		echo ($eline['nw_descricao']);
		}
	?>
	</TD></TR>
	</table>
	<BR>
	<form enctype="multipart/form-data" action="<?=$link;?>" method="POST">
	<input type="hidden" name="MAX_FILE_SIZE" value="300000000">
	Arquivo para anexar
	&nbsp;<input name="userfile" type="file" class="lt2">
	&nbsp;<input type="submit" value=" anexar " class="lt2" <?=$estilo?>>
	<input type="hidden" name="dd0" value="<?=$dd[0]?>">
	<input type="hidden" name="dd1" value="<?=$dd[1]?>">
	<input type="hidden" name="dd2" value="<?=$dd[2]?>">
	<input type="hidden" name="dd3" value="1">
	</form>
<? } else { 
		/////////////////////////////////////////////////////////// Confirmação de envio
		if ($dd[3] == '2') 
		{ ?>
			<CENTER>
			<font color="green"><B>O <?=$rtipo;?> foi enviado com sucesso!</B></font><BR>
			Um e-mail de confirmação foi enviado para <B><?
	
			$texto .= '</fieldset><BR>'.$rtipo.' entregue com sucesso em '.date("d/m/Y H:i:s");
			$texto .= '<BR>';
			$e3 = '[PIBIC] - Entrega de '.$rtipo.' - '.$aluno;
			$e4 = $texto;
			// e-mail de segurança
			$e1 = 'pibicpr@pucpr.br';
			enviaremail($e1,$e2,$e3,$e4);
		//	$e1 = 'rene@sisdoc.com.br';
		//	enviaremail($e1,$e2,$e3,$e4);
		
			//// Enviar para professor
			echo 'Confirmação para ';
			if (strlen($professor_email) > 0)
				{ 
					echo $professor_email.' '; 
					$e1 = $professor_email;
					enviaremail($e1,$e2,$e3,$e4);
					echo ','.$e1;
				}
			if (strlen($professor_email_1) > 0)
				{ 
					echo 'e '.$professor_email_1.' '; 
					$e1 = $professor_email_1;
					enviaremail($e1,$e2,$e3,$e4);
					echo ','.$e2;
				}
			
			?></B><BR> com o protocolo de entrega, guarde este e-mail.
			<?
			require("atividade_entrega_finaliza.php");
		} else { 
			require("atividade_entrega_upload.php");
			if ($ok == 1) { require("atividade_entrega_finaliza.php"); } 
			else {
				?>
				<script>
					alert('<?=$msge;?>');
				</script>
				<?
				}
	
			if ($ok == 1)
			{
			?></CENTER><? 	
			} else {
				echo '<font class="lt3"><font color="red"><CENTER>'.$msge.'</CENTER></font></font>';
				?>
				<BR><BR>
				<form method="post" action="atividade_relatorio_parcial_acao.php?dd0=<?=$dd[0];?>&dd1=<?=$dd[1];?>">
				<center><input type="submit" name="acao" value="VOLTAR >>>"></center>
				</form>
			<?
			}
		} ?>
<? } ?>
	
<?
/////////////////////////////////////////////////////////////////////////////////// Status CheckList
require("atividade_entrega_status.php");
?>
</fieldset>
<BR><BR>
<?
	$sql = "select * from pibic_bolsa_contempladas ";
	$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
	$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
	$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
	//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
	$sql .= " where pp_cracha = '".$id_pesq."'";
	$sql .= " and id_pb = 0".$dd[1];
	$sql .= " order by pa_nome";
	$rlt = db_query($sql);

	if ($line = db_read($rlt))
		{
		$ttp = LowerCase($line['pb_titulo_projeto']);
		$ttp = UpperCase(substr($ttp,0,1)).substr($ttp,1,strlen($ttp));	
		$bolsa = $line['pb_codigo'];
		$aluno = $line['pa_nome'];
		$status = $line['doc_status'];
		echo '<LI><B>'.$ttp.'</B>';
		echo '<BR>Aluno: '.$aluno;
		echo '<BR>['.$bolsa.'] '.$status;
		echo '</LI><BR>';
	
		echo '<form enctype="multipart/form-data" action="atividade_resumo.php" method="POST">';
		echo '<input type="hidden" name="MAX_FILE_SIZE" value="3000000">';
		echo 'Arquivo para anexar <input name="userfile" type="file" class="lt2">';
		echo '&nbsp;<input type="submit" value="e n v i a r" class="lt2">';
		echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
		echo '<input type="hidden" name="dd1" value="'.$dd[1].'">';
		echo '<input type="hidden" name="dd2" value="'.$dd[2].'">';
		echo '</form>';
		}
?>
</table>
<?
	}
require("foot_body.php");
require("foot.php");
?>