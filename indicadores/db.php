<?
ob_start();
session_start();
//date_default_timezone_set('UTC');
global $email_adm;
$mostar_versao = 0;
//-------------------------------------- Paramentros para DEBUG
//ini_set('display_errors', 255);
//ini_set('error_reporting', 7);

//-------------------------------------- Diretórios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];

/* Find Include Directory */
$path = array('_include/','../_include/','../../_include/','../../../_include/');
for ($r=0;$r < count($path);$r++)
	{
		if (is_dir($path[$r]))
			{
				$include = $path[$r];
				$r = 99;
			}
	}
//----------------------------------------------------------
require($include."sisdoc_char.php"); 
require($include."sisdoc_sql.php"); 
//require($include.'sisdoc_debug.php');
//-------------------------------------- Definições Iniciais

$charset = "ISO-8859-1";
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

//-------------------------------------- Recuperar dados de GET / POST
function getServerHost() {
return isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST']
		: (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']
		: (isset($_SERVER['HOSTNAME']) ? $_SERVER['HOSTNAME']
		: 'localhost'));
}
/*
 * Conectar com bases de dados
 */
$db = '_db/_db.php';
if (file_exists($db)) { require($db); }

?>