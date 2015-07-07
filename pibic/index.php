<?php
/* $breadcrumbs */
$breadcrumbs = array();
array_push($breadcrumbs, array('main.php', 'principal'));
array_push($breadcrumbs, array($site . 'main.php', 'menu'));
require ("cab_pibic.php");

/*
 * Recupera dados do orientador */
$cracha = $nw -> user_cracha;
$sql = "select * from pibic_professor where pp_cracha = '" . $cracha . "' ";
$rlt = db_query($sql);
$hr = '';
if ($line = db_read($rlt)) {
	$hr = trim($line['pp_ch']);
}

require ("../_class/_class_pibic_recurso.php");
$rc = new recurso;

require ($include . 'sisdoc_data.php');

$professor = $ss -> user_cracha;

/* Valida pendencia da submissao */
require ("../_class/_class_pibic_projetos_v2.php");
$pj = new projetos;

//$tot = $pj->projetos_para_correcao($professor);
if ($tot > 0) {
	echo '<H1><font color="red">Correção de trabalhos submetidos</font></h1>';
	echo '<img src="' . $http . 'img/icone_alert.png">';
	echo '<A HREF="submit_project.php">Clique arqui para iniciar a correção</A>';
}

/*
 echo '<font class="lt1">Submissão de projeto IC Internacional</font><BR>';
 echo '<A HREF="submit_project.php">
 <img src="img/logo_ic_internacional.png" border=0>
 </A>
 ';
 echo '<BR><font class="lt1">Envie aqui!</font><BR>';
 */

require ("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$pb -> set($professor);
echo '<table width="100%" border=0 >';
echo '<TR valign="top">';
echo '<TD>';
echo $pb -> resumo();
echo '<TD width="300">';
//if ($professor == '88958022')
{
	echo '<h3> Solicitação</h3>';
	echo '<UL>';

	/* Cancelamento de protocolo */
	require ("__submit_SOLICIT.php");
	if ($open == 1) {
		echo '<LI><A HREF="protocolo_abrir.php?dd1=CAN">Cancelamento de orientação</A></LI>';
	}
	/* Alteração de título do Plano do Aluno*/
	require ("__submit_SOLICIT.php");
	if ($open == 1) {
		echo '<LI><A HREF="protocolo_abrir.php?dd1=ALT">Alteração de título do Plano do Aluno</A></LI>';
	}
	/* Substituição do aluno */
	require ("__submit_SOLICIT.php");
	if ($open == 1) {
		echo '<LI><A HREF="protocolo_abrir.php?dd1=SBS">Substituição do aluno</A></LI>';
	}
	/* Declaracao */
	require ("__submit_SOLICIT.php");
	if ($open == 1) {
		if (($hr == 'HR') or ($perfil -> valid("#TST"))) {
			echo '<LI><A HREF="declaracao_convite_horista.php">Convite Horas Eventuais IC</A></LI>';
		}
	}
	echo '</UL>';
	echo $rc -> resumo_recurso_professor($professor);
}
echo '</table>';

require ("../_class/_class_atividades.php");
$act = new atividades;

require ("../_class/_class_docentes.php");

require ("../_class/_class_pibic_edital.php");
$ed = new pibic_edital;

$ano = date("Y");
if (date("m") < 5) {
	$ano = $ano - 1;
}

//if ($professor == '88958022')
require ("../pibic/__submit_INPL.php");
if ($open == 1) {
	//echo $ed->bolsas_indicadas($professor,$ano);
	$id_pesq = $professor;
	require ("atividade_bolsa_implantacao.php");
}

/*
 $ed = new pibic_edital;
 echo '<h3>PIBIC_EM (Jr)</h3>';
 echo $ed->edital_resumo_professor(date("Y"),$professor,'PIBICE');

 echo '<h3>PIBITI</h3>';
 echo $ed->edital_resumo_professor(date("Y"),$professor,'PIBITI');

 echo '<h3>PIBIC</h3>';
 echo $ed->edital_resumo_professor(date("Y"),$professor,'PIBIC');
 */

if (date("Ymd") > 20150730) {
	if ((date("m") >= 7) and (date("m") <= 8)) {
		echo '<h1>PIBIC/PIBITI - Parecer do(s) Projeto(s)' . (date("Y")) . '/' . (date("Y") + 1) . '</h1>';
		echo $ed -> show_protocolo_professor($nw -> user_cracha);
	}
}

/* Relatorio Parcial */
if (date("m") < 5) {
	require ("atividade_IC1_row.php");
}
/* RelatÃ³rio Parcial - Correcoes */
if (date("m") < 5) {
	require ("atividade_IC7_row.php");
}
/* Relatório Final e resumo */
if (file_exists('__submit_RFIN.php')) {
	require ("__submit_RFIN.php");
	if ((date("m") >= 5) and (date("m") < 11) and ($open == 1)) {
		require ("atividade_IC3_row.php");
		require ("atividade_IC4_row.php");
	}
}
/* Relatório Final e resumo */
if (file_exists('__submit_RFIC.php')) {
	require ("__submit_RFIC.php");
	if ((date("m") > 5) and (date("m") < 11) and ($open == 1)) {
		require ("atividade_IC5_row.php");
	}
}
/* require("atividade_IC6_row.php"); */

require ("../foot.php");
?>