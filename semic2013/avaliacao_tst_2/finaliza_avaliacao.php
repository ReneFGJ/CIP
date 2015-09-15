<?php
error_reporting(-1);
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$essaPagina = pathinfo_filename(__FILE__);
$av = new avaliacao($essaPagina);

#Pega os argumentos da página
# ver avaliacao->redireciona() para detalhes
$args = $av->get_args_pagina();
list($idAvaliador, $idTrabalhoStr, $tipoTrabalho) = array($args["idAvaliador"], $args["idTrabalhoStr"], $args["tipoTrabalho"]);
$nomeAvaliador = $av->get_nome_avaliador($idAvaliador);

$acaoPagina = 'erro';

$erroValidaIdTrabalho = $av->valida_id_trabalho($idAvaliador, $idTrabalhoStr, $tipoTrabalho);

if($erroValidaIdTrabalho == ""){
	$acaoPagina = 'agradecimento';
	$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];
	$urlSelecionaTrabalho = $av->build_url_pagina("seleciona_trabalho", array("idAvaliador" => $idAvaliador));
}

#### Início da renderização da página ####

if($acaoPagina == 'erro'){
	$hd->renderiza_erro_e_sai($acaoPagina);
}

$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr
$botaoEsquerda = NULL;
$botaoDireita  = array($urlSelecionaTrabalho, 'icon-home');

echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, $tituloCab, $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
if($acaoPagina == 'agradecimento'){
	$quebraAgradecimento  = $hd->quebra('icon-edit');
	echo "
$quebraAgradecimento

<p> Obrigado pela sua avaliação. <a href=$urlSelecionaTrabalho> Clique aqui </a> para retornar a página inicial.

";
}


////////////////////////////////////////////////////

require("foot.php");
?>