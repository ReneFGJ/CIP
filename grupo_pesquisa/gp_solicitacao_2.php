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

require("_ged_grupo_pesquisa.php");

$ged->protocolo = strzero($dd[0],7);

echo $ged->filelist();
echo $ged->upload_botton_with_type();


?>
