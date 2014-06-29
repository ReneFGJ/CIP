<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_extenso.php');
require($include.'sisdoc_debug.php');

$LANG = 'pt_BR';
$file = '../messages/msg_'.$LANG.'.php';
$jid = 0;
if (file_exists($file)) { require($file); } else { echo 'message not found '.$file; }

require("../_class/_class_captacao.php");
$ca = new captacao;

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

$bon->le($dd[0]);

require('../_class/_class_cr.php');
$cr = new cr;
$cr->structure();

require('../_class/_class_pucpr_formulario.php');
$fm = new formulario;

$fm->set_dados($bon);

$cr = $bon->line['bn_cr'];
if (strlen($cr) == 0)
	{
		echo '<H1>CR não informado';
		require($include.'_class_form.php');
		
		$form = new form;
		$tabela = $fm->tabela;
		$cp = $fm->cp_cr();
		$tela = $form->editar($cp,$tabela);
		if ($form->saved > 0)
			{
				require("../close.php");
			} else {
				echo $tela;		
			}
		exit;		
	}


echo $fm->form_solicitacao_pagamento($bon);

?>
