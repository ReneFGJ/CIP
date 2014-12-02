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

$gp->le($dd[1]);

echo $gp->mostra_dados();
echo $gp->grupo_de_pesquisa_membros_listar();

echo '<A HREF="inport_gp_cnpq.php?dd0='.$dd[1].'">atualizar dados do DGP/CNPq</A>';


?>
