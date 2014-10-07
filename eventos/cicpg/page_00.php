<?
$n = date("s");
$max = 4;
while ($n > $max) { $n = $n - $max; }
$nr = strzero($n,2);

$spot = 'spot-'.$nr.'_'.$LANG.'.png';
echo $spot;
?>
<style>
	.cc2 {
		font-family: Tahoma, Arial, Verdana;
		font-size: 20px;
		color: #2D332D;
		text-align: center;
	}
	.pg01 { background-color: #FFFFFF; }
</style>
<div id="page00" class="page_min pg00">
	
	<table width="100%" cellpadding=0 cellspacing=0 align="center" border=0 style="min-height:500px;">
		<TR valign="top">
			<TD width="510"><img src="img/logo.png" height="306"></TD>
			<TD valign="top" rowspan=3>
				<img src="img/<?php echo $spot; ?>" width="600" align="right">
			</TD>
		</TR>
		<TR>
			<TD align="center" class="lt3 ltsp3">4, 5 e 6 DE NOVEMBRO DE 2014
			<BR>
			Curitiba, Paraná </TD>
		</TR>
		<TR>
			<TD>
			<a href="http://www2.pucpr.br/reol/eventos/cicpg/files/resultado-jovens-ideias.pdf" target="_blank"><img src="img/organizacao_01.jpg" alt="Primeira Foto" /></a>
			<!--<?php require("_banners.php"); ?>-->		
			</TD>
		</TR>
	</table>
	
	
</div>
