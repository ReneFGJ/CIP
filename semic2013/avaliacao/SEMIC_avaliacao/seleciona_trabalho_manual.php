<?php
error_reporting(-1);
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$nomePagina = pathinfo_filename(__FILE__);
$av = new avaliacao($nomePagina);

#Pega os argumentos da p�gina
# ver avaliacao->redireciona() para detalhes
$args = $av->get_args_pagina();
#$persistenciaPost � um par�metroFeio a ser passado pro form::editar s� para manter persist�ncia nos envios de form
# n�o bem sucedidos
$persistenciaPost = $nomePagina.".php?".$av->build_query_pagina($nomePagina, $args);
$idAvaliador = $args["idAvaliador"];
#var_dump($idAvaliador);
$nomeAvaliador = $av->get_nome_avaliador($idAvaliador);

if($av->valida_avaliador($idAvaliador) != ''){
	$hd->renderiza_erro_e_sai();
}

#Cria form de identifica��o do trabalho
$form_id_trab = new form;
$form_id_trab->hidden_error = 1;
$cp = $av->cp_id_trabalho();
$form_id_trab_html = $form_id_trab->editar($cp,'', $persistenciaPost); #Renderiza campos 
$form_id_trab_html = preg_replace('/\<input\s+type="text"/', '<input type="text" autocomplete="off"', $form_id_trab_html);

if ($form_id_trab->saved > 0){
	$idTrabalhoStr = $dd[1]; #XXXFEIO do form
	$av->redireciona("exibe_resumo", array("idAvaliador" => $idAvaliador, "idTrabalhoStr" => $idTrabalhoStr, "tipoTrabalho" => $tipoTrabalho));
}

#### In�cio da renderiza��o da p�gina ####

$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
$botaoEsquerda = array($av->build_url_pagina("seleciona_trabalho",$args), 'icon-circle-arrow-left');
$botaoDireita  = NULL;

echo $hd->cab_logado(NULL, NULL, $nomeAvaliador, "Selecione o trabalho", $botaoEsquerda, $botaoDireita);
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
";

////////////////////////////////////////////////////
require("foot.php");
?>
