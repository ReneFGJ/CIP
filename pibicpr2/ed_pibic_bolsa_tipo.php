<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_debug.php");

$tabela = "pibic_bolsa_tipo";
$idcp = "pbt";
$label = "Cadastro de Modalidade de Bolsas";
//$http_ver = 'editora.php'; 
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';

$cdf = array('id_'.$idcp,$idcp.'_descricao','pbt_edital',$idcp.'_codigo','pbt_auxilio');
$cdm = array('Código','Nome da modalidade','Tipo','Código','Vlr');
$masc = array('','','','','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = 'pbt_edital,'.$idcp."_descricao ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>