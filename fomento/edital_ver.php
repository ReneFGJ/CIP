<?
$include = '../';
require("../db.php");
require('../_class/_class_fomento.php');

	$clx = new fomento;
	$clx->le($dd[0]);
	
	$clx->lido($dd[0],$dd[1]);
	$url = trim($clx->line['ed_url_externa']);
	echo '<meta http-equiv="refresh" content="0;'.$url.'">';
	//redirecina($url);
		
require("../foot.php");		
?> 