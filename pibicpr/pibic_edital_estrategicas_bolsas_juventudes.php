<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

if (strlen($dd[1]) == 0)
	{
		$ano = date("Y");		
	} else {
		$ano = $dd[1];
	}

$meta = 1100;

require($include.'_class_form.php');
$form = new form;

echo '<H3>Edital por Áreas estratégicas para bolsa juventude</h3>';

$sql = "select * from pibic_submit_documento 
		inner join pibic_projetos on pj_codigo = doc_protocolo_mae
		inner join pibic_professor on pj_professor = pp_cracha
		inner join ajax_areadoconhecimento on pj_area_estra = a_cnpq
		left join centro on pp_escola = centro_codigo
		left join (
			select count(*) as nota, pp_protocolo 
			from pibic_parecer_$ano where pp_p05='1' 
			group by pp_protocolo
		) as tabela on pp_protocolo = doc_protocolo
		left join pibic_bolsa_contempladas on doc_protocolo = pb_protocolo and pb_status = 'A'
		left join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		where (doc_ano = '".$ano."') 
			and (pj_status <> 'X')
			and (doc_status <> 'X')
			and pj_ano = '$ano'
			and (pj_area_estra = '9.00.00.01-X')
		order by pj_area_estra, doc_nota desc, pp_nome, doc_protocolo_mae, doc_protocolo
		";
		
$rlt = db_query($sql);
/*
 * 			and  pj_area_estra like '9.%'
			and pj_area_estra <> '9.00.00.00-X'
 * 
 */
$sx = '<Table width="98%" align="center" class="tabela00">';
$sx .= '<TR>
		<TH width="10%">	Col 01
		<TH width="10%">	Col 02
		<TH width="5%">		Col 03
		<TH width="40%">	Col 04
		<TH width="5%">		Col 05
		<TH width="40%">	Col 06
		<TH width="5%">		Col 07
		<TH width="5%">		Col 08
		<TH width="5%">		Col 09
		<TH width="5%">		Col 10
		<TH width="5%">		Col 11
		<TH width="5%">		Col 12
		<TH width="5%">		Col 13		
		';
$tot = 0;
while ($line = db_read($rlt))
	{
		
		$area = $line['pj_area_estra'];
		$area_descricao = $line['a_descricao'];
		$titpl = $line['doc_1_titulo'];
		$titpj = $line['pj_titulo'];
		$nota = $line['doc_nota'];
		$aval = $line['doc_avaliacoes'];
		$prof = $line['pp_nome'];
		$prot = $line['doc_protocolo'];
		$protj = $line['doc_protocolo_mae'];
		
		if ($area != $xarea)
			{	
			$sx .= '<TR><TD colspan=10><font color="blue" class="lt4">';
			$sx .= $area;
			$sx .= $area_descricao;
			$xarea = $area;
			$sx .= '</font>';
			}
		
			$sx .= '<TR>';
			
		//$sx .= '<TR valign="top">';
		$sx .= '<TD class="tabela01">';
		$sx .= $prof;
		$xprof = $prof;
		$sx .= $sh;
		$sx .= '<TD class="tabela01">';
		$sx .= $line['centro_nome'];		
		$sx .= '<TD class="tabela01">';
		$sx .= $protj;
		$sx .= '<TD class="tabela01">';
		$sx .= $titpj;
		$sx .= '<TD class="tabela01">';
		$sx .= $prot;
		$sx .= '<TD class="tabela01">';
		$sx .= $titpl;
		$sx .= '<TD class="tabela01">';
		$sx .= $nota;
		$sx .= '<TD class="tabela01">';
		$sx .= $line['doc_ano'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pb_protocolo'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['doc_edital'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pbt_edital'];
		$sx .= '<TD class="tabela01">';
		$sx .= $line['pb_vies'];
		$sx .= '<TD class="tabela01">[';
		$sx .= $line['nota'].']';
		$tot++;
	}
$sx .= '<TR><TD colspan=5>'.msg('total').' '.$tot;
$sx .= '</table>';
echo $sx;



?>
