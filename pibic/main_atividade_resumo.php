<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_email.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_data.php");
$id_pesq = '88958022';

$rtipo = "Resumo para publicação";
$cpf = "pb_relatorio_parcial";
$fld = "pb_resumo";
$rtipoc ="00031";

//$sql = "update pibic_bolsa_contempladas set pb_resumo = 0 ";
//$rlt = db_query($sql);

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
	$rf = $line['pb_relatorio_final'];
	$rf = $line['pb_resumo'];
	$tit1 = $line['pb_titulo_projeto'];
	$tit2 = $line['doc_1_titulo'];
	$orientador = $line['pp_nome'];
	$proto = $line['pb_protocolo'];
	$professor_email = $line['pp_email'];
	$professor_email_1 = $line['pp_email_1'];
	$aluno = $line['pa_nome'];
	$curso = $line['pa_curso'];
	$centro = $line['pa_centro'];
	$pp_orientador = trim($line['pp_cracha']);
	$pp_aluno = trim($line['pa_cracha']);
	if ($line['pb_resumo_nota'] == 1) { $rf = 19000101; }

	$nota = trim($line['pb_resumo_nota']);
	if (($nota == '1') or ($nota == '-1')) { $rf = 19000101; echo '=='; }


	$tipo_bolsa = $line['pb_tipo'];
	if ($tipo_bolsa == 'I') { $tipo_bolsa = 'Iniciação Científica Voluntária'; }
	if ($tipo_bolsa == 'P') { $tipo_bolsa = 'Bolsa PUCPR'; }
	if ($tipo_bolsa == 'C') { $tipo_bolsa = 'Bolsa CNPq'; }
	if ($tipo_bolsa == 'F') { $tipo_bolsa = 'Bolsa Fundação Araucária'; }
	if ($tipo_bolsa == 'E') { $tipo_bolsa = 'Bolsa Estratégica'; }
	if ($tipo_bolsa == 'U') { $tipo_bolsa = 'Bolsa Estratégica PUCPR'; }
	
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
?>

<?=$linka;?>
<font class="lt4"><CENTER><?=$tit2;?></CENTER></font>
<HR>
<center>
<?
if (round($rf) > 20000101)
	{ redirecina('main.php'); exit; }

$ddok = 1;
/// Monsta resumo
$dd[10] = '';
if (strlen($dd[20]) > 20) { $dd[10] = '<B>Introdução:</B> '.trim($dd[20]); 	 } else {$ddok = 0; }
if (strlen($dd[21]) > 20) { $dd[10] .= ' <B>Objetivo(s):</B> '.trim($dd[21]); 	 } else {$ddok = 0; }
if (strlen($dd[22]) > 20) { $dd[10] .= ' <B>Método:</B> '.trim($dd[22]); 		 } else {$ddok = 0; }
if (strlen($dd[23]) > 20) { $dd[10] .= ' <B>Resultado(s):</B> '.trim($dd[23]);  } else {$ddok = 0; }
if (strlen($dd[24]) > 20) { $dd[10] .= ' <B>Conclusão:</B> '.trim($dd[24]); 	 } else {$ddok = 0; }
if (strlen($dd[25]) < 20) {$ddok = 0; }
if (strlen($dd[25]) >= 20) 
	{
	$keys = array();
	$sk = ' '.$dd[25].';';
	while (strpos($sk,';') > 0)
		{
		$keyw = trim(substr($sk,0,strpos($sk,';')));
		$sk = ' '.substr($sk,strpos($sk,';')+1,strlen($sk));
		if (strlen($keyw) > 0) 
			{ 
			$keyw = upperCase(substr($keyw,0,1)).LowerCase(substr($keyw,1,strlen($keyw)));
			array_push($keys,$keyw); 
			$keyws .= $keyw.'; ';
			}
		}
	if (count($keys) < 3) { $ddok = 0; }
	if (count($keys) > 5) { $ddok = 0; }
	$dd[25] = $keyws;
	}


