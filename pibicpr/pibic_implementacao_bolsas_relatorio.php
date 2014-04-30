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
array_push($cp,array('$O PIBIC:PIBIC&PIBITI:PIBITI&IS:IS&PIBICE:PIBIC_EM&CSF:CSF','','Edital',False,True,''));
array_push($cp,array('$A8','','Bolsas não implementadas',False,True,''));
if (strlen($dd[3]) == 0)
	{
	array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',False,True,''));
	} else {
	array_push($cp,array('$HV','','',False,True,''));
	}
array_push($cp,array('$[2009-'.date("Y").']','','Implementadas',False,True,''));
array_push($cp,array('$HV','',$ano,True,True,''));
//////////////////
if (strlen($dd[4]) == 0) { $dd[4] = (date("Y")-1); }
	echo '<h1>Relatório de Bolsas implementadas</h1>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	if ($saved == 0)
		{ exit; }
			

echo $pb->relatorio_implementadas($dd[1],$dd[3],$dd[4]);

/* Link para exportar para o Excel */
echo '<A href="pibic_implementacao_bolsas_relatorio_excel.php?dd1='.$dd[1].'&dd3='.$dd[3].'&dd4='.$dd[4].'" target="_new">';
echo '<img src="'.http.'img/icone_excel.png" border=0 height="30" alt="expotar para Ms-Excel" >';
echo '</A>';

echo $hd->foot();
?>