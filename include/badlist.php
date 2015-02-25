<?
$ip = trim($_SERVER['REMOTE_ADDR']);

$badlist = 0;

if ($ip == '66.249.71.228') {$badlist = 1; }
if ($ip == '10.96.240.6') { $badlist = 1; }

if ($badlist == 1)
	{
	echo 'BADLIST';
	
		global $secu,$base,$base_name;
		$email = 'rene@fonzaghi.com.br';
		$tee = '<table width="400" bordercolor="#ff0000" border="3" align="center">';
		$tee .= '<TR><TD bgcolor="#ff0000" align="center"><FONT class="lt2"><FONT COLOR=white><B>BAD-LIST  -'.$base.'-'.$base_name.'-</TD></TR>';
		$tee .= '<TR><TD align="center"><B><TT>';
		$tee .= 'Erro Número #'.$errno;
		$tee .= '<TR><TD><B><TT>';
		$tee .= '<BR>Remote Address: '.$_SERVER['REMOTE_ADDR'];
		$tee .= '<BR>Metodo: '.$_SERVER['REQUEST_METHOD'];
		$tee .= '<BR>Nome da página: '.$_SERVER['SCRIPT_NAME'];
		$tee .= '<BR>Domínio: '.$_SERVER['SERVER_NAME'];
		$tee .= '<BR>Data: '.date("d/m/Y H:i:s");
		$tee .= '<TR><TD><B><TT>';
		$tee .= '<BR>File: '.$errstr;
		$tee .= '<BR>Line: '.$errline;
		$tee .= '<BR>File: '.$errfile;
		$tee .= '</table>';
	
		$headers .= 'To: Rene (Monitoramento) <rene@fonzaghi.com.br>' . "\r\n";
		$headers .= 'From: BancoSQL (PG) <rene@sisdoc.com.br>' . "\r\n";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";		

		mail($email, 'Erros de Script'.$secu, $tee, $headers);
		die();	
	exit;
	}
?>
