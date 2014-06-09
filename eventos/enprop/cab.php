<?php
session_start();
$LANG = 'pt_BR';
$http = '';
$include = '../../';
$admin_nome = 'ENPROP2013';
$email_adm = 'enprop2013@pucpr.br';
require("db.php");
require("_class/_class_form.php");
$form = new form;
/* parametros */
ini_set('display_errors', 255);
ini_set('error_reporting', 255);

require("_class/_class_header_ev.php");
$hd = new header;

require("_class/_class_proceeding.php");
$evento = new proceeding;

echo $hd->cab();
echo '

';
$debug = true;
ini_set('display_errors', 255);
ini_set('error_reporting', 255);
function msg($txt)
	{
	 switch ($txt)
	 	{
	 	case 'field_requered': $txt = 'campo obrigatório'; break;
		case 'is_requered': $txt = 'é obrigatório'; break;
		case 'field': $txt = 'O campo'; break;
	 	}	
	 return($txt); 
	}
?>