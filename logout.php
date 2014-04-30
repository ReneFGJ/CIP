<?php
session_start();
require("cab_root.php");
$user = new usuario;
$user->LimparUsuario();

				$_SESSION["user_login"] = '';
				$_SESSION["user_nome"] = '';
				$_SESSION["user_nivel"] = '';
				$_SESSION["user_chk"] = '';
				$_SESSION["user_id"] = '';
				$_SESSION["user_perfil"] = '';
				$_SESSION["user_cracha"] = '';
				$_SESSION["user_ss"] = '';
				
				setcookie("user_login", '', time());
				setcookie("user_nome", '', time());
				setcookie("user_nivel", '', time());
				setcookie("user_chk", '', time());
				setcookie("user_id", '', time());
				setcookie("user_perfil", '', time());
				setcookie("user_cracha", '', time());
				setcookie("user_ss", '', time());
				
//redirecina('login.php');
session_destroy();
?>
<meta http-equiv="refresh" content="0;url=login.php" />