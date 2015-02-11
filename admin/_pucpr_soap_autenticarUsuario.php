<?php
require("_pucpr_login.php");
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
require_once('include/nusoap/nusoap.php');
//$client = new soapclient('https://polux.pucpr.br:8084/servicePibic?wsdl');
//$client = new soapclient('https://10.96.210.20:8084/servicePibic?wsdl');

		$param = array('login' => $codigo, 'senha' => $senha);

		/* create the client for my rpc/encoded web service */
		$wsdl = 'https://sarch.pucpr.br:8100/services/AutenticacaoSOA?wsdl';
		
		$client = new soapclient($wsdl, true);
		$result = $client -> call('autenticarUsuario', $param);

?>
