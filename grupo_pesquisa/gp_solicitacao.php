<?php
require("cab.php");


?>
<BR>
	
<h1>Instruções para criação de Grupo de Pesquisa</h1>
<P>
	<B>O Grupo de Pesquisa é um conjunto de pesquisadores, técnicos e estudantes envolvidos em pról de um objeto de estudo.</B>
	<BR> 
	<UL>
		<LI>Nome do Grupo de Pesquisa</LI>
		<LI>Nome da(s) Linha(s) de Pesquisa vinculado ao Grupo de Pesquisa</LI>
		
		<LI>Todos os participantes do Grupo de Pesquisa deverão possuir currículo Lattes cadastrado no CNPq.</LI>
		<LI>Lider deve ser docente da PUCPR</LI>
		<LI>Títulação de Doutorado para o(s) lider(es)</LI>
		
		<LI>Proposta de formação do Grupo de Pesquisa (Objetivos)</LI>
		<LI>Área do conhecimento conforme tabela CNPq/CAPES</LI>
		<LI>Carga horária igual ou superior a 12h semanal (para todos os participantes)</LI>
		<LI>Membros efetivos <font color"red">Mestre e Doutores</font></LI>
		<LI>O docente pode pertencer a no máximo três grupos de pesquisa da Instituição</LI>
		
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
		$cracha = $nw->user_cracha;
		$id = $gp->recupera_id_do_grupo($cracha);
		
		echo 'Recupera ID:'.$id;
		if (round($id) > 0) 
			{
				 $dd[0] = $id; 
			} else {
				 $titulo = $dd[1];
				 $anof = $dd[2];
				 $area = $dd[4];
				 $repercursao = $dd[5];
				 $site = $dd[7];
				 $data = date("Ymd");
				 $cracha = $nw->user_cracha;

				 $sql = "insert into ".$gp->tabela." 
				 		(
				 		gp_nome, gp_ano_formacao, gp_area_1,
				 		gp_repercursao, gp_ativo, gp_site,
				 		gp_update, gp_codigo, gp_lider,
				 		gp_status
				 		) values (
				 		'$titulo','$anof','$area',
				 		'$repercursao',1,'$site',
				 		$data,'','$cracha',
				 		'!'
				 		)
				 ";
				 $rlt = db_query($sql);
			}
		
		$gp->updatex();
		$id = $gp->recupera_id_do_grupo($cracha);
		redirecina('gp_solicitacao_2.php?dd1='.$gp->id);
	} else {
		echo $tela;
	}
?>
