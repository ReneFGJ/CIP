<?
    /**
     * Classe de Área do Conhecimento
	 * @author Rene Faustino Gabriel Junior <renefgj@gmail.com> (Analista-Desenvolvedor)
	 * @copyright Copyright (c) 2011, PUCPR
	 * @access public
     * @version v0.11.30;
	 * @link http://www2.pucpr.br/reol2/
	 * @package Classe
	 * @subpackage UC0004 - Gerar relatório do número de trabalhos PIBIC e PIBITI pelas áreas
     */
	 
require("cab.php");
require("_class_area_do_conhecimento.php");
require($include."sisdoc_form2.php");
require($include."cp2_gravar.php");

/* Busca o ano */
if (strlen($dd[2]) > 0)
	{ $pibic_ano = $dd[2]; }
	
		echo '<font class="lt4">Relatório número de trabalhos por área / centro</font><BR></B>';
		echo '<font class="lt4">Edital '.$pibic_ano.'</font>';
		echo '<BR><font class="lt3">Curso do Aluno</font>';
		
/* Abre um objeto para área do conhecimento */
$area = new area_do_conhecimento;
	
	
		$tabela = '';
		$cp = array();
		array_push($cp,array('$H8','','De',True,True,''));
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$[2009-'.date("Y").']','','Informe o ano de abertura do edital',False,True,''));


		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '</TABLE>';	

/* Ano do relatório informado corretamente */
if ($saved > 0)
{
	
$tabela = "pibic_bolsa_contempladas";

/* Monta a query de consulta */
$cp = '*';
$cp = 'doc_edital, pa_centro,pa_curso,pb_area_conhecimento ';
$sql = "select $cp ,count(*) as total from pibic_bolsa_contempladas ";
//$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where pb_status <> 'C' ";

if (strlen($dd[0]) > 0)
	{
		$sql .= " and (pb_tipo = '".$dd[0]."' )";
	}

$sql .= " and pb_ano = '".$pibic_ano."' ";
$sql .= " group by ".$cp;
$sqlo = " order by doc_edital, pb_area_conhecimento, pa_centro, pa_curso ";

$sql .= $sqlo;
$rlt = db_query($sql);
$ct = 'x';
$ar = 'x';

$to = 0;
$tot = 0;
$totc = 0;
$totg = 0;
$sh = '<TR><TH>Curso</TH><TH>Total</TH></TR>';
$se = '';

/* Gera relatório */
while ($line = db_read($rlt))
	{
//	$pb_protocolo = $line['pb_protocolo'];
	$pa_curso = $line['pa_curso'].'&nbsp;';
	$pa_centro = $line['pa_centro'];
	$pb_area_conhecimento = trim($line['pb_area_conhecimento']);
	$doc_edital = trim($line['doc_edital']);
	$total = $line['total'];
	$sc = '';	$sd = '';
	if ($ar != $pb_area_conhecimento)
		{
		$ar = $pb_area_conhecimento;
		if ($totc > 0)
			{ 
			$sx .= '<TR><TD align="left"><I><B>'.$nm.'<TD align="right">'.number_format($totc,0).'</I></B></TD></TR>'; 
			$sd .= '<TR><TD colspan="2" align="right"><I><B>Sub-total por área '.number_format($totc,0).'</I></B></TD></TR>'; 
			}
		$nm = $doc_edital.' - '.$area->mostrar($pb_area_conhecimento);
		$sc .= '<TR '.coluna().'><TD class="lt4" colspan="2" align="center"><font color="blue"><B>'.$nm.'</TD></TR>';
		$sc .= $sh;
		$totc = 0;
		}
	
	if ($ct != $pa_centro)
		{
		if ($to > 0)
			{ $sr .= '<TR><TD colspan="2" align="right"><I>Sub-total '.number_format($to,0).'</I></TD></TR>'; }
		$sr .= $sd;
		$sr .= $sc;
		$sr .= '<TR><TD class="lt3" colspan="2" align="center"><B>'.$pa_centro.'</TD></TR>';
		$to = 0;
		$ct = $pa_centro;
		}
	$sr .= '<TR '.coluna().' >';
	$sr .= '<TD>';
	$sr .= $pa_curso;;
	$sr .= '<TD align="center">';
	$sr .= $total;
	$sr .= '</TR>';
	$to = $to + $total;
	$tot = $tot + $total;
	$totc = $totc + $total;
	$totg = $totg + $total;
	}
if ($to > 0)
	{ $sr .= '<TR><TD colspan="2" align="right"><I>Sub-total '.number_format($to,0).'</I></TD></TR>'; }

if ($totc > 0)
	{ 
	$sx .= '<TR '.coluna().'><TD align="left"><I><B>'.$nm.'<TD align="right">'.number_format($totc,0).'</I></B></TD></TR>'; 
	$sr .= '<TR><TD colspan="2" align="right"><I>Sub-total por área '.number_format($totc,0).'</I></TD></TR>'; 
	}

if ($totg > 0)
	{ $sx .= '<TR><TD colspan="2" align="right" class="lt4"><I>Total geral '.number_format($totg,0).'</I></TD></TR>'; }

	
/* Mostra resultados na tela */
echo '<BR>';
echo '<table border="1" class="lt1" width="704">';
echo $sx;
echo '</table>';
echo '<BR>';
echo '<table border="0" class="lt0" width="704">';
echo $sr;
echo '</table>';
}
require("foot.php");
?>