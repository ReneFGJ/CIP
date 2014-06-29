<?
require("cab.php");
echo '<center>';
require($include."sisdoc_debug.php");
$label = "Cadastro de usuários";
	$tab_max = $tab_max -20;
	$http_edit = 'user_edit.php';
	$http_redirect = 'user.php';
//	$http_ver = 'sistema.php';
	$tabela = "usuario";
	$cdf = array('id_us','us_nome','us_login','us_codigo','us_niver');
	$cdm = array('Código','Nome','Login','código','aniversário');
	$masc = array('','','','@','D');
	$busca = true;
	$offset = 20;
	$pre_where = " (us_ativo = 1) and (us_cracha = '".$nucleo."') ";
	$order  = "us_nome ";
	$editar = true;
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>