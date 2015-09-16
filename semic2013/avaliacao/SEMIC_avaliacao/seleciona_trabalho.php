<?php
error_reporting(-1);
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$nomePagina = pathinfo_filename(__FILE__);
$av = new avaliacao($nomePagina);

#Pega os argumentos da página
# ver avaliacao->redireciona() para detalhes
$args = $av->get_args_pagina();
#$persistenciaPost é um parâmetroFeio a ser passado pro form::editar só para manter persistência nos envios de form
# não bem sucedidos
$persistenciaPost = $nomePagina.".php?".$av->build_query_pagina($nomePagina, $args);
$idAvaliador = $args["idAvaliador"];
#var_dump($idAvaliador);
$nomeAvaliador = $av->get_nome_avaliador($idAvaliador);

if($av->valida_avaliador($idAvaliador) != ''){
	$hd->renderiza_erro_e_sai();
}

#Cria form de identificação do trabalho
$form_id_trab = new form;
$form_id_trab->hidden_error = 1;
$cp = $av->cp_id_trabalho();
$form_id_trab_html = $form_id_trab->editar($cp,'', $persistenciaPost); #Renderiza campos 

if ($form_id_trab->saved > 0){
	$idTrabalhoStr = $dd[1]; #XXXFEIO do form
	$av->redireciona("seleciona_trabalho_manual", array("idAvaliador" => $idAvaliador, "idTrabalhoStr" => $idTrabalhoStr, "tipoTrabalho" => $tipoTrabalho));
}

$trabalhosAvaliador = $av->get_trabalhos_avaliador($idAvaliador);

#Filtra trabalhos, incluindo apenas os de hoje
function _trabalhoSeraAvaliadoHoje($trab){
	global $debug;
	list($idTrabalhoStr, $tipoTrabalho, $status, $horarioAvEstimado, $local) = $trab;
	$diaAtual = date("j");
	#if($debug){ $diaAtual = 22; } //XXX retirar na versão de produção
	#inclui trabalhos sem horário definido ($horarioAvEstimado === NULL)
	return $horarioAvEstimado === NULL || $diaAtual == date("j", $horarioAvEstimado); 
}
$trabalhosAvaliador = array_filter($trabalhosAvaliador, _trabalhoSeraAvaliadoHoje);

//Ordena items de acordo com o horário estimado da avaliação
function cmpAv($a, $b){
	#list($av_area, $av_numtrab, $av_tipo_trabalho, $av_status, $av_tstamp_avaliacao_est)
	$indId = 0;
	$indEst = 3;
	$t = time() + 7*60; #minutos de tolerância
	$difTempo_a = abs($a[$indEst]-$t) + intval($a[$indId] > $b[$indId]); #desempate
	$difTempo_b = abs($b[$indEst]-$t);
	if ($difTempo_a == $difTempo_b) {
        return 0;
    }
    return ($difTempo_a < $difTempo_b) ? -1 : 1;	
}
usort($trabalhosAvaliador, 'cmpAv');
#print_r($trabalhosAvaliador);

$diaEst     = false; #para divisor de dia e sala
$localAtual = false; #para divisor de dia e sala
foreach($trabalhosAvaliador as $trab){
	list($idTrabalhoStr, $tipoTrabalho, $status, $horarioAvEstimado, $local) = $trab;
	$url = $av->build_url_pagina("exibe_resumo",array("idAvaliador" => $idAvaliador, "idTrabalhoStr" => $idTrabalhoStr, "tipoTrabalho" => $tipoTrabalho));
	$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];
	$horaEstStr = $horarioAvEstimado ? ", ".date("G:i", $horarioAvEstimado) : "";
	
	#Dividir por dia
	if($diaEst != date("j", $horarioAvEstimado) || $localAtual != $local){
		if(isset($horarioAvEstimado) && isset($local) ) {
			$diaEst = date("j", $horarioAvEstimado);
			$localAtual = $local;
			$diaSemana = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
			$linhaDia = $diaSemana[date("w", $horarioAvEstimado)].", ".date("j/n", $horarioAvEstimado).($local ? ", ".$local : "");
		}
		else{
			$linhaDia = "Outros dias/locais";
		}

		$trabalhosAvaliadorHtml .= "<br> <p> <b>$linhaDia</b>\n";
	}

	#$icone = 'icon-edit';
	$icone = $hd->icone_botao_tipo_trabalho[$tipoTrabalho];
	$trabalhosAvaliadorHtml.= "<a href='$url' class='botao_avaliacao botao_avaliacao_$tipoTrabalho'> $idTrabalhoStr <small>($tipoTrabalhoStr)</small> <i class='$icone'></i></a> \n";

}

#### Início da renderização da página ####

$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
$botaoEsquerda = array($av->build_url_pagina("index",array()), 'icon-circle-arrow-left');
$botaoDireita  = NULL;

echo $hd->cab_logado(NULL, NULL, $nomeAvaliador, "Selecione o trabalho", $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
$quebraHome  = $hd->quebra('icon-home');
$quebraInsercaoManual = $hd->quebra('icon-info');
$urlSelecaoManual = $av->build_url_pagina("seleciona_trabalho_manual",$args);
echo "
$quebraHome
<p> <i>Selecione o trabalho a avaliar abaixo.</i>
<div class='lista_trabalhos'>

$trabalhosAvaliadorHtml

<br>
<br>
<a class='botao_acao_alternativa' href=$urlSelecaoManual>Quero digitar o nome do trabalho manualmente</a>
";

////////////////////////////////////////////////////
require("foot.php");
?>
