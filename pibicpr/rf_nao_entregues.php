<?
require("cab.php");

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');
	
$tabela = "";
$cp = array();
$ano = date("Y");

array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
//array_push($cp,array('$O PIBIC:PIBIC&PIBITI:PIBITI&IS:IS','','Edital',False,True,''));
array_push($cp,array('$A8','','Relatório Final',False,True,''));
if (strlen($dd[3]) == 0)
	{
	array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',False,True,''));
	} else {
	array_push($cp,array('$HV','','',False,True,''));
	}
array_push($cp,array('$['.(date("Y")-1).'-'.date("Y").']','','Implementadas',False,True,''));
array_push($cp,array('$HV','',$ano,True,True,''));
array_push($cp,array('$C1','','Todas as modalidades (PIBIC/PIBITI)',False,True,''));
//////////////////
if (strlen($dd[4]) == 0) { $dd[4] = (date("Y")-1); }
	echo '<h1>Relatórios não entregues</h1>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	if ($saved == 0)
		{ exit; }
			
if (strlen($dd[6]) > 0)
	{
		echo $pb->relatorio_nao_entregue($dd[1],'',$dd[4]);
	} else {
		echo $pb->relatorio_nao_entregue($dd[1],$dd[3],$dd[4]);
	}

echo $hd->foot();
?>