///
if ((strlen($dd[3]) == 0) or (($ddok == 0) and ($dd[3] != '2')))
	{ 
////////////////////////////////////// RECUPERA DADOS DOS AUTORES
if (strlen($dd[11]) == 0)
	{
	$dd[11] = '';
	$dd[11] .= trim($aluno).';'.$tipo_bolsa.chr(13);
	$dd[11] .= trim($orientador).';Orientador'.chr(13);
	$dd[11] .= 'Coorientador;(Excluir se não existir)'.chr(13);
	$dd[11] .= 'Colaborador;(Excluir se não existir)'.chr(13);
	$dd[11] .= trim($curso).' - '.trim($centro);
	}
?>
<B>[Submeter <?=$rtipo;?>]</B><BR>
Prezado professor, insira seu resumo no campo abaixo.
<form enctype="multipart/form-data" action="main_atividade_resumo.php" method="POST">
<input type="hidden" name="dd0" value="<?=$dd[0]?>">
<input type="hidden" name="dd1" value="<?=$dd[1]?>">
<input type="hidden" name="dd2" value="<?=$dd[2]?>">
<input type="hidden" name="dd3" value="1">
<table>
<TR><TD>Autores & Colaboradores da Pesquisa
<TR><TD><div><font class="lt1">Prezado professor, insira no quadro abaixo os participantes da pesquisa, como colaboradores e coorientadores. 
<BR>Observando que deve ser inserido um participante por linha, a qualificação e a instituição do participante deve ser separada por ponto e vírgula</font></div>
<TR><TD>
<textarea cols="70" rows="6" name="dd11"><?=$dd[11];?></textarea>
<TR><TD>Resumo
<TR><TD>
<input type="hidden" name="dd10" value="<?=$dd[10];?>">
<CENTER>
<table width="90%"><TR><TD>
<div align="justify">
<font class="lt2">
<?=mst($dd[10]);?>
</font>
</div>
</TD></TR>
<TR><TD>
<? if (count($keys) > 0) 
	{
	echo '<font class="lt2"><B>Palavras-chave: </B>';
	for ($rk = 0; $rk < count($keys); $rk++ )
		{
		echo $keys[$rk].'; ';
		}
	}
?>
<TR><TD></TD></TR>
<TR><TD><B>Introdução</B>
<TR><TD>
<textarea cols="70" rows="3" name="dd20"><?=$dd[20];?></textarea>
<TR><TD><B>Objetivo(s)</B>
<TR><TD>
<textarea cols="70" rows="3" name="dd21"><?=$dd[21];?></textarea>
<TR><TD><B>Método</B>
<TR><TD>
<textarea cols="70" rows="3" name="dd22"><?=$dd[22];?></textarea>
<TR><TD><B>Resultado(s)</B>
<TR><TD>
<textarea cols="70" rows="3" name="dd23"><?=$dd[23];?></textarea>
<TR><TD><B>Conclusão</B>
<TR><TD>
<textarea cols="70" rows="3" name="dd24"><?=$dd[24];?></textarea>

<TR><TD><B>Palavras-chave:</B>
<TR><TD><font class="lt1">Separe as palavras-chave por <B>ponto e virgula (;)	</B> (mínimo três e máximo de cinco palavras-chaves)</TD></TR>
<TR><TD>
<input type="text" name="dd25" value="<?=$dd[25];?>" size="80" maxlength="200">

</TD></TR>
</TABLE>
</table>
<?
//echo '>>'.strlen($dd[10]);^
$msg = '';
if ((strlen($dd[10]) < 200) and (strlen($dd[10]) > 1))
	{
	$msg = 'Resumo muito curto'.chr(13);
	}
	
if (strlen($dd[20]) < 20) { $msg .= 'Introdução, '; }
if (strlen($dd[21]) < 20) { $msg .= 'Objetivo(s), '; }
if (strlen($dd[22]) < 20) { $msg .= 'Método, '; }
if (strlen($dd[23]) < 20) { $msg .= 'Resultado(s), '; }
if (strlen($dd[24]) < 20) { $msg .= 'Conclusão ,'; }
if (strlen($dd[25]) < 20) { $msg .= 'Palavras-chave ,'; }
if (strlen($dd[25]) >= 20) 
	{
	if (count($keys) < 3) { $msg .= '. Palavras-chave inferior a três, '; }
	if (count($keys) > 5) { $msg .= '. Palavras-chave superior a cinco, ';  }
	}

if (strlen($msg) > 0)
	{
	$msg = 'Não foi localizado '.$msg;
	echo '<BR><font color="RED">'.mst($msg).'</font>';
	?>
	<script>
		alert('<?=$msg;?>');
	</script>
	<?
	}
?>
<BR>
<input type="submit" name="acao" value="enviar resumo >>">
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
	
	?></B><BR> com o protocolo de entrega, guarde este e-mail.
	<?
		require("main_atividade_finaliza_resumo.php");
	} else { 
		?>
		<table bgcolor="#ffffff" width="<?=$tab_max;?>" border=0 >
		<Center><font color="red">Prezado professor, verifique se o texto está correto e confirme a submissão.</font>
		<BR><BR>
		<TR align="center"><TD colspan="3">
		<div align="right">
		<?=mst_autor($dd[11],2);?>		
		</div>
		<div align="left"><font class="lt0"><?=mst_autor($dd[11],3);?></font>
		<BR><BR>RESUMO<BR>
		</div>
		
		<div align="justify">
		<font class="lt2">
		<?=$dd[10];?>
		</font>
		</div>
		<BR>
		<div align="left">
		<? if (count($keys) > 0) 
		{
			echo '<font class="lt2"><B>Palavras-chave: </B>';
			for ($rk = 0; $rk < count($keys); $rk++ )
				{
				echo $keys[$rk].'; ';
				}
			}
		?>
		</div>
		<BR>
		<BR>		
		<TR align="center"><TD>
		<form method="post">
		<input type="submit" name="acao" value="Confirmar submissão">
		<input type="hidden" name="dd0" value="<?=$dd[0]?>">
		<input type="hidden" name="dd1" value="<?=$dd[1]?>">
		<input type="hidden" name="dd2" value="<?=$dd[2]?>">
		<input type="hidden" name="dd10" value="<?=$dd[10]?>">
		<input type="hidden" name="dd11" value="<?=$dd[11]?>">

		<input type="hidden" name="dd20" value="<?=$dd[20]?>">
		<input type="hidden" name="dd21" value="<?=$dd[21]?>">
		<input type="hidden" name="dd22" value="<?=$dd[22]?>">
		<input type="hidden" name="dd23" value="<?=$dd[23]?>">
		<input type="hidden" name="dd24" value="<?=$dd[24]?>">
		<input type="hidden" name="dd25" value="<?=$dd[25]?>">

		<input type="hidden" name="dd3" value="2">
		</form>
		</TD><TD>&nbsp;&nbsp;&nbsp;</TD><TD>
		<form method="post">
		<input type="submit" name="acao" value="Submeter uma nova versão">
		<input type="hidden" name="dd0" value="<?=$dd[0]?>">
		<input type="hidden" name="dd1" value="<?=$dd[1]?>">
		<input type="hidden" name="dd2" value="<?=$dd[2]?>">
		<input type="hidden" name="dd10" value="<?=$dd[10]?>">
		<input type="hidden" name="dd11" value="<?=$dd[11]?>">
		
		<input type="hidden" name="dd20" value="<?=$dd[20]?>">
		<input type="hidden" name="dd21" value="<?=$dd[21]?>">
		<input type="hidden" name="dd22" value="<?=$dd[22]?>">
		<input type="hidden" name="dd23" value="<?=$dd[23]?>">
		<input type="hidden" name="dd24" value="<?=$dd[24]?>">
		<input type="hidden" name="dd25" value="<?=$dd[25]?>">
		
		</form>
		</TD></TR>
		</table>
		</CENTER>
	<? } ?>
<? } ?>

<?
/////////////////////////////////////////////////////////////////////////////////// Status CheckList
require("main_atividade_status.php");
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