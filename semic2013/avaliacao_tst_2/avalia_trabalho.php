<?php
error_reporting(-1);
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$essaPagina = pathinfo_filename(__FILE__);
$av = new avaliacao($essaPagina);

#Pega os argumentos da p�gina
# ver avaliacao->redireciona() para detalhes
$args = $av->get_args_pagina();
list($idAvaliador, $idTrabalhoStr, $tipoTrabalho, $naoCompareceu) = array($args["idAvaliador"], $args["idTrabalhoStr"], $args["tipoTrabalho"], $args["naoCompareceu"]);
$nomeAvaliador = $av->get_nome_avaliador($idAvaliador);

$acaoPagina = "erro";

if(array_key_exists("forcado", $args) && $args["forcado"]){
	$av->insere_avaliacao_forcado($idAvaliador, $idTrabalhoStr, $tipoTrabalho);
}

#Verifica se o trabalho est� no banco de dados e dispon�vel para o 
# avaliador
#Retorna "" caso n�o hajam erros, uma mensagem de erro caso contr�rio
$erroValidaIdTrabalho = $av->valida_id_trabalho($idAvaliador, $idTrabalhoStr, $tipoTrabalho == "" ? NULL : $tipoTrabalho);

$urlExibeResumo = $av->build_url_pagina("exibe_resumo",array("idAvaliador" => $idAvaliador, "idTrabalhoStr" => $idTrabalhoStr, "tipoTrabalho" => $tipoTrabalho));
$urlSelecionaTrabalho = $av->build_url_pagina("seleciona_trabalho", array("idAvaliador" => $idAvaliador));

$argsNaoCompareceu = $args;
$argsNaoCompareceu['naoCompareceu'] = 1;
$urlNaoCompareceu = $av->build_url_pagina($essaPagina, $argsNaoCompareceu);

$persistenciaPost = $essaPagina.".php?".$av->build_query_pagina($essaPagina, $args);

function geraFormAv($tipoTrabalho, $persistenciaPost){
	global $av;
	#Cria form de avalia��o do trabalho
	$form_av_trab = new form;
	$form_av_trab->class = 'class="camposForm" ';
	$cp = $av->cp_ficha_avaliacao($tipoTrabalho);
	$form_av_trab_html = $form_av_trab->editar($cp, $av->tabela_avaliacoes, $persistenciaPost); #Renderiza campos e atualiza no banco de dados...
	#$form_av_trab_html = preg_replace('/\<input\s+type="text"/', '<input type="number" autocomplete="off"', $form_av_trab_html);
	#$form_av_trab_html = preg_replace('/size="18"\s+value\s*=\s*""\s+maxlength\s*=\s*"15"/','size="2" value="" maxlength="2"', $form_av_trab_html);
	#$dd[0] = $dd0_old;
	return array($form_av_trab, $form_av_trab_html);
}

