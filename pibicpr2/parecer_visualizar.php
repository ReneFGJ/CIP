<?
require("db.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_security.php");

require("../_class/_class_language.php");
require("../_class/_class_parecer_pibic.php");
$ppar = new parecer_pibic;
	
$pibic_ano = "2010";
$secu = uppercase($secu);
security();
$sistema = "RE<SUP>2</SUP>ol";
$sistema_link = '<A HREF="http://www.sisdoc.com.br" class="lt1">';
$versao = "v2.10.37";

$user_id = read_cookie('nw_log');
if (round($user_id) > 0)
	{
	$user_log = read_cookie('nw_user');
	} else {
	$user_log = read_cookie('nw_log');
	$user_id = read_cookie('nw_user');
	}
	$user_nome = read_cookie('nw_user_nome');
	$user_nivel = intval('0'.read_cookie('nw_nivel'));

echo '--';
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>PARECER</title>
	<link rel="STYLESHEET" type="text/css" href="css/letras.css">	
</head>
	
<?
echo $ppar->mostra_avaliacao($dd[0]);
?>