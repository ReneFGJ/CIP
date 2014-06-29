<?
$tipo_cab = "Apresentação Oral";
if ($tipo=='Poster') 
{
	$tipo_cab = 'Poster';
	$logo = 'logo_semic20p.jpg'; 
} else {
	$tipo_cab = 'Apresentação Oral';
	$logo = 'logo_semic20o.jpg'; 	
}
?>
<table width="704">
<TR><TD><img src="img/<?=$logo;?>" width="400" alt="" border="0"></TD>
<TD align="right" class="lt1"><B><?=$tit1;?></B><BR><?=$tit2;?></font>
</table><center>
<font class="lt5">Ficha de Avaliação - <?=$tipo;?> - <?=$tipo_cab;?></font>

<table width="704" cellpadding="0" cellspacing="0" align="center">
<TR>
	<TD width="*"><fieldset><Legend class="lt0">Nome do Avaliador</LEGEND><font class="lt2"><B><?=$aval;?></B></font></fieldset></TD>
	<TD width="1%">&nbsp;</TD>
	<TD width="15%" align="right"><fieldset><legend class="lt0">ID Avaliação</legend><center><font class="lt2"><B><NOBR><?=$id;?></B></font></center></fieldset></TD>
</TR>

<TR>
	<TD width="*"><fieldset><Legend class="lt0">Título do trabalho</LEGEND><font class="lt2"><B><?=$titulo;?></B></font></fieldset></TD>
	<TD width="1%">&nbsp;</TD>
	<TD width="15%" align="right"><fieldset><legend class="lt0">ID trabalho</legend><center><font class="lt2"><B><?=$idart;?></B></font></center></fieldset></TD>
</TR>

</table>
<table width="704" cellpadding="0" cellspacing="0" align="center">
<TR><TD>
<div align="right" class="lt1"><B>
<? echo mst_autor($autor,2); ?></B>
<BR><BR>
</div>
<div class="lt1" align="justify"><?=$resumo;?></div>
<div align="left" class="lt0"><BR>
<? echo troca(mst_autor($autor,3),chr(13),'&nbsp;&nbsp;&nbsp;'); ?>
<BR><BR>
</div>
</table>
<?
///////////////////// RESUMO
$tit_aval = '<font color="gray">(A)</font> RESUMO';
$crit1 = "Clareza";
$crit2 = "Poder de Síntese";
$crit3 = "Contribuição para formação científica";
require("ficha_avaliacao_resumo.php");

if ($tipo == 'Oral')
{
	///////////////////// RESUMO
	$tit_aval = '<font color="gray">(B)</font> APRESENTAÇÃO ORAL';
	$crit1 = "Conteúdo";
	$crit2 = "Qualidade Visual";
	$crit3 = "Desempenho do Aluno";
	require("ficha_avaliacao_resumo.php");
}

if ($tipo == 'Poster')
{
	///////////////////// RESUMO
	$tit_aval = '<font color="gray">(C)</font> PÔSTER';
	$crit1 = "Conteúdo";
	$crit2 = "Qualidade Visual";
	$crit3 = "Desempenho do Aluno";
	require("ficha_avaliacao_resumo.php");
}
require("ficha_avaliacao_foot.php");
?>