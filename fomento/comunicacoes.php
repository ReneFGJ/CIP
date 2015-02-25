<?
require("cab_fomento.php");
require('_class_comunicacao.php');

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

array_push($menu,array('Listas de e-mail','Lista de e-mail','comunicacao_lista.php'));
$tela = menus($menu,"3");
echo $tela;

	$clx = new comunicacao;
	$tabela = $clx->tabela;
	
	$label = msg("chamadas");
	$http_edit = 'comunicacao.php';
	$http_ver = 'comunicacao_preview.php';  
	
	$http_redirect = page();
	$editar = True;
	
	$clx->row();
	$busca = true;
	$offset = 20;
	$order = 'id_cm desc';
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	//exit;
	$tab_max = "100%";
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 