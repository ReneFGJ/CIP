<?
//$debug = true;

$nl = chr(13).chr(10).'<BR>';
global $email_adm, $admin_nome;
$email_adm = "pibicpr@pucpr.br";
$admin_nome = "PIBIC-PUCPR ".date("Y");
$e3 = "PUCPR PIBIC ".date("Y")." - $titulo";
$e4 = "";

	////////////// Une com informações adicionais
	$e4 = $texto;
	$e1 = $email_send;
	$ec1 = "rene@sisdoc.com.br";
	echo '<table width="600"><TR><TD>';
	echo $e4;
	echo '</TD></TR></table>';
	if ($dd[2] != '0')
		{	
		$rsp = enviaremail($ec1,$e2,$e3,$e4); 
		}
	if ((strlen($dd[3]) > 0) and ($dd[2] == '2'))
		{ 	$rsp = enviaremail($dd[3],$e2,$e3,$e4); }
		
	if ($dd[2] == '1')
		{
		if (strlen($email_1) > 0)
			{ $rsp = enviaremail($email_1,$e2,$e3,$e4); echo $email_1.' '; }
		if (strlen($email_2) > 0)
			{ $rsp = enviaremail($email_2,$e2,$e3,$e4); echo $email_2.' '; }
		
			$msg = "<BR>enviado para <B>".$e1.' '.$rsp.'</B> ';
			$msg .= "as ".date("d/m/Y H:i:s");
			echo '<BR>'.$msg;
		}
	?>
	