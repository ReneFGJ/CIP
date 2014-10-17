<?php
require ("cab_semic.php");

$jid = strzero(85, 7);
$sql = "select * from submit_documento 
		left join sections on section_id = doc_sessao
		left join ajax_areadoconhecimento on a_cnpq = doc_field_1
		left join submit_autor on doc_autor_principal = sa_codigo
		where (doc_journal_id = '" . $jid . "')
		and (doc_status <> 'X' and doc_status <> '@' and doc_status <> 'P' and doc_status <> 'D')
		order by title, a_cnpq, id_doc desc
		";
$rlt = db_query($sql);
$tot = 0;
$xtp = '';
$sx = '<table>';
while ($line = db_read($rlt)) {
	$tot++;
	$secao = $line['title'];
	$area = $line['a_cnpq'];
	if ($xtp != $secao) {
		$sx .= '<TR><TD class="lt3" colspan=10>';
		$sx .= '<h1>'.$line['title'].'</h1>';
		$xtp = $secao;
	}
	if ($xta != $area) {
		$sx .= '<TR class="tabela01"><TD class="lt2" colspan=10>';
		$sx .= $line['a_descricao'];
		$sx .= $line['a_cnpq'];
		$xta = $area;
	}
	$sx .= '<TR>';
	$sx .= '<TD>' . $line['doc_protocolo'];
	$sx .= '<TD>' . $line['doc_autor_principal'];
	$sx .= '<TD>' . $line['sa_instituicao_text'];	
	$sx .= '<TD>' . $line['doc_status'];
	$sx .= '<TD>' . $line['doc_titulo'];
	$ln = $line;
}
$sx .= '</table>';
echo $sx;
echo '===>' . $tot;
print_r($ln);
?>
