<?php
require("cab.php");
if ($hd->recupera_avalidor() != 1)
	{
		print_r($hd);
		echo '<HR>';
		print_r($_SESSION);
		exit;
		$hd->set_avaliador($id);
		redirecina('index.php');
	}

/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$nomePagina = page();
$av = new avaliacao($nomePagina);

#Pega os argumentos da p�gina
$args = $av->get_args_pagina();
#$persistenciaPost � um par�metroFeio a ser passado pro form::editar s� para manter persist�ncia nos envios de form
$persistenciaPost = $nomePagina.".php";

#Cria form de identifica��o do trabalho
$form_id_trab = new form;
$form_id_trab->hidden_error = 1;
$cp = $av->cp_id_trabalho();
echo '--->'.$idAvaliador;
$trabalhosAvaliador = $av->busca_trabalhos_avaliador($idAvaliador);
exit;
$diaEst     = false; #para divisor de dia e sala
$localAtual = false; #para divisor de dia e sala
foreach($trabalhosAvaliador as $trab){
	list($idTrabalhoStr, $tipoTrabalho, $status, $horarioAvEstimado, $local) = $trab;
	$url = $av->build_url_pagina("exibe_resumo",array("idAvaliador" => $idAvaliador, "idTrabalhoStr" => $idTrabalhoStr, "tipoTrabalho" => $tipoTrabalho));
	$tipoTrabalhoStr = $av->tipoTrabalhoExtenso[$tipoTrabalho];
	$horaEstStr = date("G:i", $horarioAvEstimado);
	
	#Dividir por dia
	if($diaEst != date("j", $horarioAvEstimado) || $localAtual != $local){
		$diaEst = date("j", $horarioAvEstimado);
		$localAtual = $local;
		$diaSemana = array("Segunda-feira", "Ter�a-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "S�bado", "Domingo");
		$linhaDia = $diaSemana[date("N", $horarioAvEstimado)-1].", ".date("j/n", $horarioAvEstimado).($local ? ", ".$local : "");

		$trabalhosAvaliadorHtml .= "<br> <p> <b>$linhaDia</b>\n";
	}

	#$icone = 'icon-edit';
	$icone = $hd->icone_botao_tipo_trabalho[$tipoTrabalho];
	$trabalhosAvaliadorHtml.= "<a href='$url' class='botao_avaliacao botao_avaliacao_$tipoTrabalho'> $idTrabalhoStr <small>($tipoTrabalhoStr, $horaEstStr)</small> <i class='$icone'></i></a> \n";

}

#### In�cio da renderiza��o da p�gina ####

$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
$botaoEsquerda = array($av->build_url_pagina("logout",array()), 'icon-circle-arrow-left');
$botaoDireita  = NULL;

echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, "Selecione o trabalho", $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
$quebraHome  = $hd->quebra('icon-home');
$quebraInsercaoManual = $hd->quebra('icon-info');
echo "
$quebraHome
<p> <i>Selecione o trabalho a avaliar abaixo.</i>
<div class='lista_trabalhos'>

$trabalhosAvaliadorHtml

<br>

<!-- jquery para mostrar o form apenas se o usu�rio quiser -->

	<script>
	$(document).ready(function(){
	  $('#hide').click(function(){
	    $('#form_id_trab').hide();
	  });
	  $('#botao_digitar_trabalho').click(function(){
	    $('#form_id_trab').show();
	    $('#botao_digitar_trabalho').hide();
	  });
	  $('#form_id_trab').hide();
	});
	</script>

	<!-- <button id='hide'>Hide</button> -->
	<button id='botao_digitar_trabalho'><small>Quero digitar o nome do trabalho manualmente</small></button>
	<script>
	$('#botao_digitar_trabalho').click(function() {
		location.href='semic_trabalho_manual.php';
	});
	</script>
<!-- /jquery para mostrar o form apenas se o usu�rio quiser -->

</div>
";
////////////////////////////////////////////////////
require("foot.php");
?>
