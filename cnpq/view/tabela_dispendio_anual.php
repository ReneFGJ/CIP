<table width="100%" align="right" class="tabela00 lt1">
	<tr>
		<td colspan=5><h3><?php echo $dados['title']; ?></h3></td>
	</tr>
	<tr>
		<th width="20%"><?php echo $dados['header'][0];?></td> 
		<th width="20%"><?php echo $dados['header'][1];?></th>
		<th width="20%"><?php echo $dados['header'][2];?></th>
		<th width="20%"><?php echo $dados['header'][3];?></th>
		<th width="20%"><?php echo $dados['header'][4];?></th>
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
	<tr>
		<td></td>
	<td colspan=5 class="lt0"><?php echo $dados['obs']; ?></tr>
</table>
