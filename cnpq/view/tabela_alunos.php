
<table width="100%" align="right" class="tabela00 lt1">
	<tr>
		<td colspan=5><BR><BR><h3><?php echo $dados['title'];?></h3></td>
	</tr>
	
	<tr>
		<th width="17%"><?php echo $dados['header'][0];?></td> 
		<th width="17%"><?php echo $dados['header'][1];?></th>
		<th width="17%"><?php echo $dados['header'][2];?></th>
		<th width="17%"><?php echo $dados['header'][3];?></th>
		<th width="17%"><?php echo $dados['header'][4];?></th>
		<th width="17%"><?php echo $dados['header'][5];?></th>
	</tr>
	
<?php 
for ($r=2010;$r <= date("Y");$r++)
	{
		$asp = '';
		if ($r==date("Y")) { $asp ='*'; }
		$lb = $r.'-'.($r+1);
		echo '<tr>';
		echo '<th align="center">'.$lb.$asp.'</th>';
		echo '<td align="center" class="tabela01">'.number_format($dados[$lb][0],0,',','.').'</td>';
		echo '<td align="center" class="tabela01">'.number_format($dados[$lb][1],0,',','.').'</td>';
		echo '<td align="center" class="tabela01">'.number_format($dados[$lb][2],0,',','.').'</td>';
		echo '<td align="center" class="tabela01">'.number_format($dados[$lb][3],0,',','.').'</td>';
		$tot = $dados[$lb][0] + $dados[$lb][1] + $dados[$lb][2] + $dados[$lb][3];
		echo '<th align="center" class="tabela01">'.number_format($tot,0,',','.').'</th>';
	}
?>	
<tr>
	<td></td>
	<td colspan=5 class="lt0"><?php echo $dados['obs'];?></tr>	
</table>

