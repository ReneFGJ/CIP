<?php
require("cab.php");


?>
<BR>
	
<h1>Instru��es para cria��o de Grupo de Pesquisa</h1>
<P>
	<B>O Grupo de Pesquisa � um conjunto de pesquisadores, t�cnicos e estudantes envolvidos em pr�l de um objeto de estudo.</B>
	<BR> 
	<UL>
		<LI>Nome do Grupo de Pesquisa</LI>
		<LI>Nome da(s) Linha(s) de Pesquisa vinculado ao Grupo de Pesquisa</LI>
		
		<LI>Todos os participantes do Grupo de Pesquisa dever�o possuir curr�culo Lattes cadastrado no CNPq.</LI>
		<LI>Lider deve ser docente da PUCPR</LI>
		<LI>T�tula��o de Doutorado para o(s) lider(es)</LI>
		
		<LI>Proposta de forma��o do Grupo de Pesquisa (Objetivos)</LI>
		<LI>�rea do conhecimento conforme tabela CNPq/CAPES</LI>
		<LI>Carga hor�ria igual ou superior a 12h semanal (para todos os participantes)</LI>
		<LI>Membros efetivos <font color"red">Mestre e Doutores</font></LI>
		<LI>O docente pode pertencer a no m�ximo tr�s grupos de pesquisa da Institui��o</LI>
		
		<LI>Ata do colegiado do curso (upload)</LI>
		<LI>Ata do colegiado da COPESQ da Escola (upload)</LI>
			
	</UL>
</P>

<?
/* <LI>Criar um passo a passo (POP)</LI> */
require($include.'_class_form.php');
$form = new form;

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

$tabela = $gp->tabela;
$cp = $gp->cp_novo_grupo();
$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		$id = $gp->recupera_id_do_grupo($dd[1]);
		if (strlen($id) > 0) { $dd[0] = $id; }
		$tela = $form->editar($cp,$tabela);
		$gp->updatex();
		$id = $gp->recupera_id_do_grupo($dd[1]);		
		redirecina('gp_solicitacao_2.php?dd1='.$gp->id);
	} else {
		echo $tela;
	}
?>