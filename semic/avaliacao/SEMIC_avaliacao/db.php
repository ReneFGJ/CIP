<?
ob_start();
session_start();
header("Content-Type: text/html; charset=ISO-8859-1",true);
//-------------------------------------- Paramentros para DEBUG
ini_set('display_errors', 0);
ini_set('error_reporting', 0);
$include = '../';
$include .= "include/";
$debug = True; //XXX não esquecer de comentar isso na versão de produção!!!
if($debug == true)
	{
	ini_set('display_errors', 1);
	ini_set('error_reporting', 7);
	}
#$debug = false;
//-------------------------------------- Includes Padroes
require($include.'sisdoc_sql.php');
require($include.'sisdoc_char.php');
$tab_max = 900;
//-------------------------------------- Diretorios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir_public = $dir . '/reol/public/';
$img_dir = '/reol/img/';
$img_pub_dir = '/reol/public/img/';
$http_site = '/reol/';
$http_public = '/reol/public/';


$secu = "semic-2013";
//-------------------------------------- Definicoes Iniciais
define(site,'http://www2.pucpr.br');
define(http,'http://www2.pucpr.br/reol/');
define(site,'pucpr.br');
define(idioma,"pt_BR");
define(path,''.$_SERVER['PATH_INFO']);
define(host,getServerHost());
define(secu,'ojsbr');
$path = substr(path,1,100);
$charset = "ASCII";

//-------------------------------------- Leituras das Variaveis dd0 a dd99 (POST/GET)
$vars = array_merge($_GET, $_POST);
for ($k=0;$k < 100;$k++)
	{
	$varf='dd'.$k;
	$varf=$vars[$varf];
	
	$varf = troca($varf,chr(92),'');
	$dd[$k] = troca($varf,"'","´");
	}
$acao = $vars['acao'];
$nocab = $vars['nocab'];
$base = 'pgsql';

//exit;
//-------------------------------------- Determina o Idioma de Navegacao
$jid = 67;

//-------------------------------------- Paramentros da Base de Dados PostGres
require("db_semic_2013.php");


//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}

function msg($ms)
	{
		switch ($ms)
			{
			case 'field_requered': $ms = 'campo obrigatório'; break;
			case 'select_option' : $ms = ''; break;
			}		
		return($ms); 
	}
?>
