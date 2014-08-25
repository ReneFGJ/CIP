<?php
require("cab_pos.php");

/* Dados da Classe */
require('../_class/_class_programa_pos.php');
$clx = new programa_pos;


if (strlen($dd[0]))
	{
		$clx->le($dd[0]);
		$_SESSION['pos_nome'] = $clx->nome;
		$_SESSION['pos_codigo'] = $clx->codigo;
		redirecina('pos_graduacao.php');
	}
