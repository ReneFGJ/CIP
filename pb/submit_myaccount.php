<?
require_once($include.'sisdoc_windows.php');
require_once($include.'_class_form.php');
$form = new form;

require("_class/_class_submit.php");
$clx = new submit;

$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; } else {
		/* Envia para página de login */
		$page = $_SERVER['REQUEST_URI']; 
		$page = troca($page,'submit_myaccount','submit');
		redirecina($page);		
		exit;
	}

echo '<h1>'.msg('edit_my_account').'</h1>';
$dd[0] = $clx->author_codigo;
$cp = $clx->cp_user();

$tabela = $clx->tabela_autor;
$page = http.'pb/index.php/'.$path.'?dd99=submit_myaccount';
$tela = $form->editar($cp,$tabela,$page);
if ($form->saved > 0)
	{
		$link = http.'pb/index.php/'.$path.'?dd0='.$id.'&dd99=submit';
		redirecina($link);	
	} else {
		echo $tela;
	}

