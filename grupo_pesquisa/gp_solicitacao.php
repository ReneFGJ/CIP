<?php
require("cab.php");


?>
<BR>
	
<h1>Instruções para criação de Grupo de Pesquisa</h1>
<P>
	<UL>
		<LI>Lider deve ser docente da PUCPR</LI>
		<LI>Títulação de Doutorado para o(s) lider(es)/LI>
		<LI>Todos os participantes devem ter Lattes</LI>
		<LI>Nome do Grupo de Pesquisa</LI>
		<LI>Nome da(s) Linha(s) de Pesquisa vinculado ao Grupo de Pesquisa</LI>
		<LI>Proposta de formação do Grupo de Pesquisa (Objetivos)</LI>
		<LI>Área do conhecimento conforme tabela CNPq/CAPES</LI>
		<LI>Carga horária igual ou superior a 12h semanal (para todos os participantes)</LI>
		<LI>Membros efetivos <font color"red">Mestre e Doutores</font></LI>
		<LI>O docente pode pertencer a no máximo três grupos de pesquisa da Instituição</LI>
		
		<LI>Ata do colegiado do curso (upload)</LI>
		<LI>Ata do colegiado da COPESQ da Escola (upload)</LI>
		
		<LI>Criar um passo a passo (POP)</LI>		
	</UL>
</P>

<?
require($include.'_class_form.php');
$form = new form;

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

$tabela = $gp->tabela;
echo '-->'.$tabela;
$cp = $gp->cp_novo_grupo();
$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		$id = $gp->recupera_id_do_grupo($dd[1]);
		if (strlen($id) > 0) { $dd[0] = $id; }
		$tela = $form->editar($cp,$tabela);
		$gp->updatex();
				
		redirecina('gp_solicitacao_2.php?dd1='.$gp->id);
	} else {
		echo $tela;
	}
?>
