<?
session_start();
ob_start();

$include = '';
require("db.php");
require("cab_institucional.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
require('_class/_class_language.php');
require("_class/_class_pareceristas.php");
require("_class/_class_parecer.php");
require("_class/_class_parecer_journal.php");
require("_class/_class_parecer_pibic.php");
require($include.'sisdoc_colunas.php');
$par = new parecerista;
$parecer = new parecer;
$parecer_journal = new parecer_journal;
$parecer_pibic = new parecer_pibic;

require($include.'sisdoc_email.php');
$us = $dd[0];
$chk = substr($dd[90],0,2);
if (($chk == substr(md5('pesquisador'.$dd[0]),0,2)) or (strlen($dd[0]) > 0))
	{
		$par = new parecerista;
		//$parecer->structure();
	
		$par->login_set($dd[0]);
		$link = 'http://www2.pucpr.br/reol/apb.php?dd0='.$dd[0].'&dd90='.substr(checkpost($dd[0]),2,2).'&dd99=main';								
		redirecina($link);
		
		if ($dd[1] == '1')
			{
				redirecina($link);
			} else {
				redirecina($link);
				//redirecina('pesquisador/main.php');
			}
		
	} else {
		echo 'erro de envio de dados';
	}
?>
