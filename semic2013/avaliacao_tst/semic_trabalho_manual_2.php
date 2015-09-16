<?php
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");
$av = new Avaliacao;

$nomePagina = page();
$idTrabalhoStrUnsafe = $dd[51];

if ((strlen($dd[51]) > 0) and (strlen($dd[52]) > 0))
	{
		
		echo 'Gravar';
		$idAvaliadorUnsafe = strzero(round($hd->avaliador),7);
		$tipoTrabalhoUnsafe = $dd[52];
		$av->insere_avaliacao_forcado($idAvaliadorUnsafe, $idTrabalhoStrUnsafe, $tipoTrabalhoUnsafe);
		exit;
	}

#### Início da renderização da página ####
$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
$botaoEsquerda = array($av->build_url_pagina("semic_trabalhos",array()), 'icon-circle-arrow-left');
$botaoDireita  = NULL;

$sx = '<center>';
$sx .= '<form method="get" action="'.$nomePagina.'">
		<input type="hidden" name="dd51" value="'.$dd[51].'">
		<input type="hidden" name="dd52" value="O">
		<input type="submit" value="Avaliação Oral" class="bottom_submit">
		</form>
		';
$sx .= '<BR>';
$sx .= '<form method="get" action="'.$nomePagina.'">
		<input type="hidden" name="dd51" value="'.$dd[51].'">
		<input type="hidden" name="dd52" value="P">
		<input type="submit" value="Avaliação de Poster" class="bottom_submit">
		</form>
		';
$sx .= '</center>';

/* Monta resumo */
$av->le($idTrabalhoStrUnsafe);
	$resumo = '';
	$resumo .= '<table border=0 id="abstract">';
	$resumo .= '<TR><TD valign="top" height="1000" style="min-height: 1000px;" >';
	$resumo .= $hd->quebra('icon-bookmark');
	$resumo .= '<h2>'.$av->line['article_title'].'</h2>';
	$resumo .= $hd->quebra('icon-group');
	$resumo .= '<h5>'.$av->line['article_autores'].'</h5>';


$form_id_trab_html = $sx;
	
echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, "Selecione o tipo de avaliação", $botaoEsquerda, $botaoDireita);
////////////////////////////////////////////////////
$quebraHome  = $hd->quebra('icon-home');
$quebraInsercaoManual = $hd->quebra('icon-info');
echo "
<div id='form_id_trab'>
	$resumo
	
	$quebraInsercaoManual
	<p> <i>Informe o tipo de avaliação</i></P>
	<br>
	
	$form_id_trab_html
	<BR><BR><BR><BR><BR>
</div>

</div>
";
////////////////////////////////////////////////////
require("foot.php");
?>
