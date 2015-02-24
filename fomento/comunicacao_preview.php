<?
require("cab_fomento.php");
//require($include.'sisdoc_debug.php');
require("_email.php");

if (!(function_exists('msg')))
{ function msg($x) { return($x); } }

require("_class_comunicacao.php");
$cm = new comunicacao;

$cm->le($dd[0]);

echo $cm->mostra();
?>
<table>
	<tr>
		<td>
			<form action="comunicacao.php" method="get">
				<input type="hidden" name="dd0" value="<?php echo $dd[0];?>">
				<input type="submit" name="dd20" value="Alterar">
			</form>
		</td>
		<td>
			<form action="comunicacao_enviar.php" method="get">
				<input type="hidden" name="dd0" value="<?php echo $dd[0];?>">
				<input type="submit" name="dd20" value="Enviar emails >>>">
			</form>
		</td>
	</tr>
</table>