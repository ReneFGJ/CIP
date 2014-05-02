<?
require("cab_cip.php");
require('../_class/_class_grupo_de_pesquisa.php');

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); }

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

	$clx = new grupo_de_pesquisa;
	$cp = $clx->cp();
	$tabela = $clx->tabela;
	$clx->structure();
	
	$label = msg("mensagens");
	$http_edit = 'grupo_de_pesquisa_ed.php'; 
	$http_ver = 'grupo_de_pesquisa_detalhe.php'; 
	$editar = True;
	
	$http_redirect = 'grupo_de_pesquisa.php';
	
//	$sql = "alter table ".$tabela." add column gp_pesquisadores int";
//	$rlt = db_query($sql);
//	$sql = "alter table ".$tabela." add column gp_estudantes int";
//	$rlt = db_query($sql);
//	$sql = "alter table ".$tabela." add column gp_tecnicos int";
//	$rlt = db_query($sql);
	
	$cdf = array('id_gp','gp_nome','gp_ano_formacao','gp_certificado','gp_pesquisadores','gp_estudantes','gp_tecnicos','gp_link_cnpq','gp_status','gp_checked');
	$cdm = array('cod',msg('nome'),msg('formacao'),msg('atualizado'),'pesq.','est.','tec.','link',msg('status'),'checked');
	$masc = array('','','','D','','','','');
	$busca = true;
	$offset = 20;
	$pre_where = " gp_status <> 'X' ";
	
	$order  = "gp_nome";
	//exit;
	$tab_max = '100%';
	echo '<TABLE width="100%" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 