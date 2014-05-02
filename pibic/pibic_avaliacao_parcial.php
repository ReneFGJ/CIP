<?
require("db.php");
require($include."sisdoc_email.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_colunas.php");


$secu = "pibicpr2010";
$key = substr(md5($secu.$dd[2].$dd[3].$dd[0]),5,10);

$id_pesq = $dd[2];
$id = $dd[0];

$id = sonumero($dd[0]);

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where id_pp = ".$id;
$sql .= " order by pa_nome";

//$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_nota = 1 where id_pp = ".$id;
//echo $sql;
//exit;
//$rlt = db_query($sql);

$sql = "select ppp.pp_status as sta, * from pibic_parecer_2011 as ppp ";
$sql .= "inner join pibic_bolsa_contempladas on pp_protocolo = pb_protocolo ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where ppp.id_pp = ".$id;
$sql .= " order by pa_nome";

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
	}

$sel10 = array("","","","","","");
$msg_10 = array("","<B>Excelente</B>.",
		"<B>Bom</B> <font color=blue>(existem pequenos ajustes que precisem ser corrigidos)</font>.",
		"<B>Regular</B> <font color=blue>(muitas correções são necessárias)</font>.",
		"<B>Ruim</B> <font color=blue>(o relatório precisa ser refeito)</font>.");
if (strlen($dd[10]) > 0) { $sel10[$dd[10]] = 'checked'; }
		

$sel11 = array("","","","","","","");
$msg_11 = array("","<B>Excelente</B> <font color=blue>( as atividades estão sendo realizadas dentro do cronograma previsto)</font>.",
		"<B>Bom</B> <font color=blue>(a maior parte das atividades previstas foi cumprida. Houve algumas mudanças nos objetivos e/ou cronograma, as quais foram devidamente justificadas)</font>.",
//		"<B>Houve algumas mudanças devidamente justificadas nos objetivos e no cronograma inicialmente previstos. (Comentar.)",
		"<B>Regular</B> <font color=blue>(importante atraso no cronograma que poderá comprometer o cumprimento dos objetivos inicias propostos. Há necessidade de ajuste no cronograma e/ou objetivos do projeto. Justificativas devem ser apresentadas)</font>.",
		"<B>Ruim</B> <font color=blue>(severo atraso no cronograma ou mudança não justificada, ou não apropriada em relação aos objetivos iniciais propostos).</font>");
if (strlen($dd[11]) > 0) { $sel11[$dd[11]] = 'checked'; }

$sel12 = array("","","","");
$msg_12 = array("","<B>Excelente</B> <font color=blue>(resultados parciais altamente relevantes para o prosseguimento das atividades)</font>.",
	"<B>Bom</B> <font color=blue>(dados obtidos são adequados, bem como a análise preliminar. Na próxima etapa deve haver complementação e aprofundamento).</font>",
	"<B>Regular</B> <font color=blue>(dados obtidos não são analisados, dificultando a avaliação da sua relevância no contexto do projeto ).</font>",
	"<B>Ruim</B> <font color=blue>(poucos ou nenhum resultado relevante no contexto do projeto foram apresentados).</font>",
	"<B>não se aplica</B> <font color=blue>(de acordo com o cronograma inicial apresentado, não é esperado a apresentação de resultados nesta etapa do trabalho).</font>",
	);
if (strlen($dd[12]) > 0) { $sel12[$dd[12]] = 'checked'; }

////////
$sel14 = array("","1","2");
$msg_14 = array("","APROVADO, caso existam comentários ou sugestões devem ser incorporados no relatório final","PENDÊNCIAS, relatório parcial deve ser reapresentado realizando as devidas correções.");
if (strlen($dd[14]) > 0) { $sel14[$dd[14]] = 'selected'; }


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>::Ficha de avaliação:: PIBIC-PUCPR </title>
	<link rel="STYLESHEET" type="text/css" href="css/pibic.css">		
</head>

