<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

$ano = date("Y");
$meta = 1100;

require($include.'_class_form.php');
$form = new form;

echo '<H3>Edital por áreas estratégicas</h3>';

$sql = "select * from pibic_submit_documento 
		inner join pibic_projetos on pj_codigo = doc_protocolo_mae
		inner join pibic_professor on pj_professor = pp_cracha
		inner join ajax_areadoconhecimento on pj_area_estra = a_cnpq
		where pj_area_estra <> '9.00.00.00-X'
			and (doc_ano = '".date("Y")."') 
			and (pj_status <> 'X')
			and (doc_status <> 'X')
			and  pj_area_estra like '9.%'
			and pj_area_estra <> '9.00.00.00-X'
		order by pj_area_estra, doc_nota desc, pp_nome, doc_protocolo_mae, doc_protocolo
		";
$rlt = db_query($sql);

$sx = '<Table width="98%" align="center" class="tabela00">';
$sh = '<TR><TH>Proto<TH>Projeto do professor<TH>Proto<TH>Plano de trabalho<TH>Nota';
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
			$sx .= '<TR><TD class="tabela00 lt4" colspan=5><font color="blue">';
			$sx .= $area;
			$sx .= $area_descricao;
			$xarea = $area;
			$sx .= '</font>';
			}
		
		if ($prof != $xprof)
			{
			$sx .= '<TR><TD class="tabela00 lt4" colspan=5>';
			$sx .= $prof;
			$xprof = $prof;
			$sx .= $sh;
			}
		$sx .= '<TR valign="top">';
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
		$tot++;
	}
$sx .= '<TR><TD colspan=5>'.msg('total').' '.$tot;
$sx .= '</table>';
echo $sx;



?>
