<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require('_class/_class_usuario.php');
$us = new user;

require("_class/_class_trabalhos.php");
$wk = new works;

$id = $_SESSION['user_id'];

if (round($id) == 0) { redirecina('page_submit.php'); }
$us->le($id);

$vl = $us->valida_cadastro();
if ($vl==0)
	{
		redirecina('page_user_cadastro.php');
		exit;
	}
echo '<BR><BR><BR><BR><BR>';
$editar=1;
echo $us->mostra($editar);

echo $wk->resumo();

require("foot.php");
?>
