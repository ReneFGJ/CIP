<?php
require("cab.php");
require($include.'sisdoc_data.php');
echo '<BR><BR><BR><BR><BR><BR>';
require("../../db_reol2_pucpr.php");
require("_class/_class_painel.php");
$pn = new painel;
echo '

<h1>Localização dos paineis</h1>
<div>
<form method="get">
Informe o código do trabalho <input type="text" size=14 name="dd1">
<input type="submit" value="localizar" name="acao">
</form>
</div>

<center>';
echo $pn->mostra_painel($dd[1]);
echo '<BR><BR><BR>';
echo '</center>';
require("foot.php");

?>