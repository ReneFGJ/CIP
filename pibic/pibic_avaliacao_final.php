<?
ob_start();
echo '<center>';
//echo '<H2><CENTER>EM MANUTENÇÃO</CENTER></H2>';
//exit;
require("db.php");
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require("../_class/_class_message.php");
require("../pibic/_ged_config.php");

$key = md5('pibic'.date("Y").trim($dd[0]));

$id_pesq = $dd[2];
$id = $dd[0];

$id = sonumero($dd[0]);

$sql = "select ppp.pp_status as sta, ppp.id_pp as xx, * from pibic_parecer_".date("Y")." as ppp ";
$sql .= "inner join pibic_bolsa_contempladas on pp_protocolo = pb_protocolo ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where ppp.id_pp = ".$id;
$sql .= " order by pa_nome";

//$sql = "select * from pibic_parecer_2010 where id_pp = ".$id;

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$titulo_proj = trim($line['pb_titulo_projeto']);
	$titulo_plano = trim($line['doc_1_titulo']);
	$protocolo = trim($line['pp_protocolo']);
	$protocolom = trim($line['pb_protocolo_mae']);
	$sta = $line['sta'];
	$aluno = $line['pa_nome'];
	$prof = $line['pp_nome'];
	$resumo = $line['pibic_resumo_text'];
	}

$sel10 = array("","","","","","");
$sel15 = array("","","","","","");
$msg_10 = array("","Excelente. Nada a corrigir",
		"Bom. Existem pequenos erros que precisam ser corrigidos (especificá-los nos comentários abaixo).",
		"Regular. Muitas correções são necessárias (especificá-las nos comentários).",
		"Ruim. O relatório precisa ser refeito (comentar).");
if (strlen($dd[10]) > 0) { $sel10[$dd[10]] = 'checked'; }

$msg_15 = array("","Excelente. Nada a corrigir",
		"Bom. Existem pequenos erros que precisam ser corrigidos (especificá-los nos comentários abaixo).",
		"Regular. Muitas correções são necessárias (especificá-las nos comentários).",
		"Ruim. O RESUMO precisa ser refeito (comentar).");
if (strlen($dd[15]) > 0) { $sel15[$dd[15]] = 'checked'; }

$sel11 = array("","","","","","","");
$msg_11 = array("","Excelente. As atividades foram executadas dentro do cronograma previsto.",
		"Bom. A maior parte das atividades previstas foram cumpridas, não ocorrendo comprometimento da pesquisa. (Comentar.)",
		"Houve algumas mudanças devidamente justificadas nos objetivos e no cronograma inicialmente previstos. (Comentar.)",
		"Regular. Importante atraso no cronograma que poderá comprometer o cumprimento dos objetivos iniciais propostos. (Comentar.)",
		"Ruim. Severo atraso no cronograma ou mudança não justificada, ou não apropriada nos objetivos e no cronograma inicialmente propostos. (Comentar.)");
if (strlen($dd[11]) > 0) { $sel11[$dd[11]] = 'checked'; }

$sel12 = array("","","","");
$msg_12 = array("","Altamente relevantes para prosseguimento das atividades. As conclusões extraídas dos dados obtidos são satisfatórias.",
	"Bons. Mais conclusões sobre os dados apresentados são necessárias. (Comentar.)",
	"Regulares. Dados obtidos não são analisados dificultando a avaliação da sua relevância no contexto do projeto. (Comentar.)",
	"Ruins. Poucos (ou nenhum) resultados relevantes no contexto do projeto foram apresentados. (Comentar.)");
if (strlen($dd[12]) > 0) { $sel12[$dd[12]] = 'checked'; }

////////
$sel14 = array("","","");
$nota = array(0,2,1);
$msg_14 = array("","Pendência, necessária correções","Aprovado");
if (strlen($dd[14]) > 0) { $sel14[$dd[14]] = 'selected'; }


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>::Ficha de avaliação - Relatório Final:: PIBIC-PUCPR </title>
	<link rel="STYLESHEET" type="text/css" href="css/pibic.css">		
</head>

<body bgcolor="#004EC3">
<table width="610" border="0" align="center" bgcolor="#ffffff" class="lt1" cellpadding="4">
<TR><TD valign="top"><img src="img/logo_instituicao.gif" alt="" width="73" height="84" border="0">
<TD><img src="img/homeHeaderLogoImage.jpg" width="729" height="143" alt="">
<? 
$ky2 = substr(md5($dd[3].$dd[0]),5,10);

