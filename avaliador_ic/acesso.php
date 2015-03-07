<?
ini_set('display_errors', 1	);
ini_set('error_reporting', 7);

require("acesso_valida.php");

$us = $dd[0];
$chk = substr($dd[90],0,2);
if (($chk == substr(md5('pibic'.date("Y").$dd[0]),0,2)) or (strlen($dd[0]) > 0))
	{
		$par = new parecerista;
		//$parecer->structure();
	
		$par->login_set($dd[0]);
		switch (trim($dd[1]))
			{
			case '1':
				redirecina('ic_my_account.php');
				break;
			case '2':
				redirecina('ic_declaracao.php');
				break;
			default:
				redirecina('ic_main.php');
				break;
			}
	} else {
		echo 'erro de envio de dados';
	}
?>
