<?
$login = 1;
$nocab = 'PR';
require("cab.php");
	{
		setcookie('nw_user','',time()-3600);
		setcookie('nw_log','',time()-3600); 
		setcookie('nw_user_nome','',time()-3600);
		setcookie('nw_nivel','',time()-3600);	
		setcookie('nucleo','',time()-3600);	
		
		session_start();
		$_SESSION['nome'] = '';
		$_SESSION['codigo'] = '';
		$_SESSION['id'] = '';
	}
	
header("Location: index.php");
echo 'Stoped'; exit;	
?>