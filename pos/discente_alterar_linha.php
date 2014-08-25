<?php
require("cab_pos.php");
require($include.'sisdoc_debug.php');

require("../_class/_class_discentes.php");
$dis = new discentes;

$tabela = $dis->tabela;
require("../_class/_class_pibic_pagamento.php");
$pag = new pagamentos;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_pibic_historico.php");
$hi = new pibic_historico;

$cracha = $dis->le_fluxo($dd[0]);
$dis->le('',$cracha);

echo $dis->mostra_dados_pessoais();

if ($perfil->valid('#SEP'))
	{
		require($include."_class_form.php");
		$form = new form;
		
		$programa = $dis->le_programa_pos($dd[0]);
		
		$cp = $dis->cp_linha_de_pesquisa($programa);
		$tabela = 'docente_orientacao';
		
		echo $form->editar($cp,$tabela);
		
		if ($form->saved > 0)
			{
				redirecina('discentes_orientador.php');
				exit;
			}
		
	} else {
		echo '<H1>Acesso negado</H1>';
	}
require("../foot.php");
