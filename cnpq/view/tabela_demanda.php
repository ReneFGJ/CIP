<table width="100%" align="right" class="tabela00 lt1">
	<tr>
		<td colspan=5><BR><BR><h3><?php echo $dados['title'];?></h3></td>
	</tr>
	<tr>
		<th width="20%">&nbsp;</th> 
		<th width="20%">Demanda Bruta</th>
		<th width="20%">Demanda Qualificada</th>
		<th width="20%">Reprovados</th>
		<th width="20%">Demanda Atendida</th>
	</tr>
	<?php
	for ($r = 0; $r < 2; $r++) {
		$lb = $r . '-' . ($r + 1);
		$red = '<font color="red">';
		$green = '<font color="green">';
		$prec_rep = ' ('.number_format($dados[$r][3] / $dados[$r][1] * 100,1,',','.').'%)';
		$prec_ate = ' ('.number_format($dados[$r][4] / $dados[$r][2] * 100,1,',','.').'%)';
		echo '<tr>';
		echo '<th align="center" class="tabela01">' . $dados[$r][0] . '</th>';
		echo '<td align="center" class="tabela01">' . number_format($dados[$r][1], 0, ',', '.') . '</td>';
		echo '<td align="center" class="tabela01">' . number_format($dados[$r][2], 0, ',', '.') . '</td>';
		echo '<td align="center" class="tabela01">' . $red .number_format($dados[$r][3], 0, ',', '.') . $prec_rep. '</font></td>';
		echo '<td align="center" class="tabela01">' . $green. number_format($dados[$r][4], 0, ',', '.') . $prec_ate. '</font></td>';
	}
	?>
<tr>
	<td colspan=5 class="lt0"><?php echo $dados['obs'];?></tr>		
</table>
