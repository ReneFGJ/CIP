<?php
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");
$av = new Avaliacao;

$nomePagina = page();

#Cria form de identifica��o do trabalho
$form_id_trab = new form;
$form_id_trab->hidden_error = 1;
$cp = $av->cp_id_trabalho_manual();
$form_id_trab_html = $form_id_trab->editar($cp,'', $persistenciaPost); #Renderiza campos 
if ($form_id_trab->saved > 0){
	$idTrabalhoStr = $dd[1]; #XXXFEIO do form
	
	$work = $av->existe_trabalho($idTrabalhoStr);
	redirecina('semic_trabalho_manual_2.php?dd51='.$work);
}

#### In�cio da renderiza��o da p�gina ####
$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
$botaoEsquerda = array($av->build_url_pagina("semic_trabalhos",array()), 'icon-circle-arrow-left');
$botaoDireita  = NULL;

echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, "Selecione o trabalho", $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
$quebraHome  = $hd->quebra('icon-home');
$quebraInsercaoManual = $hd->quebra('icon-info');
echo "
<div id='form_id_trab'>
	$quebraInsercaoManual
	<p> <i>Insira o c�digo do trabalho abaixo.</i>
	<br>
	$form_id_trab_html
</div>

</div>
";
////////////////////////////////////////////////////
require("foot.php");
?>