<body bgcolor="#004EC3">
<table width="610" border="0" align="center" bgcolor="#ffffff" class="lt1" cellpadding="4">
<TR><TD valign="top"><img src="img/logo_instituicao.gif" alt="" width="73" height="84" border="0">
<TD><img src="img/homeHeaderLogoImage.jpg" width="729" height="143" alt="">
<? 
//if ($key <> $dd[1])
//	{
//	echo '<TR><TD colspan="2">';
//	echo '<CENTER>';
//	echo '<font class="lt5"><font color="red">';
//	echo 'Chave de acesso Incorreta! Contate o gestor pelo e-mail pibicpr@pucpr.br';
//	echo '</CENTER>';
//	exit;	
//	}

/*** Sistema Novo ****/	
echo '<TR><TH colspan="3" bgcolor="#E6E3FB">Projetos e Plano de trabalho</TD></TR>';
echo '<TR><TD colspan=3	>';
/**** Mensagens ***/
	/* Mensagens */
	require('../_class/_class_language.php');	
	$tabela = 'pa_relatorio_parcial_entrega';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }

/**** Classes ***/
	require("../_class/_class_pibic_bolsa_contempladas.php");
	$pb = new pibic_bolsa_contempladas;
	$pb->le('',$dd[3]);
	
	echo $pb->mostar_dados();
	require("../pibic/_ged_config.php");
	$ged->protocol = $pb->pb_protocolo;	


if ($sta != '@')
	{
	echo '<TR><TD colspan="2">';
	echo '<CENTER>';
	echo '<font class="lt5"><font color="green">';
	echo 'Sua avaliação foi enviada com sucesso !';
	echo '</CENTER>';
	exit;
	}

require("pibic_avaliacao_parcial_arquivos.php");

/**** Relatórios postados ****/
echo $ged->filelist();

?>
<TT>
<B>Prezado avaliador</B>
<BR><BR>
Para cada pergunta abaixo haverá um campo de preenchimento obrigatório para seus comentários relacionados à opção assinalada. Informamos que as frases na <font color="blue">cor azul</font> são informativas para os srs e têm o propósito de garantir uma uniformidade mínima entre às avaliações.
<BR><BR>
Nosso intuito é que cada aluno e prof. orientador recebam seu feedback qualitativo que, sem dúvida alguma, é de grande relevância para o objetivo final do Programa de Iniciação Científica: a formação efetiva do jovem pesquisador. 
<BR><BR>
Agradecemos imensamente sua participação e colaboração.
<BR><BR>
Comitê Gestor 
</PRE>
<form method="post" action="pibic_avaliacao_parcial.php">
<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<input type="hidden" name="dd1" value="<?=$dd[1];?>">
<input type="hidden" name="dd2" value="<?=$dd[2];?>">
<input type="hidden" name="dd3" value="<?=$dd[3];?>">
<input type="hidden" name="dd4" value="<?=$dd[4];?>">
<TR><TH colspan="2" bgcolor="#E6E3FB">Ficha de avaliação</TD></TR>
<TR><TD colspan="2">
1) <B>Clareza, legibilidade e objetividade(português, organização geral do texto, figuras, gráficos, tabelas, referências, adequação do relatório ao modelo do Programa):</B><BR>
<input type="radio" name="dd10" value="1" <?=$sel10[1];?> ><?=$msg_10[1];?><BR>
<input type="radio" name="dd10" value="2" <?=$sel10[2];?> ><?=$msg_10[2];?><BR>
<input type="radio" name="dd10" value="3" <?=$sel10[3];?> ><?=$msg_10[3];?><BR>
<input type="radio" name="dd10" value="4" <?=$sel10[4];?> ><?=$msg_10[4];?><BR>
<BR>Comentários sobre sua avaliação deste item (obrigatório):<BR>
<textarea cols="60" rows="6" name="dd20"><?=$dd[20];?></textarea>
<BR><BR>
2) <B>Cumprimento do cronograma previsto:</B><BR>
<input type="radio" name="dd11" value="1" <?=$sel11[1];?> ><?=$msg_11[1];?><BR>
<input type="radio" name="dd11" value="2" <?=$sel11[2];?> ><?=$msg_11[2];?><BR>
<input type="radio" name="dd11" value="3" <?=$sel11[3];?> ><?=$msg_11[3];?><BR>
<input type="radio" name="dd11" value="4" <?=$sel11[4];?> ><?=$msg_11[4];?><BR>
<BR>Comentários sobre sua avaliação deste item (obrigatório):<BR>
<textarea cols="60" rows="6" name="dd21"><?=$dd[21];?></textarea>
<BR><BR>
3) <B>Resultados parciais obtidos:</B><BR>
<input type="radio" name="dd12" value="1" <?=$sel12[1];?> ><?=$msg_12[1];?><BR>
<input type="radio" name="dd12" value="2" <?=$sel12[2];?> ><?=$msg_12[2];?><BR>
<input type="radio" name="dd12" value="3" <?=$sel12[3];?> ><?=$msg_12[3];?><BR>
<input type="radio" name="dd12" value="4" <?=$sel12[4];?> ><?=$msg_12[4];?><BR>
<input type="radio" name="dd12" value="4" <?=$sel12[5];?> ><?=$msg_12[5];?><BR>
<BR>Comentários sobre sua avaliação deste item (obrigatório):<BR>
<textarea cols="60" rows="6" name="dd22"><?=$dd[22];?></textarea>
<BR><BR>
4) <B>Outros comentários <font color="blue">(o avaliador fica livre para suas sugestões e comentários sobre a apreciação geral do trabalho)</font></B><BR>
<BR>
<textarea cols="60" rows="6" name="dd13"><?=$dd[13];?></textarea>

