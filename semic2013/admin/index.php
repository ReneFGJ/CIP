<?php
require("cab.php");
?>
<table border=0 width="100%">
	<TR>	
		<TD align="center">	
			<div class="botao-0"><A HREF="../painel.php">Paineis</A></div>
		<TD align="center">	
			<div class="botao-0"><A HREF="http://www2.pucpr.br/reol/semic/avaliacao/SEMIC_avaliacao/">Avaliações</A></div>
<?
if ($staff==1) {
	echo '
	<TR>
		<TD colspan=3><HR>
	<TR>
		<TD align="center">	
			<div class="botao-0"><A HREF="avaliadores.php">Avaliadores</A></div>
		<TD align="center">	
			<div class="botao-0"><A HREF="avaliacoes.php">Não avaliado</A></div>

	';
	if ($dd[1]==1)
		{
	echo '
	<TR>
		<TD align="center">	
			<div class="botao-0"><A HREF="avaliacoes_notas.php">Calc.Notas</A></div>
		<TD align="center">	
			<div class="botao-0"><A HREF="avaliacoes_notas_resultados.php">Resultados</A></div>
		';
		}
	echo '			
	<TR>
		<TD colspan=3><HR>
	<TR>
		<TD align="center">	
			<div class="botao-0"><A HREF="http://www2.pucpr.br/reol/semic/admin/avaliacoes_apresentacao.php">Quant. Ind.</A></div>
						
			
	</TR>
	';
} else {
	echo '
		<TD align="center">	
			<div class="botao-0"><A HREF="staff.php">Login Staff</A></div>
		<TD align="center">	
			<div class="botao-0"><A HREF="http://www2.pucpr.br/reol/semic/avaliacao/SEMIC_avaliacao/">Avaliações</A></div>
		';	
}
echo '</table>';
echo '<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>';
echo '<A HREF="index.php?dd1=1" style="text-decoration: none; color:#808080; font-size:8px;">TT</A>';
