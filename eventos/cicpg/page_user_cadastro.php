<?php
require("cab.php");
require($include.'sisdoc_debug.php');
require('_class/_class_usuario.php');
$us = new user;
$id = $_SESSION['user_id'];

if (round($id) == 0) { redirecina('page_submit.php'); }
$us->le($id);

$vl = $us->valida_cadastro();

echo '<BR><BR><BR><BR><BR><h1>Cadastro do usuário</h1>';

require('page_form.php');

$dd[0] = $id;
$cp = $us->cp();
$tela = $form->editar($cp,$us->tabela);


if ($form->saved > 0)
	{
		redirecina('page_user.php');
	} else {
		echo $tela;
	}

require("foot.php");
?>
