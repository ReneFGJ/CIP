<?php
error_reporting(-1);
require("cab.php");
/* libs */
require($include.'_class_form.php');
/* classes */
require("_class/_class_avaliacao.php");

$avaliacao = new avaliacao;

#Cria form de identificação do avaliador
$form_id_av = new form;
$form_id_av->hidden_error = 1;
if (strlen($acao) > 0) { $form_id_av->hidden_error = 0; }
$cp = $avaliacao->cp_id_avaliador();
$form_id_av_html = $form_id_av->editar($cp,''); #Renderiza campos 

//XXX XUNXOS HORRÍVEIS para deixar o botão de entrada horizontal ao resto do form
$form_id_av_html = str_replace('<table', '<table ><tr><td align="right" valign="top"><table', $form_id_av_html);
#$form_id_av_html = preg_replace('/\<input\s+type="button"/', '</table></td><td align="left" valign="top"><input type="button" style="background:transparent; border: 0px;"', $form_id_av_html);
$form_id_av_html = preg_replace('/\<input\s+type="text"\s+name="dd1"/', '<input type="text" name="dd1" autocomplete="off"', $form_id_av_html);
$form_id_av_html = preg_replace('/\<input\s+type="button"/', '</table></td><td align="left" valign="top" style="float:left"><button type="submit"', $form_id_av_html);
$form_id_av_html = str_replace('class="bottom_submit" />', 'class="bottom_submit" /> <i class="icon-circle-arrow-right"></i> </button>', $form_id_av_html);

if ($form_id_av->saved > 0){
	$idAvaliador = $dd[1]; #XXXFEIO do form
	$avaliacao->redireciona("seleciona_trabalho", array("idAvaliador" => $idAvaliador));
}

#### Início da renderização da página ####

echo $hd->cab("Avaliação de Trabalhos", 'margin:0 auto -330px;');
////////////////////////////////////////////////////

$banner = $hd->banner_intro($avaliacao);

echo "
<div class=espacador_banner></div>
$banner
<div class=espacador_banner></div>

<div id=id_avaliador_background>
	$form_id_av_html 
</div>
";

////////////////////////////////////////////////////
echo $hd->foot('height: 330px;', '<div id=logo_bottom></div>', 'height: 330px; margin: 0 auto -330px;');
?>

