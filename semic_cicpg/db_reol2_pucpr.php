<?
//-------------------------------------- Diretórios de Arquivos e Imagens
$dir = $_SERVER['DOCUMENT_ROOT'];
$dir_public = $dir;
$img_dir = '/reol/img/';
$img_pub_dir = '/reol/img/';
$http_site = '/reol/';
$uploaddir = $dir_public.'/reol/public/';
$secu = "reol";

$email_adm="rene@sisdoc.com.br";
$email_nome="RE<SUP>2</SUP>ol v.2";
$site_titulo = "Repositório Eletronico & Revistas Eletronicas Online";
//-------------------------------------- Paramentros da Base de Dados PostGres
$base_user=$vars['base_user'];
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }

$base_pass="ojsbr-2006";


$ok = db_connect();
?>