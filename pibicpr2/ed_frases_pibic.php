<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_debug.php");

$tabela = "frases";
$idcp = "fr";
$label = "Cadastro de Páginas do Sistema";
//$http_ver = 'editora.php'; 
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = true;
$http_redirect = 'ed_'.$tabela.'.php';

$cdf = array('id_'.$idcp,$idcp.'_word',$idcp.'_idioma');
$cdm = array('Código','descricao','Idioma');
$masc = array('','','','','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_word ";
$pre_where = "journal_id = ".$jid;
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>