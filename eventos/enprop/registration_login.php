<?php
require("cab.php");
require($include."sisdoc_windows.php");
$cp = $evento->cp_login();
$email = $_SESSION["email"];
echo '--->'.$email;
/* Formulario de registro */
$tela = $form->editar($cp,'');
if ($form->saved > 0)
	{
		redirecina("registration_edit.php");
	} else {
		echo $tela;
	}

?>
