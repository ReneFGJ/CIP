<?php
    /**
     * Recupera��o de informa��es sobre os estudantes e colaboradores
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011, PUCPR
	 * @access public
     * @version v0.11.28
	 * @link http://www.brapci.ufpr.br
	 * @package Declaracao
	 * @subpackage UC0003
     */

if (strlen($secu) == 0)
	{ require("db.php"); }

/** Recupera informaces sobre o login e senha para consulta no WEBSERVICE */
require("_pucpr_login.php");

/* Habilita consulta */
$consulta = True;
$debug  = True;

/* Se for enviado dd2=1 forca nova consulta */
if ($dd[2] == '1')
	{
		$ssql = "update pibic_aluno set ";
		$ssql .= "pa_update='".date("Ymd")."'";
		$ssql .= " where pa_cracha = '".$cracha."' ";
		$rrlt = db_query($ssql);
	}

$ssql = "select * from pibic_aluno ";
$ssql .= " where pa_cracha = '".$cracha."' ";
$rrlt = db_query($ssql);
if ($rline = db_read($rrlt))
	{
	$data = substr($rline['pa_update'],0,6);
	/* Se ja foi consultado no dia nao realiza nova consulta */
	if (($data == date("Ym")) and ($dd[2] != '1'))
		{
		$consulta = False;
		$rst = True;
		}
	}
	
/* Se tiver desatualizado no banco de dados faz nova consulta */
if ($consulta == true)
	{
	/** Chama biblioteca do SOAP */
	require_once('../include/nusoap/nusoap.php');

	/* Objeto de consulta do WebService */
	//$client = new soapclient('https://portalintranet.pucpr.br:8081/servicePibic?wsdl');
	$client = new soapclient('http://haiti.cwb.pucpr.br:8280/services/ServicoConsultaPibic?wsdl');
	$client->setCredentials($user, $pass); 
	if ($debug) { $errc .=  '30.'; }
	
	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	}
	
	//$param = array('arg0' => $cracha, 'arg1' => $senha);
	/* Informa parametros para o WebService */
	$param = array('arg0' => $cracha);
//	print_r($param);
	//echo '<HR>';
	/* Chama o metodo "call" da classe sopacliente */
	$result = $client->call('pesquisarPorCodigo', $param,'http://consultas.servicos.apc.br/', '', false, true);
	
	/* Retorna parametro da consulta */
	$al_centroAcademico = $result['centroAcademico'];
	$al_cpf = $result['cpf'];
	$al_nivelCurso = $result['nivelCurso'];
	$al_nomeAluno = troca($result['nomeAluno'],"'","`");
	$al_nomeCurso = troca($result['nomeCurso'],"'","`");
	$al_pessoa = $result['pessoa'];
	$al_tel1 = $result['tel1'];
	$al_tel2 = $result['tel2'];
	$al_email1  = $result['email1'];
	$al_email2  = $result['email2'];
	
	/* Corre��es de Centros dentro da Institui��o */
	if ($al_nomeCurso == 'Biotecnologia') { $al_centroAcademico = 'Centro de Ci�ncias Biol�gicas e da Sa�de - CCBS'; }
	
	/* Se os dados j� existem informa */
	if (trim($cracha) == trim($al_pessoa))
		{
		echo '<TABLE width="600" border="1"><TR><TD><TT>';
		echo '<BR>Nome.......: <B>'.UpperCase($al_nomeAluno).'</B>';
		echo '<BR>Centro.....:'.$al_centroAcademico.'</B>';
		echo '<BR>Curso......:'.$al_nomeCurso.'</B>';
		echo '<BR>Telefone(1):'.$al_tel1.'</B>';
		echo '<BR>Telefone(2):'.$al_tel2.'</B>';

		echo '<BR>e-mail.....:'.$al_email1.'</B>';
		echo '<BR>e-mail(alt):'.$al_email2.'</B>';

		echo '</TD></TR></TABLE>';
		
		/* Grava dados no banco de dados */
		$ssql = "select * from pibic_aluno ";
		$ssql .= " where pa_cracha = '".$cracha."' ";
		$rrlt = db_query($ssql);
		if ($rline = db_read($rrlt))
			{
				$ssql = "update pibic_aluno set ";
				$ssql .= "pa_centro='".$al_centroAcademico."',";
				$ssql .= "pa_curso='".$al_nomeCurso."',";
				$ssql .= "pa_tel1='".$al_tel1."',";
				$ssql .= "pa_tel2='".$al_tel2."',";
				$ssql .= "pa_escolaridade='".$al_nivelCurso."',";
				$ssql .= "pa_update='".date("Ymd")."',";
				$ssql .= "pa_email='".$al_email1."',";
				$ssql .= "pa_email_1='".$al_email2."' ";
				$ssql .= " where pa_cracha = '".$cracha."' ";
				$rrlt = db_query($ssql);
				$rst = True;
				$msg = 'Atualizado';
			} else {
				$ssql = "insert into pibic_aluno ";
				$ssql .= "(pa_nome,pa_nome_asc,pa_nasc,";
				$ssql .= "pa_cracha,pa_cpf,pa_centro,";
				$ssql .= "pa_curso,pa_tel1,pa_tel2,";
				$ssql .= "pa_escolaridade,pa_update ";
				$ssql .= ",pa_email,pa_email_1";
				$ssql .= ") ";
				$ssql .= " values ";
				$ssql .= "('".UpperCase($al_nomeAluno)."','".UpperCaseSQL($al_nomeAluno)."','',";
				$ssql .= "'".$al_pessoa."','".$al_cpf."','".$al_centroAcademico."',";
				$ssql .= "'".$al_nomeCurso."','".$al_tel1 ."','".$al_tel2."',";
				$ssql .= "'".$al_nivelCurso."','".date("Ymd")."'";
				$ssql .= ",'".$al_email1."','".$al_email2."'";
				$ssql .= ")";
				$rrlt = db_query($ssql);
				$msg = 'Inserido';
				$rst = True;
			}
			$ssql = "select * from pibic_aluno ";
			$ssql .= " where pa_cracha = '".$cracha."' ";
			$rrlt = db_query($ssql);
			if ($rline = db_read($rrlt))			
			{
				$rst = true;
			}
		} else {
//		print_r($rline);
		}
	
	if ($rst == true)
		{ echo 'consulta realizada com sucesso!'; 
		  echo '<BR>'.$msg;
		} else
		{ echo 'erro de consulta'; }
		
//	print_r($result);
}
/* Monitoramento de erros */
if ($debug == True)
	{
	echo '<TABLE width="600" border="1"><TR><TD><TT>';
	echo '<B>'.$al_pessoa.'</B>';
	echo '<HR>';
//	print_r($result);
	echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
	echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
	}
?>
