<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_debug.php');

$id = $dd[0];
$secu = uppercase($secu);
$chk1 = checkpost($id.$secu);
$secu = '';
$chk2 = checkpost($id);

$secu = $dd[91];
$chk1 = checkpost($id.$secu);

if (($dd[90] == $chk1) or ($dd[90] == $chk2))
	{
	if (strlen($dd[50]) > 0)
		{
			require('_ged_config_'.$dd[50].".php");
		} else {
			require("../pibic/_ged_config.php");
		}
	if (strlen($dd[50]) > 0)
		{ $ged->tabela = $dd[50]; }
		echo $ged->download($id);
	} else {
		echo msg('erro_post');
	}
?>
