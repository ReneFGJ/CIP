<?
global $tab_max,$form;
$include = '../';
$debug = True;
$form = true;
require($include."db.php");

$dir = $_SERVER['DOCUMENT_ROOT'];
$uploaddir = $dir.'public/submisao/';

$bgcolor = "#ddeeff";
$id_ic = "REO";
$tabela = 'submit_autor';
$field_email_1 = 'sa_email';
$field_email_2 = 'sa_email_alt';
$email_admin = "pibicpr@pucpr.br";
$field_pass = 'sa_senha';
$field_nome = 'sa_nome';

$tab_max = 704;
$tdoc = "pibic_submit_documento";
$tdov = "pibic_submit_documento_valor";
$tdoco = "submit_documentos_obrigatorio";
$cdoc = "pibic_submit_sub_orcamento";
$ged_files ="pibic_ged_files";
$faq = "faq";
$submit_autores = "submit_autores";
$ic_noticia = "ic_noticia";
$submit_manuscrito_field = "submit_manuscrito_field";
$submit_manuscrito_tipo = "submit_manuscrito_tipo";
$table_pesquisador = 'reol_pesquisador';
$submit_crono_orca = "submit_crono_orca";

$tit1 = 'PONTIFÍCIA UNIVERSIDADE CATÓLICA DO PARANÁ';
$tit2 = 'PIBIC';
$tit3 = 'Submissão de manuscritos acadêmicos';
$tit4 = 'RE2ol';

$email_adm='pibicpr@pucpr.br';
$admin_nome='PIBIC-PUCPR';
function decode($xx)
	{
	return($xx);
	}
?>