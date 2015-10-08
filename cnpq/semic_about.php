<?php
require("cab_cnpq.php");
echo '<h1>Sobre o Evento</h1>';
for ($r=0;$r < 40;$r++)
	{
		$img = "arq/".date("Y")."/Slide".$r.".JPG";
		
		if (file_exists($img))
			{
				echo '<IMG SRC="'.$img.'" width="900"><BR><BR>';
			}
	}
?>
Site: <A href="http://www.pucpr.br/semic">http://www.pucpr.br/semic</A>
<br>
<br>
<br>
<h3>DADOS DO SEMIC</h3>
<table class="lt1">
	<tr><td width="250"></td>
		<td>Oral</td>
		<td>Pôster</td>
		<td>Total Geral</td>
	</tr>
	
	<tr>
	<td width="150" align="right">Total de trabalhos apresentados:</td>
	<td class="lt5 tabela01" width="80" align="center">483</td>
	<td class="lt5 tabela01" width="80" align="center">929</td>
	<td class="lt5 tabela01" width="80" align="center"><b>1227</b></td>
	</tr>
</table>
<br><br>
<table class="lt1">
	<tr><td colspan=2><h3>SOBRE AS AVALIAÇÕES</h3></td></tr>
	<tr>
	<td align="right" width="250">Total de avaliadores:</td>
	<td class="lt5 tabela01" width="80" align="center">208</td>
	</tr>
	<tr>
	<td align="right">Total de indicações:</td>
	<td class="lt5 tabela01" width="80" align="center">302</td>
	</tr>
	<tr>
	<td align="right">Média de indicações / bloco / avaliador:</td>
	<td class="lt5 tabela01" width="80" align="center">1,5</td>
	</tr>	
</table>
<br><br>
<table class="lt1">
	<tr><td colspan=2><h3>DISTRIBUIÇÃO DOS ORIENTADORES POR CAMPUS</h3></td></tr>
	<tr>
		<td><img src="arq/2015/rs_campus.png"></td>
	</tr>
</table>

<br><br>
<table class="lt1">
	<tr><td colspan=2><h3>DISTRIBUIÇÃO DOS ORIENTADORES POR CURSO</h3></td></tr>
	<tr>
		<td><img src="arq/2015/rs_cursos.png" width="450"></td>
		<td><img src="arq/2015/rs_cursos_plus.png" width="450"></td>		
	</tr>
</table>
<br><br>
	
