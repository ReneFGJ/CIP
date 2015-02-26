<?
require("cab.php");
require($include."sisdoc_debug.php");

//require('../_class/_class_pibic_projetos.php');
require("../_class/_class_pibic_projetos_v2.php");
$pj = new projetos;

//$pj->convert();

$cpi = "";
$tabela = "submit_documento";
$http_ver = 'ed_reol_submit_article.php';
if ($journal_id=='0000020' or $journal_id=='0000035')
	{
	$tabela = "pibic_submit_documento";
	$http_ver = 'ed_pibic_submit_article.php';
	}
	
/* UPDATE */
$sql = "update ".$tabela ." set doc_ano = '2012' where doc_ano = '' and id_doc > 4531";
//echo $sql;
//$rlt = db_query($sql);
/* Realizado somente no final */

echo '<TABLE border="1" width="'.$tab_max.'">';
echo '<TR valign="top">';
echo '<TD width="50%">';
$sr = '';
$titulo_pg = 'Projetos PIBIC';
$sql = "select sp_descricao,sp_ordem,count(*) as total,doc_tipo,doc_status, doc_ano, doc_edital from ".$tabela." ";
$sql .= "inner join submit_manuscrito_tipo on doc_tipo = sp_codigo ";
$sql .= " where (doc_edital = 'PIBIC') and (doc_status <> 'X')";
$sql .= " group by doc_ano, doc_edital, doc_tipo,sp_descricao,sp_ordem,doc_status ";
$sql .= " order by doc_ano desc,doc_edital, doc_status,sp_ordem ";
$rlt = db_query($sql);
$sx = '';
$sta = '!';
$xano = 1900;
$ed = '';
require("submissao_resumo_2.php");
	
echo '<TD width="50%">';
$sr = '';
$titulo_pg = 'Projetos PIBITI';
$sql = "select sp_descricao,sp_ordem,count(*) as total,doc_tipo,doc_status, doc_ano, doc_edital from ".$tabela." ";
$sql .= "inner join submit_manuscrito_tipo on doc_tipo = sp_codigo ";
$sql .= " where (doc_edital = 'Pibiti'  or doc_edital = 'PIBITI')  and (doc_status <> 'X')";
$sql .= " group by doc_ano, doc_edital, doc_tipo,sp_descricao,sp_ordem,doc_status ";
$sql .= " order by doc_ano desc, doc_edital,doc_status,sp_ordem ";
$rlt = db_query($sql);
$sx = '';
$sta = '!';
$xano = 1900;
$ed = '';
require("submissao_resumo_2.php");

echo '</TABLE>';
require("foot.php");
?>