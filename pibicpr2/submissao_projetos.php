<?
require("cab.php");

$tabela = "pibic_submit_documento";
$idcp = "doc";
$label = "Projetos Submetidos";
$http_ver = 'ed_pibic_submit_article.php'; 

if ($user_nivel == 9)
	{
	$http_edit = 'ed_edit.php'; 
	$http_edit_para = '&dd99=pibic_submit_documento'; 
	$editar = true;
	}
$http_redirect = 'submissao_projetos.php';


$cdf = array('id_'.$idcp,'doc_protocolo','doc_protocolo_mae',$idcp.'_ano',$idcp.'_aluno',$idcp.'_1_titulo',$idcp.'_tipo','doc_edital');
$cdm = array('Código','Protocolo','Protocolo(mãe)','edital','Ano','Aluno código','Projeto','Tipo');
$masc = array('','','','','','','','','','','');
$busca = true;
$offset = 20;
if (strlen($dd[1]) == 0) { $pre_where = " (".$idcp."_ano = '".date("Y")."') "; }
$order  = $idcp."_1_titulo ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>