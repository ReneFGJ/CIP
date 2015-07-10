<table width="100%" align="right" class="tabela00 lt1">
	<tr>
		<td colspan=5><h3><?php echo $dados['title'];?></h3></td>
	</tr>
	<tr>
		<th width="20%">Vigências das bolsas</td> <th width="20%">PUCPR</th>
		<th width="20%">FA/AG</th>
		<th width="20%">CNPq</th>
		<th width="20%">Total</th>
	</tr>
	<?php
	for ($r = 2010; $r <= date("Y"); $r++) {
		$lb = $r . '-' . ($r + 1);
		echo '<tr>';
		echo '<th align="center">' . $lb . '</th>';
		echo '<td align="center" class="tabela01">' . number_format($dados[$lb][0], 2, ',', '.') . '</td>';
		echo '<td align="center" class="tabela01">' . number_format($dados[$lb][1], 2, ',', '.') . '</td>';
		echo '<td align="center" class="tabela01">' . number_format($dados[$lb][2], 2, ',', '.') . '</td>';
		$tot = $dados[$lb][0] + $dados[$lb][1] + $dados[$lb][2];
		echo '<th align="center" class="tabela01">' . number_format($tot, 2, ',', '.') . '</th>';
	}
	?>
</table>
