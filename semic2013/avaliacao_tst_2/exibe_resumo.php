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
list($idAvaliador, $idTrabalhoStr, $tipoTrabalho) = array($args["idAvaliador"], $args["idTrabalhoStr"], $args["tipoTrabalho"]);
$nomeAvaliador = $av->get_nome_avaliador($idAvaliador);

$persistenciaPost = $nomePagina.".php?".$av->build_query_pagina($nomePagina, $args);

$acaoPagina = "erro";

#Verifica se o trabalho est� no banco de dados e dispon�vel para o 
# avaliador
#Retorna "" caso n�o hajam erros, uma mensagem de erro caso contr�rio
$erroValidaIdTrabalho = $av->valida_id_trabalho($idAvaliador, $idTrabalhoStr, $tipoTrabalho == "" ? NULL : $tipoTrabalho);

// if($erroValidaIdTrabalho == ""){
// 	#Pega trabalho no banco de dados
list(
	$idTrabalhoStrCanon,
	list($tituloEmPortugues, $tituloInternacional),
	$nomeAutores,
	list($resumoEmPortugues, $resumoInternacional),
	$ehInternacional) = $av->get_trabalho($idAvaliador, $idTrabalhoStr, False);

if($idTrabalhoStrCanon === NULL){
	$acaoPagina = 'erroDb';
}
else{
	$acaoPagina = 'exibeResumo';
	if($ehInternacional && $idTrabalhoStrCanon[0] == 'i'){
		#Exibe resumo internacional se o trabalho tiver
		# resumo internacional e a id do trabalho canonica
		# come�ar com i min�sculo
		# Fazendo fallback para campos nacionais caso eles n�o
		# existam
		$titulo = $tituloInternacional==''? $tituloEmPortugues : $tituloInternacional;
		$resumo = $resumoInternacional==''? $resumoEmPortugues : $resumoInternacional;
	}
	else{
		$titulo = $tituloEmPortugues;
		$resumo = $resumoEmPortugues;
	}

	list($idAvaliacao, $tstampAvaliacao, $tstampAvaliacaoEst, $localAvaliacao, $statusAvaliacao, $notas) = $av->get_avaliacao($idAvaliador, $idTrabalhoStr, $tipoTrabalho, False);
	if($localAvaliacao){
		$localAvaliacaoHtml = "$localAvaliacao";
	}
	if($tstampAvaliacaoEst){
		$horarioAvaliacaoHtml = date("H:i (d/m)", $tstampAvaliacaoEst);
	}
	#Verifica se eu j� sei o tipo de trabalho que o avaliador ir� avaliar
	# e pega no BD caso contr�rio
	$trabalhosAvaliador = $av->get_trabalhos_avaliador($idAvaliador, $idTrabalhoStr);
	if($tipoTrabalho != ""){
		$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];
	}
	elseif(count($trabalhosAvaliador) == 1){
		#Pega o tipo do trabalho do resultado
		list($idTrabalhoStr, $tipoTrabalho, $status) = $trabalhosAvaliador[0];
		$trabalhoJaAvaliado = $status;

		#var_dump($trabalhoJaAvaliado);
		
		$args["tipoTrabalho"] = $tipoTrabalho;
		$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];
	}
	else{
		#Caso eu ainda n�o saiba, o tipo de trabalho em str s� dir� "Trabalho"
		$tipoTrabalhoStr = "Trabalho";
	}
	
	$urlAvaliacao    = $av->build_url_pagina("avalia_trabalho", $args);
	$urlSelecionaTrabalho = $av->build_url_pagina("seleciona_trabalho", array("idAvaliador" => $idAvaliador));
}
// }


#### In�cio da renderiza��o da p�gina ####

if($acaoPagina == 'erro'){
	$hd->renderiza_erro_e_sai($acaoPagina);
}

elseif($acaoPagina == 'erroDb'){
	#Se o artigo n�o for encontrado no banco de dados,
	#Redireciona direto para a p�gina de avalia��o
	$av->redireciona('avalia_trabalho', $args);
}
$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr
$botaoEsquerda = array($urlSelecionaTrabalho, 'icon-circle-arrow-left');
$botaoDireita  = array($urlAvaliacao, 'icon-edit');

echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, $tituloCab, $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
if($acaoPagina == 'exibeResumo'){
	$quebraTitulo  = $hd->quebra('icon-bookmark');
	$quebraAutores = $hd->quebra('icon-group');
	$quebraResumo  = $hd->quebra('icon-info-sign');
	$quebraLocal   = $hd->quebra('icon-location-arrow');
	
	if($trabalhoJaAvaliado){
		$quebraInfo = $hd->quebra("icon-info-sign");
		echo "
		$quebraInfo
		<p> <i>Esse trabalho j� foi avaliado.</i>
		";
	}
	echo "
		$quebraTitulo
		<h3> $titulo </h3>
		<br>
	";

	if($nomeAutores){
		echo "
		$quebraAutores
		<p> $nomeAutores
		<br><br>
		";
	}

	if($localAvaliacaoHtml || $horarioAvaliacaoHtml){
		echo "
		$quebraLocal
		<p> <b>Local:</b> $localAvaliacaoHtml 
		<p> <b>Hor�rio:</b> $horarioAvaliacaoHtml
		<br><br>
		";
	}

	if($resumo){
		echo "
		$quebraResumo
		<div id='texto_resumo'>
		<p> $resumo
		</div>
		";
	}

	echo "
		<br>
		<ul class=botao_pontudo> <a href=$urlAvaliacao> Iniciar Avalia��o <i class='icon-edit' style='margin-left:5px; font-size:25px; vertical-align:-2px;'></i> </a> </ul>
		";
}

////////////////////////////////////////////////////

require("foot.php");
?>
