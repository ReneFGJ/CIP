<?
require("cab.php");
require($include.'sisdoc_colunas.php');

$tabela = "(pibic_bolsa_contempladas left join pibic_aluno on pb_aluno = pa_cracha ) as taebla";
$idcp = "pb";
$label = "Bolsas Contempladas";
//$http_ver = 'csf_bolsistas_ver.php'; 

$http_edit = 'csf_bolsistas_ed.php'; 
$http_edit_para = '&dd99=pibic_bolsas_contempladas'; 
$editar = true;

$http_redirect = 'csf_bolsistas.php';


$cdf = array('id_'.$idcp,$idcp.'_protocolo',$idcp.'_ano',$idcp.'_aluno',$idcp.'_titulo_projeto',$idcp.'_tipo','pa_nome',$idcp.'_status',$idcp.'_area_conhecimento','pb_ano');
$cdm = array('Código','Protocolo','Ano','Aluno código','Projeto','Bolsa','Aluno','status','use','edital');
$masc = array('','','','','','','','','','','');
$busca = true;
$offset = 20;
if (strlen($dd[1]) == 0) { $pre_where = " () "; }
$pre_where = " (pb_tipo = 'K' or pb_tipo = 'S') ";
$order  = " pb_protocolo ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>