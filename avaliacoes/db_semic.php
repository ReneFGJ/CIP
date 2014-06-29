<?
$email_adm="pibicpr@pucpr.br";
$email_nome="(PIBIC) Programa Institucional de Bolsas de Iniciação Científica";
//-------------------------------------- Paramentros da Base de Dados PostGres
$base = "pgsql";
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }

$base_pass="ojsbr-2006";

global $charset,$qcharset;
$basechar = 'ASC7';
$qbasechar = 'ASC7';
$ok = db_connect();


$submissao = True;
/////////////////////////// Dados do Cabeçalho
$cab_bg = '#A94F4E';
$cab_sigla = 'PIBIC';
$cab_nome = 'Programa Institucional de Bolsas de Iniciação Científica';
$cab_slogan = 'Iniciação Científica';

$cab_menu_bg = '#000000';
$cab_menu_font = '#FFFFFF';

$login_bg = '#B9753A';
$site_titulo = 'PIBIC/PIBITI - PUCPR';
//////////// tabelas
$pp = "pibic";
$ged = 'pibic_files';
$parecer = 'pibic_parecer_nr';
$func_char = 'char';
$revisor = true;
$jid = 45;
?>
