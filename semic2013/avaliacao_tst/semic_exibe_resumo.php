<?php
require("cab.php");
if ($hd->recupera_avalidor() != 1)
	{
		$hd->set_avaliador(0);
		redirecina('index.php');
	}
/* libs */
require($include.'_class_form.php');
$form_id_trab = new form;
$form_id_trab->hidden_error = 1;
$form_id_trab->class = ' class="camposForm" ';

/* classes */
require("_class/_class_avaliacao.php");
$av = new avaliacao($nomePagina);
$idAvaliadorUnsafe = $hd->avaliador;
$idTrabalhoStrUnsafe = $dd[51];

$nomePagina = page();

/* ID do trabalho */
$idTrabalhoStr = $dd[51];
//$ava->le($idTrabalhoStr);

#### Início da renderização da página ####
$tituloCab = NULL; //$tituloCab = NULL -> gerado de $tipoTrabalhoStr, $idTrabalhoStr em $hd->cab_logado()
$botaoEsquerda = array($av->build_url_pagina("semic_trabalhos",array()), 'icon-circle-arrow-left');
$botaoDireita  = NULL;

/* Monta resumo */
$av->le($idTrabalhoStrUnsafe);

	$resumo .= '<table border=0 id="abstract">';
	$resumo .= '<TR><TD valign="top" height="1000" style="min-height: 1000px;" >';
	$resumo .= $hd->quebra('icon-bookmark');
	$resumo .= '<h2>'.$av->line['article_title'].'</h2>';
	$resumo .= $hd->quebra('icon-group');
	$resumo .= '<h5>'.$av->line['article_autores'].'</h5>';
	$resumo .= $hd->quebra('icon-info-sign');
	$resumo .= '<div id="texto_resumo" style="text-align: justify;">';
	$resumo .= $av->line['article_abstract'];
	$resumo .= '<BR><BR><B>Palavras-chave</B>: '.$av->line['article_keywords'];

	$resumo .= '<BR><BR><BR>';
	$resumo .= '</table>';
	/* article_2_title */
	/* article_abstract */

/* Tela de avaliação */
$formulario = '';
	$work = '<table id="works" width="100%" style="heitht: 600px; " >';
	$work .= '<TR><TD height="800px" valign="top">Atribuia uma nota de 0 a 10, sendo 0 para ruim e 10 para excelente.';
	$cp = array();
	array_push($cp,array('$H8','','',False,True));
	array_push($cp,array('$[0-10]D','','Claresa',True,True));
	array_push($cp,array('$[0-10]D','','Poder de Síntese',True,True));
	array_push($cp,array('$[0-10]D','','Contribuição para formação científica',True,True));
	array_push($cp,array('$[0-10]D','','Conteúdo',True,True));
	array_push($cp,array('$[0-10]D','','Qualidade Visual',True,True));
	array_push($cp,array('$[0-10]D','','Desempenho do Aluno',True,True));
	array_push($cp,array('$[0-10]D','','Nota Gera',True,True));
	array_push($cp,array('$O : &SIM:SIM&NÃO:NÃO','','Indicar como um dos dez melhores trabalhos?',True,True));
	array_push($cp,array('$B8','','Confirmar Avaliação',False,True));
	
	$work .= $hd->quebra('quebra-simbolo');
	$work .= $form_id_trab->editar($cp,'');
	$work .= '</table>';

	$work .= '
	<script>
	$("#dd9").click(function() 
						{
							var vlr = $("#dd9").val();
							break;
							alert("OAL");
						});
	</script>	
	';
	
$arquivos = '<table id="files" width="100%" style="heitht: 600px;" >';
$arquivos .= '<TR><TD height="800px" valign="top">';
$arquivos .= '</table>';



echo $hd->cab_logado($tipoTrabalhoStr, $idTrabalhoStr, $nomeAvaliador, "Avaliação de Trabalho - ".$idTrabalhoStr, $botaoEsquerda, $botaoDireita);

echo '
<div id="nav">
    <ul>
        <li><a class="active" href="#" onClick="goto(\'#abstract\', this); return false">Resumo</a></li>
        <li><a href="#" onClick="goto(\'#works\', this); return false">Avaliação</a></li>
        <li><a href="#" onClick="goto(\'#files\', this); return false">Arquivos</a></li>
    </ul>
</div>

<div id="content">
<div class="contentbox-wrapper">
    '.$resumo.'
	'.$work.'
	'.$arquivos.'
</div> 
</div>
';
?>