<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_debug.php");

$tabela = "pic_atividades";
$idcp = "at";
$label = "Atividades programadas no Sistema";
//$http_ver = 'editora.php'; 
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';

$cdf = array('id_'.$idcp,$idcp.'_descricao',$idcp.'_de',$idcp.'_ate');
$cdm = array('Código','descricao','De','Até');
$masc = array('','','D','D','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_descricao ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>