<?
$dx = 10;
$debug = false;
global $rst;

$sql = "select * from pibic_motivos ";
$sql .= " where mt_ativo = 1 ";
$sql .= " order by mt_codigo,mt_descricao ";
$rrr = db_query($sql);
while ($zline = db_read($rrr)) {
	$sel = '';
	if ($dd[20] == trim($zline['mt_codigo'])) { $sel = 'selected';
	}
	$op .= '<option value="' . trim($zline['mt_codigo']) . '" ' . $sel . '>' . $zline['mt_descricao'] . '</option>';
}
?>
<form method="post">
	<input type="hidden" name="dd0" value="<?=$dd[0]; ?>">
	<input type="hidden" name="dd1" value="<?=$dd[1]; ?>">
	<input type="hidden" name="dd2" value="<?=$dd[2]; ?>">
	<input type="hidden" name="dd3" value="<?=$dd[3]; ?>">
	<input type="hidden" name="dd4" value="<?=$dd[4]; ?>">
	<input type="hidden" name="dd5" value="<?=$dd[5]; ?>">
<table class="lt1" width="98%">
<TR><TD colspan="2" align="center" class="lt3"><B>Substitui��o de Aluno</TD></TR>
<TR><TD colspan="2">Informe o c�digo do cracha do novo aluno</TD></TR>
<TR><TD colspan="2"><input type="text" name="dd10" value="<?=$dd[10]; ?>" size="10" maxlength="8">&nbsp;<input type="submit" name="acao" value="Buscar dados do aluno"></TD></TR>
<TR><TD colspan="2">Informe o motivo da troca</TD></TR>
<TR><TD colspan="2"><select name="dd20" size="1"><?=$op; ?></select></TD></TR>

</form>
<?
if ((strlen($dd[10]) > 5) and (strlen(trim($dd[20])) > 0))
	{
	$crc = $dd[10];
	$cracha = $crc;
	$aluno = $crc;
	require("pucpr_aluno.php");
	}
	if ($rst == true)
		{ 
		$sql = "select * from pibic_aluno where pa_cracha = '".$crc."' ";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		?>
		<TR><TD>Nome do aluno</TD></TR>
		<TR><TD class="lt2" colspan="2"><?=$line['pa_nome']; ?></TD></TR>
		<TR><TD>Curso</TD></TR>
		<TR><TD class="lt2" colspan="2"><?=$line['pa_curso']; ?></TD></TR>
		<TR><TD><font color="red">*** ATEN��O ***</font></TD></TR>
		<TR><TD class="lt2" colspan="2">Aten��o professor,
		<BR>Ao substituir um aluno ser� considerada como substitui��o, podendo no m�ximo duas substitui��es.
		</TD></TR>
		<TR><TD>
			<form method="post">
			<input type="hidden" name="dd0" value="<?=$dd[0]; ?>">
			<input type="hidden" name="dd1" value="<?=$dd[1]; ?>">
			<input type="hidden" name="dd2" value="<?=$dd[2]; ?>">
			<input type="hidden" name="dd3" value="<?=$dd[3]; ?>">
			<input type="hidden" name="dd4" value="<?=$dd[4]; ?>">
			<input type="hidden" name="dd5" value="4">		
			<input type="hidden" name="dd10" value="<?=$crc; ?>">		
			<input type="hidden" name="dd20" value="<?=$dd[20]; ?>">
			<input type="submit" name="acao" value="Confirma Substitui��o para este aluno >>">
			</form>
		</TD></TR>
		<?
		} else
		{
		?>
		<TR><TD colspan="2"><font color="RED">N�mero do Cracha do aluno n�o confere ou n�o foi definido o motivo da substitui��o.</font></TD></TR>
		<?
		}
	?>
</table>
