<?php
require "cab_fomento.php";
renderiza_cabecalho_autentica();

require "../_class/_class_fomento.php";
$essaPagina = pathinfo_filename(__FILE__).'.php';
$fom_view = new fomento_view($essaPagina, $nw);
$acaoPagina = $fom_view->acaoPagina;

if($acaoPagina === 'manejar'){
	$tagUnsafe = $dd[51];

	if($fom_view->get_tag_id($tagUnsafe) === false){
		die("ERRO manejarTag.php: A tag não existe.");
	}
	else{
		$tag = $fom_view->san_tags_texto($tagUnsafe);

		$strBuscaRecentes = "$tag ordem:recentes";
		$urlBusca = $fom_view->constroi_url_busca($strBuscaRecentes, true, false);
		$html_recentes = $fom_view->html_busca_livre_resultados($strBuscaRecentes,true,false,3);
		list($html_tag_form_associar_destinatarios, $html_tag_form_associar_destinatarios_saved) = $fom_view->html_tag_form_associar_destinatarios($tagUnsafe);
	}
	echo "
		<h1><font size=30>$tag</font></h1>

		<h2><a href=\"$urlBusca\">Editais recentes com essa tag</a></h2>
		<i>Os seguintes editais recentes estão associados com essa tag. <a href=\"$urlBusca\">Clique aqui</a> para ver mais editais.</i>
		<table align='center'>
			<tr>
				<td width='800px'>
					$html_recentes
				</td>
			</tr>
		</table>

		<h2>Destinatários associados a essa tag</h2>
		<p><i>Ao enviar editais com a tag $tag, os seguintes destinatários serão selecionados automaticamente.</i></p>
		$html_tag_form_associar_destinatarios
	";
}
elseif($acaoPagina === 'novaTag'){
	list($html_form_nova_tag, $html_form_nova_tag_saved) = $fom_view->html_tag_form_nova_tag();
	$tag_titulo = $dd[1];
	echo "
		<h1>Criar nova tag</h1>
		<i>Insira o nome da nova tag e, opcionalmente, os destinatários associados à ela<i>
		$html_form_nova_tag
	";

	if($html_form_nova_tag_saved){ 
		$fom_view->redireciona($essaPagina, 'manejar', '', array($tag_titulo));
	}
}
elseif($acaoPagina === 'listarTags'){
	$html_tabela_tags = $fom_view->html_listar_tags();
	echo "
		<h1>As seguintes tags existem no sistema</h1>
		<i>Clique numa tag para manejar destinatários associados à mesma</i>
		<br><br>
		$html_tabela_tags
	";
}
else{
	die("ERRO: Acão de página inválida.");
}


require("../foot.php");
?>