<BR><BR>
5) <B>Resultado da avaliação<BR>
<BR>
<select name="dd14" size="1">
<option value="" <?=$sel14[0];?> ><?=$msg_14[0];?></option>
<option value="1" <?=$sel14[1];?>><?=$msg_14[1];?></option>
<option value="2" <?=$sel14[2];?>><?=$msg_14[2];?></option>
</select>

<BR><BR><input type="submit" name="acao" value="Enviar avaliação">
</form>
<BR><BR><BR>
<?
if ((strlen($dd[20]) > 0) and (strlen($dd[21]) > 0) and (strlen($dd[22]) > 0) and (strlen($dd[10]) > 0) and (strlen($dd[11]) > 0) and (strlen($dd[12]) > 0) and (strlen($dd[13]) > 0) and (strlen($dd[14]) > 0))
	{
		$sql = "update pibic_bolsa_contempladas set pb_relatorio_parcial_nota = ".$dd[14]." ";
		$sql .= " where pb_protocolo = '".$protocolo."' ";
		$rlt = db_query($sql);
	
		$sql = "update pibic_parecer_2011 set pl_p40 = '".$msg_10[$dd[10]]."'";
		$sql .= ", pl_p41 = '".$msg_11[$dd[11]]."'";
		$sql .= ", pl_p42 = '".$msg_12[$dd[12]]."'";
		$sql .= ", pl_p43 = '".$dd[13]."'";
		$sql .= ", pl_p44 = '".$msg_14[$dd[14]]."'";

		$sql .= ", pl_p46 = '".$dd[20]."'";
		$sql .= ", pl_p47 = '".$dd[21]."'";
		$sql .= ", pl_p48 = '".$dd[22]."'";
		$sql .= ", pl_p49 = '".$dd[14]."'";

		$sql .= ", pl_p0 = '".$dd[14]."' ";
		$sql .= ", pl_p1 = '".$dd[10]."' ";
		$sql .= ", pl_p2 = '".$dd[11]."' ";
		$sql .= ", pl_p3 = '".$dd[12]."' ";
		$sql .= ", pl_p4 = '".date("Ymd")."' ";
		$sql .= ", pl_p45 = '".date("H:i")."' ";
		$sql .= ", pp_status = '".chr(64+$dd[14])."' ";
		$sql .= " where id_pp = ".$id;
		$rlt = db_query($sql);
		
		/////////////////////// RECUEPRA TEXTO
		$tipo = "rel_par_con";	
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
		$e3 = '[PIBIC] - Relatorio parcial enviado - '.$aluno;
		$e4 = mst($texto);
		echo '<BR><BR>enviado para:';
//		enviaremail('rene@sisdoc.com.br',$e2,$e3,$e4);

		enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);		
		
		redirecina('pibic_avaliacao_parcial.php?dd0='.$dd[0].'&dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.$dd[3].'&dd4='.$dd[4]);
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
