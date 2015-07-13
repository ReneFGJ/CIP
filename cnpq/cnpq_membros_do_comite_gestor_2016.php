<?
$breadcrumbs=array();
require("cab_cnpq.php");

require("../_class/_class_docentes.php");
$pb = new docentes;

?>
<h1><b>Membros do Comitê Gestor</b></h1>
<span class="corpo-texto-explicativo">

<h2>Coordenação</h2>
<table width="100%"><tr><td>
<a href="http://buscatextual.cnpq.br/buscatextual/visualizacv.do?id=K4708823E2" target="_new"><img src="../img/icone_plataforma_lattes_menor.png" height="16" border=0></A>
<font class="lt3">CLEYBE HIOLE VIEIRA (PUCPR)</font>
<A href="mailto:cleybe.vieira@pucpr.br" target="new" title="email: cleybe.vieira@pucpr.br"><img src="../img/icone_email.png" height="16"></A>	
</font>
</td></tr></table>

<h2>Comite Gestor da Inciação Científica</h2>
<?php
$sql = "select * from pibic_professor 
			left join apoio_titulacao on pp_titulacao = ap_tit_codigo
			where pp_comite = '2' and pp_ativo = '1' order by pp_nome ";
$rlt = db_query($sql);
$tot = 0;
$sx .= '<table width="100%">';
while ($line = db_read($rlt))
	{
		$lattes = trim($line['pp_lattes']);
		$lattes = '<a href="'.$lattes.'" target="_new">';
		$lattes .= '<img src="../img/icone_plataforma_lattes_menor.png" height="16" border=0>';
		$lattes .= '</a>';
		$tot++;
		$sx .= '<tr>';
		$sx .= '<td width="10" class="lt2">'.$lattes.'</td>';
		$sx .= '<td class="lt3">';
		$sx .= trim($line['ap_tit_titulo']).' ';
		$sx .= UpperCase($line['pp_nome']); 
		$sx .= ' (PUCPR)';
		
		$sx .= '<A href="mailto:'.trim($line['pp_email']).'" target="new" title="email: '.trim($line['pp_email']).'"><img src="../img/icone_email.png" height="16"></A>';
		
		$sx .= '</td>';
		$sx .= '</tr>';
	}
$sx .= '<tr><td colspan=10>Total de '.$tot.' membros.</td></tr>';
$sx .= '</table>';
echo $sx;
?>
<BR><BR><BR>
Profa. Gezelda Christiane Moraes é representante do PIBIC_EM (Jr);
<BR>
Paulo Renato Parreira é o representante da Agência PUCPR.
 <?
require("../foot.php");	
?>

