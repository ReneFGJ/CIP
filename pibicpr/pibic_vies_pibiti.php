<?php
require ("cab.php");

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs, array(http . 'admin/index.php', msg('principal')));
array_push($breadcrumbs, array(http . 'admin/index.php', msg('menu')));
echo '<div id="breadcrumbs">' . breadcrumbs() . '</div>';

require ("../_class/_class_parecer_pibic.php");
$clx = new parecer_pibic;

$clx -> tabela = "pibic_parecer_" . date("Y");

echo '<h1>Indicado pelos alivaliadores</h1>';

$sql = "select * from (
			select count(*) as total, doc_autor_principal, pp_protocolo_mae, pp_protocolo, doc_1_titulo from " . $clx -> tabela . "  
			inner join pibic_submit_documento on doc_protocolo = pp_protocolo
			where pp_tipo = 'SUBMP' 
			and pp_status <> 'D'
			and pp_p08 = '1'
			and doc_edital = 'PIBIC'
			group by doc_autor_principal, pp_protocolo_mae, pp_protocolo, doc_1_titulo
		) as tabela 
		inner join pibic_professor on doc_autor_principal = pp_cracha
		left join pibic_bolsa_contempladas on pb_protocolo = pp_protocolo
		left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
			where total >= 1
			order by total desc, pp_protocolo
			";
$rlt = db_query($sql);
$tot = 0;
$sx .= '<table class="tabela00">';
while ($line = db_read($rlt)) {
	$sql = "update pibic_submit_documento set pb_vies = '1' where doc_protocolo = '".$line['pp_protocolo']."' ";
	$rrr = db_query($sql);
	$tot++;
	$sx .= '<TR>';
	$sx .= '<TD>';
	$link = '<A HREF="pibic_projetos_detalhes.php?dd0=' . round(substr($line['pp_protocolo_mae'], 1, 7)) . '" target="new' . $line['pp_protocolo_mae'] . '">';
	$sx .= '<TD>' . $link . $line['pp_protocolo_mae'] . '</A>';
	$sx .= '<TD>';
	$sx .= ' ' . $line['pp_protocolo'];
	$sx .= '<TD>';
	$sx .= ' ' . $line['doc_1_titulo'];
	$sx .= '<TD>';
	$sx .= ' ' . $line['pp_nome'];
	$sx .= '<TD>';
	$sx .= ' ' . $line['pp_email'];
	$sx .= '<TD>';
	$sx .= ' ' . $line['pp_email_1'];
	$sx .= '<TD>';
	$sx .= ' [' . $line['total'] . ']';
	$sx .= '<TD>';
	$sx .= $line['pbt_edital'];

	$sx .= '<TD>';
	$sx .= $line['pbt_descricao'];
}
$sx .= '</table>';
echo $sx;

echo '<BR>--> Total ' . $tot;
echo '<HR>';
echo '<BR><BR><BR>';
require ("../foot.php");
?>