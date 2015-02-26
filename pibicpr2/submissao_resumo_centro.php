<?
require("cab.php");
require($include."sisdoc_debug.php");
$ano = date("Y");
$cpi = "";
$tabela = "pibic_submit_documento";
$http_ver = 'ed_pibic_submit_article.php';

echo '<TABLE border="1" width="'.$tab_max.'">';
echo '<TR valign="top">';
echo '<TD width="50%">';
$sr = '';
$titulo_pg = 'Projetos PIBIC';
$sql = "select pp_centro, sp_descricao,sp_ordem,count(*) as total,doc_tipo,doc_status, doc_ano, doc_edital from ".$tabela." ";
$sql .= "inner join submit_manuscrito_tipo on doc_tipo = sp_codigo ";
$sql .= "inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " where (doc_edital = 'PIBIC')";
$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";
$sql .= " and (doc_ano = '".$ano."') ";
$sql .= " group by doc_ano,  pp_centro, doc_edital, doc_tipo,sp_descricao,sp_ordem,doc_status ";
$sql .= " order by doc_ano desc, pp_centro, doc_edital, doc_status,sp_ordem ";
$rlt = db_query($sql);
$sx = '';
$sta = '!';
$xano = 1900;
$ed = '';
require("submissao_resumo_2A.php");
	
echo '<TD width="50%">';
$sr = '';
$titulo_pg = 'Projetos PIBITI';
$sql = "select pp_centro, sp_descricao,sp_ordem,count(*) as total,doc_tipo,doc_status, doc_ano, doc_edital from ".$tabela." ";
$sql .= "inner join submit_manuscrito_tipo on doc_tipo = sp_codigo ";
$sql .= "inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " where (doc_edital <> 'PIBIC')";
$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";
$sql .= " and (doc_ano = '".$ano."') ";
$sql .= " group by doc_ano,  pp_centro, doc_edital, doc_tipo,sp_descricao,sp_ordem,doc_status ";
$sql .= " order by doc_ano desc, pp_centro, doc_edital, doc_status,sp_ordem ";
$rlt = db_query($sql);
$sx = '';
$sta = '!';
$xano = 1900;
$ed = '';
require("submissao_resumo_2A.php");

echo '</TABLE>';
require("foot.php");
?>