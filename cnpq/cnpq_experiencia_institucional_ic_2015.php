<?
$breadcrumbs=array();
require("cab_cnpq.php");

$sx = '
<h1 align="center">EXPERIÊNCIA INSTITUCIONAL NA INICIAÇÃO CIENTÍFICA</h1>
<h2>PIBIC e PIBITI</h2>
<span class="corpo-texto-explicativo lt3">
O Programa Institucional de Bolsas de Iniciação Científica (PIBIC) teve um grande salto qualitativo e quantitativo nos últimos anos.
'; 
$sx .= '<BR>'.('A adesão da PUCPR ao programa PIBITI ocorreu em 2010.');
$sx .= '
<BR><BR>O número de alunos envolvidos no PIBIC e PIBITI pode ser visualizado a seguir:
<BR><BR>
<B>Quadro 1 - Número de Bolsas de Programas de Iniciação Científica e Tecnológica da Instituição (2008 - 2014)</B>
<table class="tabela00 lt2" width="90%" align="center">
	<TR><TH>ANO</TH>
		<TH>PIBIC/PUCPR</TH>
		<TH>Fundação Araucária</TH>
		<TH>CNPq/PIBIC</TH>
		<TH>PIBITI/PUCPR</TH>
		<TH>CNPq/PIBITI</TH>
		<TH>TOTAL</TH>	
<TR><TD class="tabela01" align="center"><NOBR>2008-2009<TD class="tabela01" align="center">150<TD class="tabela01" align="center">28	
		<TD class="tabela01" align="center">68	<TD class="tabela01" align="center">----	<TD class="tabela01" align="center">----	<TD class="tabela01" align="center">246
<TR><TD class="tabela01" align="center">2009-2010<TD class="tabela01" align="center">150<TD class="tabela01" align="center">57	<TD class="tabela01" align="center">81	<TD class="tabela01" align="center">----	<TD class="tabela01" align="center">----	<TD class="tabela01" align="center">288
<TR><TD class="tabela01" align="center">2010-2011<TD class="tabela01" align="center">160<TD class="tabela01" align="center">58 	<TD class="tabela01" align="center">90	<TD class="tabela01" align="center">50		<TD class="tabela01" align="center">30		<TD class="tabela01" align="center">388
<TR><TD class="tabela01" align="center">2011-2012<TD class="tabela01" align="center">225<TD class="tabela01" align="center">130 	<TD class="tabela01" align="center">95	<TD class="tabela01" align="center">50		<TD class="tabela01" align="center">30		<TD class="tabela01" align="center">530
<TR><TD class="tabela01" align="center">2012-2013<TD class="tabela01" align="center">325<TD class="tabela01" align="center">195	<TD class="tabela01" align="center">94	<TD class="tabela01" align="center">50		<TD class="tabela01" align="center">38		<TD class="tabela01" align="center">702
<TR><TD class="tabela01" align="center">2013-2014<TD class="tabela01" align="center">325<TD class="tabela01" align="center">145	<TD class="tabela01" align="center">94	<TD class="tabela01" align="center">50		<TD class="tabela01" align="center">44		<TD class="tabela01" align="center">658
<TR><TD class="tabela01" align="center">2014-2015<TD class="tabela01" align="center">350<TD class="tabela01" align="center">145	<TD class="tabela01" align="center">87	<TD class="tabela01" align="center">55		<TD class="tabela01" align="center">32		<TD class="tabela01" align="center">669<tr>
<TR><TD class="tabela01" align="center">2015-2016<TD class="tabela01" align="center">350<TD class="tabela01" align="center">?	<TD class="tabela01" align="center">87	<TD class="tabela01" align="center">55		<TD class="tabela01" align="center">32		<TD class="tabela01" align="center">524*<tr>
<td colspan="7"><font style="font-size:10px">FONTE: Coordenação de Iniciação Científica - PIBIC PUCPR
<BR>* Não contabilizado bolsas da Fundação Araucária</font></td>
</table>	


<BR>A PUCPR oferta a modalidade voluntária para ambos os programas PIBIC (ICV - Iniciação Científica Voluntária) e PIBITI (ITV - Iniciação Tecnológica Voluntária), os alunos têm os mesmos deveres e direitos dos bolsistas, à exceção dos relativos à devolução de bolsas.

<BR><BR>
<B>Quadro 2 - Número de alunos participantes da iniciação científica voluntária (ICV) e iniciação tecnológica voluntária (ITV) - período: 2008-2015 
   </B>

<table class="tabela00 lt2" width="70%" align="center">
<TR><TH>ANO<TH>Iniciação Científica Voluntária<TH>Iniciação Tecnológica Voluntária<TH>TOTAL
<TR><TD class="tabela01" align="center">2008-2009<TD class="tabela01" align="center">62<TD class="tabela01" align="center">----<TD class="tabela01" align="center">62
<TR><TD class="tabela01" align="center">2009-2010<TD class="tabela01" align="center">117<TD class="tabela01" align="center">----<TD class="tabela01" align="center">117
<TR><TD class="tabela01" align="center">2010-2011<TD class="tabela01" align="center">200<TD class="tabela01" align="center">30<TD class="tabela01" align="center">230
<TR><TD class="tabela01" align="center">2011-2012<TD class="tabela01" align="center">206<TD class="tabela01" align="center">53<TD class="tabela01" align="center">259
<TR><TD class="tabela01" align="center">2012-2013<TD class="tabela01" align="center">370<TD class="tabela01" align="center">40<TD class="tabela01" align="center">410
<TR><TD class="tabela01" align="center">2013-2014<TD class="tabela01" align="center">448<TD class="tabela01" align="center">56<TD class="tabela01" align="center">504
<TR><TD class="tabela01" align="center">2014-2015<TD class="tabela01" align="center">772<TD class="tabela01" align="center">103<TD class="tabela01" align="center">875
<TR><TD class="tabela01" align="center">2015-2016<TD class="tabela01" align="center">524<TD class="tabela01" align="center">95<TD class="tabela01" align="center">823';
$sx .= '<TR><TD colspan=2 class="lt0">* Em fase de implementação';
$sx .= '
<tr>
<td colspan="7"><font style="font-size:10px">FONTE: Coordenação de Iniciação Científica - PIBIC PUCPR</font></td>
</table>
<center>
';
require("view/apresentacao_semic.php");

require("view/apresentacao_origem_bolsas.php");

$sx .= '	 	
<img src="img/IC-2014-01.JPG" width="98%">
<BR>
<img src="img/IC-2014-02.JPG" width="98%">
<BR><BR><BR>
';
echo ($sx);
echo '<BR><BR>';
require("../foot.php");	
?>
