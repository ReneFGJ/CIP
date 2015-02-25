<?php
require("cab.php");
require('../_class/_class_pibic_projetos.php');
$pj = new pibic_projetos;
$sql = "";
$sql .= "select * from (";
$sql .= "select count(*) as total, pp_protocolo from pibic_parecer_2012 where (pp_status <> 'X' or pp_status <> 'D') group by pp_protocolo ";
$sql .= ") as tabela ";
$sql .= "inner join pibic_projetos on pp_protocolo = pj_codigo ";
$sql .= " where pj_status ='B' and total >= 2";
$rlt = db_query($sql);

while ($line = db_read($rlt))
{
	$sql = "update pibic_projetos set pj_status = 'C' where pj_codigo = '".trim($line['pj_codigo'])."' ";
	$xrlt = db_query($sql);
}

echo $pj->projetos_lista($dd[1]);

require("../foot.php");
?>
