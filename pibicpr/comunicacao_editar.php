<?
require("cab.php");
require('../_class/_class_ic.php');
$journal_id = 20;
require($include.'/_class_form.php');
$form = new form;

$ic = new ic;
$pre = $dd[1];

/* Página Origem */
if (strlen($acao)==0)
	{
		$pg = $_SERVER['HTTP_REFERER'];
		$_SESSION['page_origem'] = $pg;
	}
echo '<h1>Editar Mensagens de Comunicação</h1>';

$cp = $ic->cp();
$tabela = $ic->tabela;
$tela = $form->editar($cp,$tabela);

if ($form->saved == 0)
	{
		echo $tela;
	} else {
		$pg = trim($_SESSION['page_origem']);
		if (strlen($pg) > 0)
			{ redirecina($pg); } else {
				echo 'SALVO';
			} 
	}

require("../foot.php");

?>