if($erroValidaIdTrabalho == ""){
	$trabalhosAvaliador         = $av->get_trabalhos_avaliador($idAvaliador, $idTrabalhoStr, $tipoTrabalho, False); #False -> N�o apenas os trabalhos a avaliar, mas todos os trabalhos
	function _pendendoAvaliacao($trab) { $statusTrab = $trab[2]; return $statusTrab == 0; }
	$trabalhosPendendoAvaliacao = array_filter($trabalhosAvaliador, _pendendoAvaliacao);
	

	if(count($trabalhosAvaliador) == 0){
		$acaoPagina = 'erro';
	}
	else{
		#$tipoTrabalho n�o foi especificado, verificar se o avaliador vai avaliar apenas
		# um tipo de trabalho ou mais. Caso o �ltimo, mostrar uma lista dos tipos de
		# trabalho dispon�veis para avaliar

		if(count($trabalhosPendendoAvaliacao) == 1){
			#Pega o tipo do trabalho do resultado
			list($idTrabalhoStr, $tipoTrabalho, $status) = $trabalhosPendendoAvaliacao[0];
			$acaoPagina = "avaliar";
			list($form_av_trab, $form_av_trab_html) = geraFormAv($tipoTrabalho, $persistenciaPost);

		}
		else if(count($trabalhosAvaliador) > 1){
			#O avaliador tem mais de um tipo de trabalho no banco de dados
			#e.g. ele vai avaliar ambos a apresenta��o oral e o poster
			$acaoPagina = "mostraTrabalhos";
			$urlTrabalhosHtml = "";
			foreach($trabalhosAvaliador as $trabalho){
				list($idTrab, $tipoTrab) = $trabalho;
				$argsTrabalho = $args;
				$argsTrabalho["tipoTrabalho"] = $tipoTrab;
				$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrab];
				$url = $av->build_url_pagina($essaPagina, $argsTrabalho);

				$icone = $hd->icone_botao_tipo_trabalho[$tipoTrab];
				$urlTrabalhosHtml.= "<a href='$url' class='botao_avaliacao'> $tipoTrabalhoStr <i class='$icone' style='float:right'></i></a> \n";

				//$urlTrabalhosHtml .= "<p> <a href=$url class='botao_avaliacao'> $tipoTrabalhoStr </a>\n";
			}
		}
		else if(count($trabalhosAvaliador) == 1){
			#O trabalho j� foi avaliado
			#$tipoTrabalhoStr = "Trabalho";
			#list($idTrabalhoStr, $tipoTrabalho, $status) = $trabalhosAvaliador[0];
			list($idTrabalhoStr, $tipoTrabalho, $status, $tstamp_avaliacao_est, $local, $id_av, $tstamp_avaliacao) = $trabalhosAvaliador[0];
			$args["tipoTrabalho"] = $tipoTrabalho;
			$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];
			$acaoPagina = "trabalhoJaAvaliado";
			$persistenciaPost = $essaPagina.".php?".$av->build_query_pagina($essaPagina, $args);
			$dataHoraAvaliacaoAnterior = date("j/n/Y �\s G\hi", $tstamp_avaliacao).'min';
			list($form_av_trab, $form_av_trab_html) = geraFormAv($tipoTrabalho, $persistenciaPost);
		}

	}

	if($acaoPagina == 'avaliar' || $acaoPagina == 'trabalhoJaAvaliado'){
		$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];

		if($naoCompareceu){
			$av->form_reprovar_trabalho($form_av_trab, $cp, $idTrabalhoStr, $idAvaliador, $tipoTrabalho);
			$av->redireciona("finaliza_avaliacao", $args);
		}

		elseif ($form_av_trab->saved){
			if($av->form_confirma_fim($form_av_trab, $cp, $idTrabalhoStr, $idAvaliador, $tipoTrabalho)){
				$av->redireciona("finaliza_avaliacao", $args);
			}
			else{
				$acaoPagina = 'erro';
			}
		}
	}
}
elseif($av->valida_id_trabalho($idAvaliador, $idTrabalhoStr, NULL, False) === ''){
	#Trabalho existe no sistema, por�m n�o est� associado ao avaliador
	$tipoTrabalhoStr = "Trabalho";
	$acaoPagina = 'avisoTrabalhoNaoAssociado';
	foreach(array_keys($av->camposAv) as $tipoTrab){
		$idTrab = $idTrabalhoStr;
		$argsTrabalho = $args;
		$argsTrabalho["tipoTrabalho"] = $tipoTrab;
		//For�a avalia��o, mesmo se o avaliador n�o estiver associado ao trabalho
		$argsTrabalho["forcado"]      = True; 
		$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrab];
		$url = $av->build_url_pagina($essaPagina, $argsTrabalho);

		$icone = $hd->icone_botao_tipo_trabalho[$tipoTrab];
		$urlTrabalhosHtml.= "<a href='$url' class='botao_avaliacao'> $tipoTrabalhoStr <i class='$icone' style='float:right'></i></a> \n";
		//$urlTrabalhosHtml .= "<p> <a href=$url class='botao_avaliacao'> $tipoTrabalhoStr </a>\n";
	}
} 
else{
	$acaoPagina = 'erro';
}

if($av->get_trabalho($idAvaliador, $idTrabalhoStr, False)){
	$urlBack = $urlExibeResumo;
}
else{
	$urlBack = $urlSelecionaTrabalho;
}


#### In�cio da renderiza��o da p�gina ####

if($acaoPagina == 'erro'){
	$hd->renderiza_erro_e_sai($acaoPagina);
}

$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr
$botaoEsquerda = array($urlBack, 'icon-circle-arrow-left');
$botaoDireita  = NULL;

echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, $tituloCab, $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
if($acaoPagina == 'avaliar'){
	$quebraAvaliacao  = $hd->quebra('icon-edit');
	echo "
$quebraAvaliacao

<p> <i>Avalia��o de $tipoTrabalhoStr. Notas de 1 a 10.</i>

<div class='form_avaliacao'>
<ul class='botao_pontudo'>
$form_av_trab_html
</ul>
</div>

<br>
<br>

<div style='text-align:center'> <a href=$urlNaoCompareceu> Clique aqui caso o aluno n�o tenha comparecido no local e hor�rio de apresenta��o </a></div>

";
} //XXX mostrar bot�o grande de reprova��o

elseif($acaoPagina == "mostraTrabalhos"){
	$quebraInfo = $hd->quebra("icon-question-sign");
	echo "
$quebraInfo
<p> Selecione o tipo da avalia��o a realizar:

$urlTrabalhosHtml

";

}

elseif($acaoPagina == "avisoTrabalhoNaoAssociado"){
	$quebraInfo = $hd->quebra("icon-question-sign");
	echo "
$quebraInfo
<div class='aviso'>
<p> <h1>ATEN��O</h1>
<p> O trabalho especificado n�o est� associado com 
    o seu c�digo de avaliador no sistema.
<p> Verifique se o c�digo abaixo est� correto.

<div class='destaque'>$idTrabalhoStr</div>

<p> Para avaliar mesmo assim esse trabalho, <i>Selecione
	o tipo de avalia��o abaixo.</i> Caso contr�rio, <i><a href=$urlSelecionaTrabalho>clique aqui</a></i>
	para selecionar um outro trabalho.
</div>
<br>
<br>
$urlTrabalhosHtml
";
}

elseif($acaoPagina == "trabalhoJaAvaliado"){
	$quebraInfo = $hd->quebra("icon-info-sign");
	#XXX talvez colocar dados da avalia��o no futuro?
	echo"
$quebraInfo
<p> <i> Esse trabalho j� foi avaliado em $dataHoraAvaliacaoAnterior.</i>
<div class='form_avaliacao'>
<ul class='botao_pontudo'>
$form_av_trab_html
</ul>
</div>
";
}
////////////////////////////////////////////////////

require("foot.php");
?>