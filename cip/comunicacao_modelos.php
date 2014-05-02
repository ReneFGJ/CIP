<?
require("cab_cip.php");
require('../_class/_class_ic.php');
$ic = new ic;
$pre = $dd[1];

echo '<h1>Mensagens de Comunicação</h1>';
echo $ic->row_filter($pre);

echo '
	<form action="comunicacao_editar.php">
	<input type="submit" name="botao" value="Nova mensagen >>" class="botao-geral">
	</form>
	';

require("../foot.php");

?>