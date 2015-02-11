<?php
/*
 *	$Id: sslclient.php,v 1.1 2004/01/09 03:23:42 snichol Exp $
 *
 *	SSL client sample.
 *
 *	Service: SOAP endpoint
 *	Payload: rpc/encoded
 *	Transport: https
 *	Authentication: none
 */
//$xcodigo = '88958022';
if (strlen($codigo) > 0) {
	
	require ('../include/nusoap/nusoap.php');

	$param = array('pessoa' => $codigo);

	/* create the client for my rpc/encoded web service */
	$wsdl = 'https://sarch.pucpr.br:8100/services/ServicoConsultaPibic?wsdl';

	$client = new soapclient($wsdl, true);
	$result = $client -> call('opPesquisarPorCodigo', $param);

		//$result = $result['DadoAluno'][0];
	echo '<h1>Total de cursos: ';
	echo count($result['DadoAluno']);
	echo '</h1>';
	$ct = count($result['DadoAluno']);
	if (($ct > 1) and ($ct < 8))
		{
			$result = $result['DadoAluno'][0];
		} else {
			$result = $result['DadoAluno'];
		}
	
}
?>
