<?
require("cab.php");
require($include.'sisdoc_email.php');

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
				redirecina('my_account.php');
				break;
			case '2':
				redirecina('declaracao.php');
				break;
			default:
				redirecina('main.php');
				break;
			}
	} else {
		echo 'erro de envio de dados';
	}
?>
