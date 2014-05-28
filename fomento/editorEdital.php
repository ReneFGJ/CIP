<?php
require "cab_fomento.php";
renderiza_cabecalho_autentica();

require "../_class/_class_fomento.php";
$essaPagina = pathinfo_filename(__FILE__).'.php';
$fom_view = new fomento_view($essaPagina, $nw);

$url_nova_agencia_fomento = "/reol/cip/agencia_de_fomento_ed.php";

#$fom_view->fomento->sql_criar_tabelas();

$idEdital = $dd[0];

$acaoPagina = $fom_view->acaoPagina;

function redirecionaParaVisualizacaoSeEnviado($idEditalUnsafe){
	global $fom_view;
	if($fom_view->edital_foi_enviado($idEditalUnsafe)){
		$fom_view->redireciona('visualizarEdital.php', 'verEditalInterno', $idEditalUnsafe);
	}
}

$msgPrevia  = "<p> Preencha os dados do edital e clique em 'Prever edital' para exibir uma pr�via. </p>";
$msgPrevia .= "<p> Caso a Ag�ncia de fomento n�o esteja na lista, <a href=$url_nova_agencia_fomento>clique aqui</a> para cadastrar uma nova ag�ncia de fomento. </p>";
$htmlAcaoNovo = 'Criar novo edital';

#$idEditalUnsafe='', $acaoPaginaUnsafe='', $criarNovo=false
if(is_numeric($idEdital)){
	if($acaoPagina === false || $acaoPagina === 'novoBaseadoEmAnterior'){
		//For�a a cria��o de um novo edital (i.e. para n�o editar um anterior)
		list($html_corpo, $form_edital_saved, $id_edital_saved) = $fom_view->html_editor_edital($idEdital, $acaoPagina);
		$html_acao = 'Criar novo a partir de anterior';
		$html_mensagem = $msgPrevia;
	}
	elseif($acaoPagina === 'editarNovo'){
		redirecionaParaVisualizacaoSeEnviado($idEdital);
		list($html_corpo, $form_edital_saved, $id_edital_saved) = $fom_view->html_editor_edital($idEdital, $acaoPagina);
		$dd[0] = $id_edital_saved;
		$html_acao = $htmlAcaoNovo; 
		$html_mensagem = $msgPrevia;
	}
	elseif($acaoPagina === 'editarExistente'){
		list($html_corpo, $form_edital_saved, $id_edital_saved) = $fom_view->html_editor_edital($idEdital, $acaoPagina);
		$dd[0] = $id_edital_saved;
		$html_acao = 'Editar existente';
		$html_mensagem = $msgPrevia;
	}
	elseif($acaoPagina === 'preverEditalNovo' || $acaoPagina === 'preverEditalExistente'){
		if($acaoPagina === 'preverEditalNovo') { redirecionaParaVisualizacaoSeEnviado($idEdital);}
		$html_acao   = 'Prever Edital';
		$html_email = $fom_view->html_visualizacao_email($idEdital);

		$url_enviar_previa = $fom_view->constroi_url($essaPagina, 'enviarPrevia', $idEdital, array($acaoPagina));
		list($emailUsuario, $nomeUsuario) = $fom_view->usuario_email_nome();

		$botoes = array();
		if($acaoPagina === 'preverEditalNovo'){
			$url_voltar_a_edicao = $fom_view->constroi_url($essaPagina, 'editarExistente', $idEdital);
			$url_enviar = $fom_view->constroi_url($essaPagina, 'enviarEdital', $idEdital);
			array_push($botoes, array($url_voltar_a_edicao, "Editar conte�do"));
			array_push($botoes, array($url_enviar_previa, "Enviar pr�via para $emailUsuario"));
			array_push($botoes, array($url_enviar, "Enviar edital"));
			$msgSubmeter = "Clique em 'Enviar edital' para enviar.";
		}
		elseif($acaoPagina === 'preverEditalExistente'){
			die("ERRO preverEditalExistente: XXX n�o implementado.");
			$url_voltar_a_edicao = $fom_view->constroi_url($essaPagina, 'editarNovo', $idEdital);
			$url_confirmar_edicao = 'example.com'; //XXX implementar
			array_push($botoes, array($url_voltar_a_edicao, "Editar conte�do"));
			array_push($botoes, array($url_enviar_previa, "Enviar pr�via para $emailUsuario"));
			array_push($botoes, array($url_confirmar_edicao, "Confirmar edi��o"));	
			$msgSubmeter = "Clique em 'Confirmar edi��o' para confirmar as modifica��es.";
		}
		
		$html_edital_iframe = $fom_view->html_cria_iframe_visualizador($html_email, 'previaEmail', $botoes);

		$html_mensagem  = "O edital est� pronto para ser enviado. ".$msgSubmeter;
		$html_mensagem .= $fom_view->html_aviso_edital_com_url_invalida($idEdital);
		$html_corpo = "
				<table width=\"100%\"> 
					<tr align=\"center\"><td>

						$html_edital_iframe

					</td></tr>
				</table>			
		";
	}
	elseif($acaoPagina === 'enviarPrevia' && isset($fom_view->argsExtraPagina[0])){
		$acaoAnterior = $fom_view->argsExtraPagina[0];
		assert($acaoAnterior === 'preverEditalNovo' || $acaoAnterior === 'preverEditalExistente');
		$url_voltar_a_previa = $fom_view->constroi_url($essaPagina, $acaoAnterior, $idEdital);
		$html_mensagem_envio = $fom_view->edital_enviar_previa_usuario($idEdital);
		$html_acao = 'Envio de pr�via';
		$html_corpo  = "<p> $html_mensagem_envio </p>\n";
		$html_corpo .= "<p> <a href=\"$url_voltar_a_previa\">Clique aqui</a> para voltar a pr�via. </p>";
	}
	elseif($acaoPagina === 'enviarEdital'){
		$url_visualizar = $fom_view->constroi_url('visualizarEdital.php', 'verEditalInterno', $idEdital);
		$html_acao = 'Envio';
		$html_corpo = $fom_view->edital_enviar($idEdital);
		$html_corpo .= "
			<p> Para visualizar o edital, <a href='$url_visualizar'>clique aqui</a> </p>
			<p> <a href='/reol/fomento/'>Clique aqui</a> para voltar para p�gina inicial </p>
		";
	}
	else{
		die("ERRO. Verifique a URL");
	}
}
elseif($acaoPagina === false || $acaoPagina === 'editarNovo'){
	// Novo edital
	list($html_corpo, $form_edital_saved, $id_edital_saved) = $fom_view->html_editor_edital();
	$html_acao = $htmlAcaoNovo;
	$html_mensagem = $msgPrevia;
}
else{
	//XXX Colocar mensagem amig�vel
	die("ERRO. Verifique a URL");
}

// Mostra preview se $form_edital_saved
if($acaoPagina != 'preverEditalNovo' && isset($form_edital_saved) && $form_edital_saved) {
	$dd[0] = $id_edital_saved;
	$fom_view->redireciona($essaPagina, 'preverEditalNovo', $id_edital_saved);
}


#### In�cio da renderiza��o da p�gina ####

if(!isset($html_mensagem)) { $html_mensagem = ''; }

echo "
<h1> $html_acao </h1>

<i> $html_mensagem </i>

$html_corpo
";

require("../foot.php");
?>