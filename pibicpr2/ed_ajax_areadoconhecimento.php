<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");
require($include.'sisdoc_colunas.php');
$label = "Artigos submetidos para Análise";
$cpi = "";
$tabela = "ajax_areadoconhecimento";
if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php';
	$http_edit_para = '&dd99='.$tabela; 
	$editar = true;
	}
	$http_redirect = 'ed_'.$tabela.'.php';
//	$http_ver = 'ed_'.$tabela.'_sel.php';
	$cdf = array('id_aa','a_cnpq','a_descricao');
	$cdm = array('Código','cpnq','descricao');
	$masc = array('','','','','','','');
	$busca = true;
	$offset = 20;
//	$pre_where = "doc_journal_id = '".$journal_id."' ";
	$order  = " a_cnpq";
	require($include."sisdoc_row.php");
require("foot.php");	
?>