<?php
session_start();
$LANG = 'pt_BR';
$http = '';
$include = '../../';
$admin_nome = 'ENPROP2013';
$email_adm = 'enprop2013@pucpr.br';
require("db.php");

require("_class/_class_proceeding.php");
$ev = new proceeding;
$id = sonumero($dd[0]);
if ($id > 0)
	{
		$ev->le($id);
		$status = trim($ev->line['ev_status']);
		$line = $ev->line;
		
		$nome = trim($line['ev_nome']);
		$inst = trim($line['ev_instituicao']);
		$carg = trim($line['ev_cargo']);
		$outr = trim($line['ev_cargo_outros']);
		if ($carg == 'Outros')
			{ $carg = $outr; }
		
		echo $ev->etiqueta_cracha($nome,$inst,$carg);
	}
?>
