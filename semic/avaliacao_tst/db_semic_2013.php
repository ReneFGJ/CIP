<?
//-------------------------------------- DiretпїЅrios de Arquivos e Imagens
$email_adm="pibicpr@pucpr.br";
$email_nome="Iniciaзгo Cientнfica PUCPR";
$site_titulo = "Sistema de Avaliaзгo SEMIC";
//-------------------------------------- Paramentros da Base de Dados PostGres
$base_user=$vars['base_user'];
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }
$base_pass="ojsbr-2006";

/* My SQL */
$base_user=$vars['base_user'];
$base_host="localhost";
$base_name="sisdocco_semic";
$base_user="avaliacaoPhp";
$base_pass="kl!j3kvS13@34";
$base = "mysql";

if($_SERVER['SERVER_ADDR'] == '50.22.37.205'){
	$base_user = "sisdocco_sa";
	$base_pass = "448545ct";
}

$base = "pgsql";

$base_user=$vars['base_user'];
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }

$base_pass="ojsbr-2006";


$ok = db_connect();
?>