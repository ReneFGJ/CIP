<?php
require("cab.php");

echo '<h1>Planos do dupla reprocação</h1>';

$ano = (date("Y")-1);
$sql = "select * from pibic_bolsa_contempladas 
			left join pibic_professor on pb_professor = pp_cracha
			left join ajax_areadoconhecimento on pb_semic_area = a_cnpq
			where pb_ano = '".$ano."' 
			and (pb_relatorio_parcial_correcao_nota = 2
			or pb_relatorio_parcial_correcao_nota = -91)
			and pb_status = 'A'
			order by a_cnpq
			";
$rlt = db_query($sql);

$sx = '<table width="100%" >';
$sx .= '<thead><TR><TH width="5%">protocolo</TH>
				<TH width="60%">Projeto</TH>
				<TH width="30%">Professor</TH>
				<TH>Decisão</TH></TR>'; 
$to = 0;
$xarea = '';
while ($line = db_read($rlt))
{
	$area = trim($line['a_cnpq']);
	if ($xarea != $area)
		{
			$sx .= '<TR><TD colspan=6 class="lt2"><B>'.$area.' - '.$line['a_descricao'].'</b></td></tr>';
			$xarea = $area;
		}
	$link = '<A HREF="pibic_detalhe.php?dd0='.$line['pb_protocolo'].'&dd90='.checkpost($line['pb_protocolo']).'">';
	$sx .= '<TR>';
	$sx .= '<TD class="tabela01">';
	$sx .= $link.$line['pb_protocolo'].'</A>';
	$sx .= '<TD class="tabela01">';
	$sx .= $line['pb_titulo_projeto'];
	$sx .= '<TD class="tabela01">';
	$sx .= $line['pp_nome'];
	//$sx .= '<TD class="tabela01">';
	//$sx .= $line['pb_relatorio_parcial_correcao_nota'];
	$sx .= '<TD class="tabela01" align="center">';
	$sx .= '<table style="width: 30px; height: 30px;" border=1>';
	$sx .= '<TR><TD>&nbsp;<//td></tr>';
	$sx .= '</table>';	
	$to++;
	$ln = $line;
}
$sx .= '<TR><TD colspan=5>Legenda: A - Aprovado; R - Manter reprovação';
$sx .= '</table>';
$sx .= 'Total '.$to.' de projetos';
echo $sx;
?>