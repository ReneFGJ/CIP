<?php
/**
 * Recuperacao de informacoes sobre os estudantes e colaboradores
 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
 * @copyright Copyright (c) 2011, PUCPR
 * @access public
 * @version v0.11.28
 * @link http://www.brapci.ufpr.br
 * @package Declaracao
 * @subpackage UC0003
 */

if (strlen($secu) == 0) {
	require_once ("db.php");
}

/* Habilita consulta */
$consulta = True;
//$debug = True;
$cracha = trim($cracha);

/* Se for enviado dd2=1 forca nova consulta */
if ($dd[2] == '1') {
	$ssql = "update pibic_aluno set ";
	$ssql .= "pa_update='" . date("Ymd") . "'";
	$ssql .= " where pa_cracha = '" . $cracha . "' ";
	$rrlt = db_query($ssql);
}

$ssql = "select * from pibic_aluno ";
$ssql .= " where pa_cracha = '" . $cracha . "' ";
$rrlt = db_query($ssql);
if ($rline = db_read($rrlt)) {
	$data = substr($rline['pa_update'], 0, 6);
	/* Se ja foi consultado no dia nao realiza nova consulta */
	if (($data == date("Ym")) and ($dd[2] != '1')) {
		$consulta = False;
		$rst = True;
	}
}

/* Se tiver desatualizado no banco de dados faz nova consulta */
if ($consulta == true) {
	/** Chama biblioteca do SOAP */
	$codigo = $cracha;
	require_once ("../admin/_pucpr_soap_consultaAluno.php");

	/* Retorna parametro da consulta */
	$al_centroAcademico = $result['centroAcademico'];
	$al_cpf = $result['cpf'];
	$al_nivelCurso = $result['nivelCurso'];
	$al_nomeAluno = troca($result['nome'], "'", "`");
	$al_nomeCurso = troca($result['nomeCurso'], "'", "`");
	$al_pessoa = trim($result['pessoa']);
	$al_tel1 = $result['tel1'];
	$al_tel2 = $result['tel2'];
	$al_email1 = $result['email1'];
	$al_email2 = $result['email2'];
	$genero = $result['sexo'];
	$nasc = trim($result['dataNascimento']);
	$situacao = trim($result['situacao']);
	$nivelcurso = trim($result['nivelCurso']);
	$nasc = substr($nasc, 6, 4) . substr($nasc, 3, 2) . substr($nasc, 0, 2);

	/* Correcoes de Centros dentro da Instituicao */
	if ($al_nomeCurso == 'Biotecnologia') { $al_centroAcademico = 'Centro de Ciências Biológicas e da Saúde - CCBS';
	}

	/* Se os dados ja existem informa */

	if (trim($cracha) == trim($al_pessoa)) {
		if ($debug == True) {
			echo '<TABLE width="600" border="1"><TR><TD><TT>';
			echo '<BR>Nome.......: <B>' . UpperCase($al_nomeAluno) . '</B>';
			echo '<BR>Centro.....:' . $al_centroAcademico . '</B>';
			echo '<BR>Curso......:' . $al_nomeCurso . '</B>';
			echo '<BR>Telefone(1):' . $al_tel1 . '</B>';
			echo '<BR>Telefone(2):' . $al_tel2 . '</B>';

			echo '<BR>e-mail.....:' . $al_email1 . '</B>';
			echo '<BR>e-mail(alt):' . $al_email2 . '</B>';

			echo '<BR>Nascimento.:' . $nasc . '</B>';			
			echo '<BR>Situação...:' . $situacao . '</B>';
			echo '<BR>Nível Curso:' . $nivelcurso . '</B>';
			echo '</TD></TR></TABLE>';
		}
		
		/* Grava dados no banco de dados */
		$ssql = "select * from pibic_aluno ";
		$ssql .= " where pa_cracha = '" . $cracha . "' ";
		$rrlt = db_query($ssql);
		if ($rline = db_read($rrlt)) {
			$ssql = "update pibic_aluno set ";
			$ssql .= "pa_centro='" . $al_centroAcademico . "',";
			$ssql .= "pa_curso='" . $al_nomeCurso . "',";
			$ssql .= "pa_tel1='" . $al_tel1 . "',";
			$ssql .= "pa_tel2='" . $al_tel2 . "',";
			$ssql .= "pa_escolaridade='" . $al_nivelCurso . "',";
			$ssql .= "pa_update='" . date("Ymd") . "',";
			$ssql .= "pa_email='" . $al_email1 . "',";
			$ssql .= "pa_email_1='" . $al_email2 . "', ";
			$ssql .= "pa_nasc='" . $nasc . "', ";
			$ssql .= "pa_nivelcurso='" . $nivelcurso . "', ";
			$ssql .= "pa_situacao = '".substr($situacao,0,20)."' ";
			$ssql .= " where pa_cracha = '" . $cracha . "' ";
			$rrlt = db_query($ssql);
			$rst = True;
			$msg = 'Atualizado';
		} else {
			$ssql = "insert into pibic_aluno ";
			$ssql .= "(pa_nome,pa_nome_asc,pa_nasc,";
			$ssql .= "pa_cracha,pa_cpf,pa_centro,";
			$ssql .= "pa_curso,pa_tel1,pa_tel2,";
			$ssql .= "pa_escolaridade,pa_update ";
			$ssql .= ",pa_email,pa_email_1, pa_situacao, pa_nivelcurso";
			$ssql .= ") ";
			$ssql .= " values ";
			$ssql .= "('" . UpperCase($al_nomeAluno) . "','" . UpperCaseSQL($al_nomeAluno) . "',$nasc,";
			$ssql .= "'" . $al_pessoa . "','" . $al_cpf . "','" . $al_centroAcademico . "',";
			$ssql .= "'" . $al_nomeCurso . "','" . $al_tel1 . "','" . $al_tel2 . "',";
			$ssql .= "'" . $al_nivelCurso . "','" . date("Ymd") . "'";
			$ssql .= ",'" . $al_email1 . "','" . $al_email2 . "', '".substr($situacao,0,20)."','".$nivelcurso."'";
			$ssql .= ")";
			$rrlt = db_query($ssql);
			$msg = 'Inserido';
			$rst = True;
		}
		$ssql = "select * from pibic_aluno ";
		$ssql .= " where pa_cracha = '" . $cracha . "' ";
		$rrlt = db_query($ssql);
		if ($rline = db_read($rrlt)) {
			$rst = true;
		}
	} else {
		//		print_r($rline);
	}

	if ($debug == True) {
		if ($rst == true) { echo 'consulta realizada com sucesso!';
			echo '<BR>' . $msg;
		} else { echo 'erro de consulta'; }
	}

	//	print_r($result);
}
/* Monitoramento de erros */
$debug = False;
if ($debug == True) {
	echo '<TABLE width="600" border="1"><TR><TD><TT>';
	echo '<B>' . $al_pessoa . '</B>';
	echo '<HR>';
	//	print_r($result);
	echo '<h2>Request</h2><pre>' . htmlspecialchars($client -> request, ENT_QUOTES) . '</pre>';
	echo '<h2>Response</h2><pre>' . htmlspecialchars($client -> response, ENT_QUOTES) . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client -> debug_str, ENT_QUOTES) . '</pre>';
}
?>
