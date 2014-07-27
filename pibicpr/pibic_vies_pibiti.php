<?php
require("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_parecer_pibic.php");
$clx = new parecer_pibic;


$clx->tabela = "pibic_parecer_".date("Y");
echo '<h1>Indicado por dois dos alivaliadores</h1>';
$sql = "select * from (
			select count(*) as total, pp_protocolo_mae, pp_protocolo, doc_1_titulo from ".$clx->tabela."  
			inner join pibic_submit_documento on doc_protocolo = pp_protocolo
			where pp_tipo = 'SUBMP' 
			and pp_status <> 'D'
			and pp_p08 = '1'
			and doc_edital = 'PIBIC'
			group by pp_protocolo_mae, pp_protocolo, doc_1_titulo
		) as tabela 
			where total = 2
			order by pp_protocolo
			";
$rlt = db_query($sql);
$tot = 0;
while ($line = db_read($rlt))
{
	$tot++;
	$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.
				round(substr($line['pp_protocolo_mae'],1,7)).
				'" target="new'.$line['pp_protocolo_mae'].'">';
	echo '<BR><TT>'.$link.$line['pp_protocolo_mae'].'</A>';
	echo ' '.$line['pp_protocolo'];
	echo ' '.$line['doc_1_titulo'];
	echo ' ['.$line['total'].']';
}
echo '<BR>--> Total '.$tot;
echo '<HR>';
echo '<h1>Indicado por um dos alivaliadores</h1>';

$sql = "select * from (
			select count(*) as total, pp_protocolo_mae, pp_protocolo, doc_1_titulo from ".$clx->tabela."  
			inner join pibic_submit_documento on doc_protocolo = pp_protocolo
			where pp_tipo = 'SUBMP' 
			and pp_status <> 'D'
			and pp_p08 = '1'
			and doc_edital = 'PIBIC'
			group by pp_protocolo_mae, pp_protocolo, doc_1_titulo
		) as tabela 
			where total = 1
			order by pp_protocolo
			";
$rlt = db_query($sql);
$tot = 0;
while ($line = db_read($rlt))
{
	$tot++;
	$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.
				round(substr($line['pp_protocolo_mae'],1,7)).
				'" target="new'.$line['pp_protocolo_mae'].'">';
	echo '<BR><TT>'.$link.$line['pp_protocolo_mae'].'</A>';
	echo ' '.$line['pp_protocolo'];
	echo ' '.$line['doc_1_titulo'];
	echo ' ['.$line['total'].']';
}
echo '<BR>--> Total '.$tot;
echo '<HR>';
echo '<BR><BR><BR>';
require("../foot.php");	
?>