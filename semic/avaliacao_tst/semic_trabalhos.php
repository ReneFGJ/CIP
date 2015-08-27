<?php
require("cab.php");
if ($hd->recupera_avalidor() != 1)
	{
		$hd->set_avaliador(0);
		redirecina('index.php');
	}

/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$nomePagina = page();
$av = new avaliacao($nomePagina);

#Pega os argumentos da página
$args = $av->get_args_pagina();
#$persistenciaPost é um parâmetroFeio a ser passado pro form::editar só para manter persistência nos envios de form
$persistenciaPost = $nomePagina.".php";

#Cria form de identificação do trabalho
$form_id_trab = new form;
$form_id_trab->hidden_error = 1;
$cp = $av->cp_id_trabalho();

$trabalhosAvaliador = $av->busca_trabalhos_avaliador($idAvaliador);

$diaEst     = false; #para divisor de dia e sala
$localAtual = false; #para divisor de dia e sala
for ($r=0;$r < count($trabalhosAvaliador);$r++)
	{
	$trab = $trabalhosAvaliador[$r];

	$idTrabalhoStr = $trab[1];
	$tipoTrabalho = $trab[2];
	$tipoT = substr($tipoTrabalho,0,1);
	$url = 'semic_exibe_resumo.php?dd51='.$idTrabalhoStr;
	#$icone = 'icon-edit';
	$icone = $hd->icone_botao_tipo_trabalho[$tipoTrabalho];
	$trabalhosAvaliadorHtml.= "<a href='$url' class='botao_avaliacao botao_avaliacao_$tipoT'> 
		$idTrabalhoStr <small>($tipoTrabalho)</small> 
		<i class='$icone'></i></a> \n";

}
echo '<div style="float: both;">xx</div>';
#### Início da renderização da página ####

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
<center>
$trabalhosAvaliadorHtml
</center>
<br>

	<div style=\"clear:both\"><div>
	<div>
	<button id='botao_digitar_trabalho'><small>Quero digitar o nome do trabalho manualmente</small></button>
	</div>
	<script>
	$('#botao_digitar_trabalho').click(function() {
		location.href='semic_trabalho_manual.php';
	});
	</script>
<!-- /jquery para mostrar o form apenas se o usuário quiser -->

</div>
";
////////////////////////////////////////////////////
require("foot.php");
?>
