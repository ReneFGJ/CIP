<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_email.php");
$id_pesq = '88958022';

$rtipo = "relatório parcial";
$rtipoc ="RPARC";



$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pb = '".$dd[1]."'";
$sql .= "order by pa_nome";
$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
//	print_r($line);
	$tit1 = $line['pb_titulo_projeto'];
	$tit2 = $line['doc_1_titulo'];
	$orientador = $line['pp_nome'];
	$proto = $line['pb_protocolo'];
	$professor_email = $line['pp_email'];
	$professor_email_1 = $line['pp_email_1'];
	$aluno = $line['pa_nome'];
	
	$pp_orientador = trim($line['pp_cracha']);
	$pp_aluno = trim($line['pa_cracha']);
	
	$tipo_bolsa = $line['pb_tipo'];
	if ($tipo_bolsa == 'I') { $tipo_bolsa = 'Iniciação Científica Voluntária'; }
	if ($tipo_bolsa == 'P') { $tipo_bolsa = 'Bolsa PUCPR'; }
	if ($tipo_bolsa == 'C') { $tipo_bolsa = 'Bolsa CNPq'; }
	if ($tipo_bolsa == 'F') { $tipo_bolsa = 'Bolsa Fundação Araucária'; }
	
	$contrato = trim($line['pb_contrato']);
	$status = trim($line['pb_status']);
	
	if (strlen($contrato) > 0)
		{
		$local = $_SERVER['DOCUMENT_ROOT'].'/reol';
		$dire = $local.'/pibicpr/docs/2009/12';
		$dire .= '/'.$contrato.'.pdf';
		
		if (file_exists($dire))
			{
			$linka = '<BR><A HREF="/reol/pibicpr/docs/2009/12/'.$contrato.'.pdf" target="_new">Contrato do aluno '.$contrato.'</A>';
			}
		}
//	print_r($line);

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
?>

<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
<?=$linka;?>
<HR>
<center>
<?
if ($line['pb_relatorio_parcial'] <> 0)
	{ exit; }
if ((strlen($dd[3]) == 0) or (strlen(trim($_FILES['userfile']['name'])) == 0))
	{ ?>
<B>[Submeter relatório parcial]</B><BR>
Prezado professor, anexe o <?=$rtipo;?> em formado PDF.
<form enctype="multipart/form-data" action="main_atividade.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
Arquivo para anexar
&nbsp;<input name="userfile" type="file" class="lt2">
&nbsp;<input type="submit" value=" anexar " class="lt2" <?=$estilo?>>
<input type="hidden" name="dd0" value="<?=$dd[0]?>">
<input type="hidden" name="dd1" value="<?=$dd[1]?>">
<input type="hidden" name="dd2" value="<?=$dd[2]?>">
<input type="hidden" name="dd3" value="1">
</form>
<? } else { 
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
	

	if (strlen($professor_email) > 0)
		{ 
			echo $professor_email.' '; 
			$e1 = $professor_email;
			enviaremail($e1,$e2,$e3,$e4);
		}
	if (strlen($professor_email_1) > 0)
		{ 
			echo 'e '.$professor_email_1.' '; 
			$e1 = $professor_email_1;
			enviaremail($e1,$e2,$e3,$e4);
		}
	
	?></B> com o protocolo de entrega.
	<?
		require("main_atividade_finaliza.php");
	} else { 
		require("main_atividade_upload.php");
		?>
		<Center>Prezado professor, verifique se o aquivo anexado está correto e confirme a submissão.
		<BR><BR>
		<B><A HREF="<?=site.'/reol/pibicpr/docs/'.$updir.'/'.$xfilename;?>" target="new"><?=$xfilename;?>
		<BR>
		<TR align="center"><TD>
		<form method="post">
		<input type="submit" name="acao" value="Confirmar submissão">
		<input type="hidden" name="dd0" value="<?=$dd[0]?>">
		<input type="hidden" name="dd1" value="<?=$dd[1]?>">
		<input type="hidden" name="dd2" value="<?=$dd[2]?>">
		<input type="hidden" name="dd3" value="2">
		</form>
		</TD><TD>&nbsp;&nbsp;&nbsp;</TD><TD>
		<form method="post">
		<input type="submit" name="acao" value="Submeter uma nova versão">
		<input type="hidden" name="dd0" value="<?=$dd[0]?>">
		<input type="hidden" name="dd1" value="<?=$dd[1]?>">
		<input type="hidden" name="dd2" value="<?=$dd[2]?>">
		</form>
		</TD></TR>
		</table>
		</CENTER>
	<? } ?>
<? } ?>

<?
$img = '<img src="img/icone_editar.gif" width="20" height="19" alt="">';
if ($dd[3] == '2')
	{ $img = '<img src="img/icone_check.jpg" width="20" height="20" alt="">'; } 
?>
</center>
<HR>
<table width="100%" class="lt1">
<TR><TH colspan="2">Cronograma de atividades</TH></TR>
<TR><TD width="20"><img src="img/icone_check.jpg" width="20" height="20" alt=""></TD><TD>Projeto de pesquisa</TD></TR>
<TR><TD><img src="img/icone_check.jpg" width="20" height="20" alt=""></TD><TD>Plano do aluno</TD></TR>
<?
/* <TR><TD><?=$img;?---><B></TD><TD>Relatório parcial (21/fev. a 08/mar./2010)</B></TD></TR> */
?>
<TR><TD height="20"></TD><TD>Relatório Final (01/Ago.. a 05/Ago./2011)</TD></TR>
<TR><TD height="20"></TD><TD>Resumo (01/Ago. a 05/Ago./2011)</TD></TR>
</table>
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
		print_r($line);
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