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
		inner join pibic_aluno on pa_cracha	= doc_aluno
        left join apoio_titulacao on pp_titulacao = ap_tit_codigo		
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
		<TH width="10%">	Aluno
		<TH width="10%">	Curso_Aluno
		<TH width="15%">	Professor
		<TH width="5%">		Titulação
		<TH width="5%">		SS
		<TH width="7%">		Escola
		<TH width="5%">		Campus
		<TH width="15%">	Nome_Projeto
		<TH width="5%">		Modalidade
		<TH width="5%">		Edital
		<TH width="5%">		Status
		<TH width="5%">		Ano		
				
		';
while ($line = db_read($rlt))
	{
			
		$aluno			=	$line['pa_nome'];
		$curso			=	$line['pp_curso'];
		$prof 			= 	$line['pp_nome'];
		$titulacao		= 	$line['ap_tit_titulo'];
		$strictu 		=  	$line['pp_ss'];	
		$nome_centro	= 	$line['centro_nome'];
		$centro  		= 	$line['pp_centro'];
		$titpj 	 		= 	$line['pj_titulo'];	
		$edital 		= 	$line['doc_edital'];			
		$modali 		= 	$line['pbt_descricao'];
		$status		    = 	$line['pb_status'];	
		$ano		    = 	$line['doc_ano'];			
				

		if ($area != $xarea)
			{	
				$sx .= '<TR><TD colspan=10><font color="blue" class="lt4">';
				$sx .= $area;
				$sx .= $area_desc;
				$xarea = $area;
				$sx .= '</font>';
			}
						
		$sx .= '<TR>';	
		$sx .= '<TD class="tabela01">';
		$sx .= $aluno;		
		$sx .= '<TD class="tabela01">';
		$sx .= $curso;		
		$sx .= '<TD class="tabela01">';
		$sx .= $prof;			
		$sx .= '<TD class="tabela01">';
		$sx .= $titulacao;			
		$sx .= '<TD class="tabela01">';
		$sx .= $strictu;			
		$sx .= '<TD class="tabela01">';
		$sx .= $nome_centro;
		$sx .= '<TD class="tabela01">';
		$sx .= $centro;
		$sx .= '<TD class="tabela01">';
		$sx .= $titpj;						
		$sx .= '<TD class="tabela01">';
		$sx .= $edital;	
		$sx .= '<TD class="tabela01">';
		$sx .= $modali;	
		$sx .= '<TD class="tabela01">';
		$sx .= $status;	
		$sx .= '<TD class="tabela01">';
		$sx .= $ano;			
		$tot++;
	}
$sx .= '<TR><TD colspan=5>'.msg('total').' '.$tot;
$sx .= '</table>';
echo $sx;

?>
