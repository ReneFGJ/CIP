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
	}
header("Location: login.php");
echo 'Stoped'; exit;	
?>