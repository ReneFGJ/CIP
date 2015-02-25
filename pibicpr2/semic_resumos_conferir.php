<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',True,True,''));
array_push($cp,array('$C4','','Todas as bolsas',False,True,''));
array_push($cp,array('$O 1:Com resumo&2:Todos','','Tipo',False,True,''));
array_push($cp,array('$C4','','Com dados detalhados',False,True,''));
$fld = "pb_resumo";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Conferir Planos Publicados</font></CENTER>';
?><TABLE width="500" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	
require("../layout/classe/_class_artigos.php");

/////////////////////////////////////////////////////////////////// Relatório Parcial
if ($saved > 0)
		{
		$pt = new artigo;
		echo $pt->confere_publicacao();
		}
require("foot.php");
?>