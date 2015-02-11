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

require("../_class/_class_linha_de_pesquisa.php");
$ln = new linha_de_pesquisa;

$tabela = $gp->tabela;

$cp = $ln->cp_linhas();
$tela = $form->editar($cp,'');
$gp->le($dd[1]);

echo $gp->mostra_dados();
//echo $gp->grupo_de_pesquisa_membros_listar();
echo $ln->mostra_linhas_de_pesquisa($dd[1]);

if ($form->saved > 0)
	{
		print_r($dd);
		
		echo $ln->linha_de_pesquisa_atualizar($dd[3],$dd[4],strzero($dd[1],7),$dd[5]);
		
		$tela = $form->editar($cp,'');	
		redirecina('gp_solicitacao_3.php?dd1='.$dd[1]);
	} else {
		echo $tela;
	}
	
echo '<form action="gp_solicitacao_3.phpdd1=?'.$dd[1].'" method="post">';
echo '<input type="submit" value="Cadastrar linhas de pesquisa >>>">';
echo '</form>';
?>
