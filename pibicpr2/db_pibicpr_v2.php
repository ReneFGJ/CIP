<?
global $charset,$qcharset,$secu;
global $email_adm, $admin_nome,$emailadmin;

ini_set('display_errors', 1);
ini_set('error_reporting', 7);

$secu = "pibicpr2010";
$email_adm="pibicpr@pucpr.br";
$emailadmin = $email_adm;
$email_nome='"PIBIC (PUCPR)"';
$admin_nome=$email_nome;

//-------------------------------------- Paramentros da Base de Dados PostGres
$base = "pgsql";
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }
$base_pass="ojsbr-2006";
$basechar = 'ASC7';
$qbasechar = 'ASC7';
$ok = db_connect();

/////////////////////////// Dados do Cabeçalho
$cab_bg = '#9399e3';
$cab_sigla = 'PIBIC';
$cab_nome = 'Programa Institucional de Bolsas de Iniciação Científica e Tecnológica';
$cab_slogan = 'Iniciação Científica';

$cab_menu_bg = '#0071e1';
$cab_menu_font = '#ffffff';
$bgcolor = "#ffffff";

$site_titulo = 'PIBIC/PIBITI - PUCPR';

//////////// tabelas
$pp = "pibic";
$ged = 'pibic_files';
$parecer = 'pibic_parecer_nr';
$func_char = 'char';
$revisor = true;
$http = 'http://www2.pucpr.br/reol/pibicpr2/';
$site = 'http://www2.pucpr.br/reol/';
$http_site = $http;

$tab_max = "95%";
$login_bg = "#00437E";
$charset = 'ASCII';

$journal_id = 20;
$jid = 20;
?>
