<?php
require("db.php");
require("_class/_class_user_perfil.php");

/* Segurança do Login */
require($include.'sisdoc_security_pucpr.php');
$nw = new usuario;

$id = $dd[0];
if (checkpost($id.$secu)==$dd[90])
	{
		$sql = "select * from ".$nw->usuario_tabela." where id_us = ".round($dd[0]);
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$nw->user_erro = 1;
			$nw->user_msg = '';				
			$nw->user_login = trim($line['us_login']);
			$nw->user_nome = trim($line['us_nome']);
			$nw->user_nivel = 1;
			$nw->user_id = $dd[0];
			$nw->user_perfil = trim($line['us_perfil']);
			$nw->user_cracha = trim($line['us_cracha']);
			$nw->user_ss = trim($line['us_ss']);
			$nw->LiberarUsuario();
			redirecina('main.php');
			}
	} else {
		echo 'Erro de Post';
	}
?>
