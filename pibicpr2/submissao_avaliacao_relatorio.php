<?
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include.'sisdoc_security_post.php');


	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');
	
require('../_class/_class_parecer_pibic.php');
$avaliacao = new parecer_pibic;
$avaliacao->tabela = 'pibic_parecer_2012';

$tabela = "";
$cp = array();
$opc = '';
if (strlen($dd[1])==0) { $dd[1] = date("Y"); }
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$O A:Todos&0:Sem avalia��o&1:Com uma avalia��o&2:Com duas avalia��es&3:Com tr�s avalia��es&9:Com mais de tr�s avalia��es','','Ano',True,True,''));

echo '<CENTER><font class=lt5>Protocolos / n�mero de avalia��es</font></CENTER>';
?><TABLE width="500" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	

if ($saved <> 1) { require('foot.php'); exit; }

$pg = page();

//$sx .= '<TD>'.$line['doc_1_titulo'];
$rst = $avaliacao->resumo_avaliacao_detalhes($dd[1],$dd[2]);
echo '<table>';
echo $rst;
echo '</table>';
?>