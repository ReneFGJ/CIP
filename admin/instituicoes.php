<?
///////////////// Versao 0.0.1f de 02/08/2008
require("cab.php");

echo '<div id="conteudo">';

$cpi = "";
$tabela = "instituicao";
//$sql = "ALTER SEQUENCE instituicao_id_inst_seq RESTART WITH 2000;";
//$rlt = db_query($sql);
//$sql = "delete from instituicao where id_inst = 1000 ";
//$rlt = db_query($sql);


		$http_edit = 'instituicoes_ed.php';
		$editar = true;

	$http_redirect = page();
	//$http_ver = $tabela.'_sel.php';
	$cdf = array('id_inst','inst_nome','inst_abreviatura','inst_lat','inst_log','inst_codigo');
	$cdm = array('C�digo','nome','sigla','latitude','longitude','c�digo');
	$masc = array('','','','');
	$busca = true;
	$offset = 20;

	$order  = "";
	$tab_max = '100%';
	require($include."sisdoc_row.php");
	echo '</div>';
require("foot.php");	

exit;
?>
