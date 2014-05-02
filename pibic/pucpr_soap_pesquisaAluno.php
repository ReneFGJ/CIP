<?php
if (strlen($secu) == 0)
	{
	require("db.php");
	}

require("../pibicpr2/_pucpr_login.php");

$consulta = True;


//$ssql = "delete from pibic_aluno ";
//$ssql .= " where pa_cracha = '".$cracha."' ";
//$rrlt = db_query($ssql);

$ssql = "select * from pibic_aluno ";
$ssql .= " where pa_cracha = '".trim($cracha)."' ";

$rrlt = db_query($ssql);
if ($rline = db_read($rrlt))
	{
	$consulta = False;
	$rst = True;
	//echo $line['pa_update'];
	$data = substr($rline['pa_update'],0,6);
	if ($data == date("Ym"))
		{
		$consulta = False;
		$rst = True;
		}
	}
///////////// Se tiver desatualizado no banco de dados faz nova consulta
if ($consulta == true)
	{
	require_once('../include/nusoap/nusoap.php');
	//
	
	//$client = new soapclient('https://200.192.112.23:8081/servicePibic?wsdl');
	//$client = new soapclient('https://polux.pucpr.br:8084/servicePibic?wsdl');
	$client = new soapclient('https://portalintranet.pucpr.br:8081/servicePibic?wsdl');
	$client->setCredentials($user, $pass); 
	if ($debug) { $errc .=  '30.'; }
	
	$err = $client->getError();
	if ($err) {
		echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
	}
	
	//$param = array('arg0' => $cracha, 'arg1' => $senha);
	$param = array('arg0' => $cracha);
	$result = $client->call('pesquisarPorCodigo', $param,'http://consultas.servicos.apc.br/', '', false, true);
	
	$al_centroAcademico = $result['centroAcademico'];
	$al_cpf = $result['cpf'];
	$al_nivelCurso = $result['nivelCurso'];
	$al_nomeAluno = troca($result['nomeAluno'],"'","´");
	$al_nomeCurso = troca($result['nomeCurso'],"'","´");
	$al_pessoa = $result['pessoa'];
	$al_tel1 = $result['tel1'];
	$al_tel2 = $result['tel2'];
	$al_email1  = $result['email1'];
	$al_email2  = $result['email2'];
	
	///////////////////////////////// Se localizado cadastra ou atualiza dados
	if (trim($cracha) == trim($al_pessoa))
		{
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
		{ echo 'ok'; } else
		{ echo 'erro'; }
		
//	print_r($result);
}
//if ($debug == True)
//	{
//	echo '===>'.$al_pessoa;
//	echo '<HR>';
//	print_r($result);
//	echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
//	echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
//	echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
//	}
?>