if (($key <> $dd[1]) and ($ky2 <> $dd[1]))
	{
	echo '<TR><TD colspan="2">';
	echo '<CENTER>';
	echo '<font class="lt5"><font color="red">';
	echo 'Chave de acesso Incorreta! Contate o gestor pelo e-mail pibicpr@pucpr.br';
	echo '</CENTER>';
	exit;	
	}
?>

<TR><TH colspan="2" bgcolor="#E6E3FB">Projetos e Plano de trabalho</TD></TR>
<TR><TD class="lt0" colspan="2">Projeto do professor</TD></TR>
<TR><TD class="lt2" colspan="2"><?=$titulo_proj;?></TD></TR>
<TR><TD class="lt1" colspan="2">Prof.(a) Orientador(a): <B><?=$prof;?></B></TD></TR>
<TR><TD class="lt0" colspan="2">Plano do alunos</TD></TR>
<TR><TD class="lt2" colspan="2"><?=$titulo_plano;?></TD></TR>
<TR><TD class="lt1" colspan="2">Aluno(a): <B><?=$aluno;?></B></TD></TR>
<TR><TD class="lt1" colspan="2">Protocolo: <B><?=$protocolo.'/'.$protocolom;?></B></TD></TR>
<TR><TD>&nbsp;</TD></TR>
<?
if ($sta != '@')
	{
	echo '<TR><TD colspan="2">';
	echo '<CENTER>';
	echo '<font class="lt5"><font color="green">';
	echo 'Sua avaliação foi enviada com sucesso !';
	echo '</CENTER>';
	exit;
	}

echo '<TR><TD colspan="2">';
$ged->protocol = $protocolo;
echo $ged->filelist();

?>

<form method="post" action="pibic_avaliacao_final.php">
<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<input type="hidden" name="dd1" value="<?=$dd[1];?>">
<input type="hidden" name="dd2" value="<?=$dd[2];?>">
<input type="hidden" name="dd3" value="<?=$dd[3];?>">
<input type="hidden" name="dd4" value="<?=$dd[4];?>">
<TR><TH colspan="2" bgcolor="#E6E3FB">Ficha de avaliação</TD></TR>
<TR><TD colspan="2">
<HR>
<font class="lt5">Sobre o Relatório Final</font>
<HR>
1) <B>Clareza, legibilidade e objetividade (português, organização geral do texto, figuras, gráficos, tabelas, referências, etc.):</B><BR>
<input type="radio" name="dd10" value="1" <?=$sel10[1];?> ><?=$msg_10[1];?><BR>
<input type="radio" name="dd10" value="2" <?=$sel10[2];?> ><?=$msg_10[2];?><BR>
<input type="radio" name="dd10" value="3" <?=$sel10[3];?> ><?=$msg_10[3];?><BR>
<input type="radio" name="dd10" value="4" <?=$sel10[4];?> ><?=$msg_10[4];?><BR>
<BR><BR>
2) <B>Cumprimento do cronograma previsto:</B><BR>
<input type="radio" name="dd11" value="1" <?=$sel11[1];?> ><?=$msg_11[1];?><BR>
<input type="radio" name="dd11" value="2" <?=$sel11[2];?> ><?=$msg_11[2];?><BR>
<input type="radio" name="dd11" value="3" <?=$sel11[3];?> ><?=$msg_11[3];?><BR>
<input type="radio" name="dd11" value="4" <?=$sel11[4];?> ><?=$msg_11[4];?><BR>
<input type="radio" name="dd11" value="5" <?=$sel11[5];?> ><?=$msg_11[5];?><BR>
<BR><BR>
3) <B>Resultados finais obtidos:</B><BR>
<input type="radio" name="dd12" value="1" <?=$sel12[1];?> ><?=$msg_12[1];?><BR>
<input type="radio" name="dd12" value="2" <?=$sel12[2];?> ><?=$msg_12[2];?><BR>
<input type="radio" name="dd12" value="3" <?=$sel12[3];?> ><?=$msg_12[3];?><BR>
<input type="radio" name="dd12" value="4" <?=$sel12[4];?> ><?=$msg_12[4];?><BR>
<BR><BR>
<HR>
<font class="lt5">Sobre o Resumo</font>
<HR>
<div align="justify" class="lt1"><?=$resumo;?></div>
<BR><BR>
1) <B>Clareza, legibilidade e objetividade (digitação, português e organização geral) :</B><BR>
<input type="radio" name="dd15" value="1" <?=$sel15[1];?> ><?=$msg_15[1];?><BR>
<input type="radio" name="dd15" value="2" <?=$sel15[2];?> ><?=$msg_15[2];?><BR>
<input type="radio" name="dd15" value="3" <?=$sel15[3];?> ><?=$msg_15[3];?><BR>
<input type="radio" name="dd15" value="4" <?=$sel15[4];?> ><?=$msg_15[4];?><BR>
<BR><BR>
2) <B>Comentários sobre o resumo (obrigatório):</B><BR>
<textarea cols="70" rows="5" name="dd16"><?=$dd[16];?></textarea>
<BR><BR>
3) <B>Comentários sobre a avaliação (obrigatório)</B><BR>
(Justifique aqui as opções marcadas acima, fazendo as sugestões que julgar adequadas para melhorar a qualidade do relatório apresentado e fazendo sua apreciação geral do trabalho.)</B><BR>
<textarea cols="60" rows="6" name="dd13"><?=$dd[13];?></textarea>
<HR>
<font class="lt5">Avaliação do Relatório Final e do Resumo</font>
<HR></B>
4) <B>Resultado da avaliação do Relatório Final e do Resumo</B><BR>
<select name="dd14" size="1">
<option value="" <?=$sel14[0];?> ><?=$msg_14[0];?></option>
<option value="2" <?=$sel14[1];?>><?=$msg_14[1];?></option>
<option value="1" <?=$sel14[2];?>><?=$msg_14[2];?></option>
</select>


