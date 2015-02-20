<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab.php");
require("../_class/_class_captacao.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
//$cap->structure();

	$clx = new captacao;
	$tabela = $clx->tabela;
	
	$label = msg("captacao");
	$http_edit = 'captacao_ed.php'; 
	$http_ver = 'captacao_detalhe.php'; 
	
	//$editar = false;
 	//if ($perfil->valid('#RES')) { $editar = True; }
	$editar = ture;
	
	$http_redirect = 'captacao_lista.php';	
	
	$cdf = array('id_ca','ca_agencia','ca_descricao','ca_professor','ca_edital_ano','ca_edital_nr','ca_protocolo');
	$cdm = array('cod',msg('ag_tipo'),msg('nome'),msg('professor'),msg('ano'),msg('nr'));
	$masc = array('','','','','','','');
	$busca = true;
	$offset = 20;
	//$pre_where = " e_mailing = '".$cl->mail_codigo."' ";
	
	$order  = "ca_edital_ano, ca_edital_nr, ca_descricao";
	//exit;
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';

require("../foot.php");	?>