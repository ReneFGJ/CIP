<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');

require('../_class/_class_pareceristas.php');
$par = new parecerista;

echo '<h2>Cadastro de Avaliadores</h2>';
$par->row();

	$http_edit = 'pareceristas_editar.php';
	$http_redirect = 'pareceristas_cadastro.php';
	$http_ver = 'parecerista_detalhes.php';

	$busca = true;
	$offset = 20;
	$pre_where = " (us_ativo  = 1) and (us_journal_id = ".intval($jid).") ";
	$order  = "us_nome ";
	$editar = true;
	$tab_max = '96%';
	require($include.'sisdoc_row.php');	

require("../foot.php");
?>