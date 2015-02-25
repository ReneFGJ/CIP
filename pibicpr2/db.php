<?
$include = '../include/';
//$include = '../include/';
ob_start();
session_start();
//-------------------------------------- Paramentros para DEBUG
//$debug = true;
ini_set('display_errors', 0);
ini_set('error_reporting', 0);
global $user_id,$user_nome,$dd,$user_nivel;
require($include."sisdoc_char.php");
require($include.'sisdoc_sql.php');
require($include.'sisdoc_debug.php');
//-------------------------------------- Paramentros para DEBUG
$debug = true;
ini_set('display_errors', 255);
ini_set('error_reporting',255);

ini_set('display_errors', 0);
ini_set('error_reporting', 0);
if ($debug == true)
	{
	ini_set('display_errors', 7);
	ini_set('error_reporting', 7);
	} else {
	$debug = False;
	}
//-------------------------------------- Diretórios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$uploaddir = $dir.'/nep/';
//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	$varf=$vars[$varf];
	//if (isset($varf) and ($k > 1)) {	//$varf = str_replace($varf,"A","´"); }
	$dd[$k] = troca($varf,"'","´");
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
//-------------------------------------- Determina o Idioma de Navegação
$idv = $vars['idioma'];
//-------------------------------------------- Biblioteca
$tab_max = 780;
require("db_pibicpr_v2.php");
//require("db_ceua_v2.php");
?>
