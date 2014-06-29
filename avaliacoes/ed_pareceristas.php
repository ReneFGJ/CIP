<?
$debug = true;
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
$label = "Cadastro de pareceristas";
	$tabela = "pareceristas";
	$tab_max = $tab_max -20;
if ($user_nivel > 5)
		{
		$http_edit = 'ed_edit.php';
		$http_edit_para = '&dd99='.$tabela; 	
		}
	$http_redirect = 'ed_pareceristas.php';
	$http_ver = 'parecerista_areas.php';

	$cdf = array('id_us','us_nome','us_login','us_ativo');
	$cdm = array('Código','Nome','login','ativo');
	$masc = array('','','','SN');
	$busca = true;
	$offset = 20;
	$pre_where = " (us_ativo  = 1) and (us_journal_id = ".intval(20).") ";
	$order  = "us_nome ";
//	if ($user_nivel == 9) { $editar = true; }
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>