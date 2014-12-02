<?php
/*
 * Require SOAP
 */

class login {
	function authentic($codigo='', $senha='') {
		/* Initialize parameter */
		$param = array('login' => $codigo, 'senha' => $senha);

		/* create the client for my rpc/encoded web service */
		$wsdl = 'https://sarch.pucpr.br:8100/services/AutenticacaoSOA?wsdl';
		
		$client = new soapclient($wsdl, true);
		$response = $client -> call('autenticarUsuario', $param);
				
		return($response);
	}

}