<BR><BR><input type="submit" name="acao" value="Enviar avaliação">
</form>
<BR><BR><BR>
<?

if ((strlen($dd[10]) > 0) and (strlen($dd[11]) > 0) and (strlen($dd[12]) > 0) and (strlen($dd[13]) > 0) and (strlen($dd[14]) > 0) and (strlen($dd[15]) > 0))
	{
		$sql = "update pibic_bolsa_contempladas set pb_relatorio_final_nota = ".$nota[$dd[14]]." ";
		$sql .= " , pb_resumo_nota = ".round($nota[$dd[14]])." ";
		$sql .= " where pb_protocolo = '".$protocolo."' ";
		$rlt = db_query($sql);

		$sql = "update pibic_parecer_".date("Y")." set 
					pp_abe_07 = '".$msg_10[$dd[10]]."'";
		$sql .= ", pp_abe_01 = '".$msg_11[$dd[11]]."'";
		$sql .= ", pp_abe_02 = '".$msg_12[$dd[12]]."'";
		$sql .= ", pp_abe_03 = '".$dd[13]."'";
		$sql .= ", pp_abe_04 = '".$msg_14[$dd[14]]."'";
		$sql .= ", pp_abe_05 = '".$msg_15[$dd[15]]."'";
		$sql .= ", pp_abe_06 = '".$dd[16]."'";
		$sql .= ", pp_p01 = '".$dd[14]."' ";
		$sql .= ", pp_p02 = '".$dd[10]."' ";
		$sql .= ", pp_p03 = '".$dd[11]."' ";
		$sql .= ", pp_p04 = '".$dd[12]."' ";
		$sql .= ", pp_parecer_data = '".date("Ymd")."' ";
		$sql .= ", pp_abe_08 = '".$dd[15]."' ";
		$sql .= ", pp_parecer_hora = '".date("H:i")."' ";
		$sql .= ", pp_status = 'F' ";
		$sql .= " where id_pp = ".$id;
		$rlt = db_query($sql);
		
		/////////////////////// RECUEPRA TEXTO
		$tipo = "rel_fin_con";	
		$sql = "select * from ic_noticia where nw_ref = '".$tipo."' and nw_journal = ".$jid;
		$rrr = db_query($sql);
		if ($line = db_read($rrr))
			{
			$texto = $line['nw_descricao'];
			}
		$texto .= '<BR>'.$dd[13];
		$texto = troca($texto,'$titulo',$titulo_plano);
		$texto = troca($texto,'$aluno',$aluno);
		$texto = troca($texto,'$professor',$prof);
		$texto = troca($texto,'$protocolo',$protocolo);
		$texto = troca($texto,'$nome',$pp_nome);
		
		/////////////////////////////////////
		$e3 = '[PIBIC] - Avaliação do Relatório Final e Resumo enviado - '.$aluno;
		$e4 = mst($texto);
		echo '<BR><BR>enviado para:';
		enviaremail('rene@sisdoc.com.br',$e2,$e3,$e4);
		enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
		redirecina('pibic_avaliacao_final.php?dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.$dd[3].'&dd4='.$dd[4]);
	} else {
		if (strlen($acao) > 0)
			{
			?>
			<script>
				alert('Dados incompletos!');
			</script>
			<?
			}
	}
?>
</TD></TR></table>


</body>
</html>
