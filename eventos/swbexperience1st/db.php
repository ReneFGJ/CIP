<?
ob_start();
session_start();
//$path_info = trim($_SERVER['PATH_INFO']);
//date_default_timezone_set('GMT');
//-------------------------------------- Paramentros para DEBUG
ini_set('display_errors', 0);
ini_set('error_reporting', 0);
$include .= "../../_include/";
$debug = True;
if($debug == true)
	{
	ini_set('display_errors', 1);
	ini_set('error_reporting', 7);
	}
$debug = false;
//-------------------------------------- Includes Padr�es
require($include.'sisdoc_sql.php');
require($include.'sisdoc_char.php');
//header('Content-Type: text/html; charset=utf-8');
$tab_max = 780;
//-------------------------------------- Diret�rios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir_public = $dir . '/reol/public/';
$img_dir = '/reol/img/';
$img_pub_dir = '/reol/public/img/';
$http_site = '/reol/';
$http_public = '/reol/public/';


$secu = "reol";
//-------------------------------------- Defini��es Iniciais
define(site,'http://www2.pucpr.br');
define(http,'http://www2.pucpr.br/reol/');
define(site,'pucpr.br');
define(idioma,"pt_br");
define(path,''.$_SERVER['PATH_INFO']);
define(host,getServerHost());
define(secu,'ojsbr');
$path = substr(path,1,100);
$charset = "ASCII";


if (!isset($index))
	{
//	if (strlen($path)<=0))
//		{
//		header("Location: catalago.php");
//		break;
//		}
	}


//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	if (isset($vars[$varf]))
		{
		$varf=$vars[$varf];
		//if (isset($varf) and ($k > 1)) {	//$varf = str_replace($varf,"A","�"); }
		$varf = troca($varf,chr(92),'');
		$dd[$k] = troca($varf,"'","´");
		}
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
$base = 'pgsql';


$http = 'http://www2.pucpr.br/reol/';

//-------------------------------------- Paramentros da Base de Dados PostGres
$base_user=$vars['base_user'];
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }
$base_pass="ojsbr-2006";

$ok = db_connect();
//require("db_reol2_pucpr.php");


//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}


?>
