<?php
require("cab.php");


?>
<BR>
	
<h1>Cadastro de Participantes (Professores da Instituição)</h1>

<?
require($include.'_class_form.php');
$form = new form;

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

$tabela = $gp->tabela;

$cp = $gp->cp_membros();
$tela = $form->editar($cp,'');
$gp->le($dd[1]);

echo $gp->mostra_dados();
echo $gp->grupo_de_pesquisa_membros_listar();

if ($form->saved > 0)
	{
		print_r($dd);
		
		echo $gp->inserir_professor_membro($dd[3],$dd[4]);
		
		$tela = $form->editar($cp,'');		
		redirecina('gp_solicitacao_2.php?dd1='.$dd[1]);
	} else {
		echo $tela;
	}
	
echo '<form action="gp_solicitacao_3.php?dd1='.$dd[1].'" method="post">';
echo '<input type="submit" value="Cadastrar linhas de pesquisa >>>">';
echo '</form>';
?>
