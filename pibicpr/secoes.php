<?
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

require("../_class/_class_journal_sections.php");

	$clx = new sections;
	$tabela = $clx->tabela;
	
	$label = msg("nucleo");
	$http_edit = 'secoes_ed.php'; 
	$editar = True;
	
	$http_ver = '';
	
	$http_redirect = 'secoes.php';
	
	$clx->row();
	$busca = true;
	$offset = 20;
	$pre_where = " journal_id = ".round($jid)." ";
	
	$order  = "seq";
	//exit;
	echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
	require($include.'sisdoc_row.php');	
	echo '</table>';	

require("../foot.php");		
?> 